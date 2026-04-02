<?php
session_start();
include("../config.php");

mysqli_set_charset($connect,"utf8");

$thanhtoan = isset($_POST['thanhtoan']) 
    ? $_POST['thanhtoan'] 
    : (isset($_GET['thanhtoan']) ? $_GET['thanhtoan'] : 'COD');

if(!isset($_SESSION['id_them_vao_gio'])){
    echo "Giỏ hàng trống!";
    exit();
}

// Lấy dữ liệu từ form
// ❗ CHƯA LOGIN
if(!isset($_SESSION['IDNguoiDung'])){
    header("Location: login.php");
    exit();
}

// ❗ KIỂM TRA THIẾU THÔNG TIN
$id = $_SESSION['IDNguoiDung'];

$sql = "SELECT DienThoai, DiaChi FROM nguoidung WHERE IDNguoiDung='$id'";
$kq = mysqli_query($connect,$sql);
$u = mysqli_fetch_array($kq);

if(empty($u['DienThoai']) || empty($u['DiaChi'])){
    header("Location: cart.php?thieu=1");
    exit();
}

// Nếu có đăng nhập thì lấy ID user
$idNguoiDung = isset($_SESSION['IDNguoiDung']) ? $_SESSION['IDNguoiDung'] : 0;

// Tính tổng tiền
$tongTien = 0;

for($i=0; $i<count($_SESSION['id_them_vao_gio']); $i++){

    $idSach = $_SESSION['id_them_vao_gio'][$i];
    $sl = $_SESSION['sl_them_vao_gio'][$i];

    $sql = "SELECT GiaBan FROM sach WHERE IDSach = '$idSach'";
    $kq = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($kq);

    $tongTien += $row['GiaBan'] * $sl;
}

// 1. Thêm vào bảng đơn hàng
$sql_donhang = "INSERT INTO donhang(
    IDNguoiDung, NgayDat, TongTien, TrangThai, PhuongThucTT
) VALUES(
    '$idNguoiDung', NOW(), '$tongTien', 0, '$thanhtoan'
)";

mysqli_query($connect,$sql_donhang);

// Lấy ID đơn hàng vừa thêm
$idDonHang = mysqli_insert_id($connect);

// 2. Thêm chi tiết đơn hàng
for($i=0; $i<count($_SESSION['id_them_vao_gio']); $i++){

    $idSach = $_SESSION['id_them_vao_gio'][$i];
    $sl = $_SESSION['sl_them_vao_gio'][$i];

    $sql_check = "SELECT SoLuong FROM sach WHERE IDSach='$idSach'";
    $kq_check = mysqli_query($connect,$sql_check);
    $row_check = mysqli_fetch_array($kq_check);

    if($row_check['SoLuong'] < $sl){
        echo "Sản phẩm đã hết hàng!";
        exit();
    }

    $sql = "SELECT GiaBan FROM sach WHERE IDSach = '$idSach'";
    $kq = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($kq);

    $donGia = $row['GiaBan'];

    $sql_ct = "INSERT INTO chitietdonhang(IDDonHang, IDSach, SoLuong, DonGia)
               VALUES('$idDonHang', '$idSach', '$sl', '$donGia')";

               // ❗ TRỪ KHO
    $sql_update = "UPDATE sach 
               SET SoLuong = SoLuong - $sl 
               WHERE IDSach = '$idSach'";

mysqli_query($connect, $sql_update);

    mysqli_query($connect,$sql_ct);
}

// 3. Xóa giỏ hàng
unset($_SESSION['id_them_vao_gio']);
unset($_SESSION['sl_them_vao_gio']);

// 4. Chuyển trang
header("Location: cart.php?success=1");
exit();
?>