<?php
session_start();
include("../config.php");

mysqli_set_charset($connect, "utf8");

if (isset($_POST['idsach'])) {
    // 1. Nhận dữ liệu và bảo mật cơ bản
    $idsach = mysqli_real_escape_string($connect, $_POST['idsach']);
    $sosao = mysqli_real_escape_string($connect, $_POST['sosao']);
    $noidung = mysqli_real_escape_string($connect, $_POST['noidung']);

    // 2. Kiểm tra user (Ưu tiên lấy từ Session nếu đã đăng nhập)
    if (isset($_SESSION['IDNguoiDung'])) {
        $idnguoidung = $_SESSION['IDNguoiDung'];
    } else {
        /* tạm thời user id = 1 nếu chưa có login */
        $idnguoidung = 1; 
    }

    // 3. Thực thi câu lệnh Insert
    $sql = "INSERT INTO danhgia (IDSach, IDNguoiDung, SoSao, NoiDung)
            VALUES ('$idsach', '$idnguoidung', '$sosao', '$noidung')";

    if (mysqli_query($connect, $sql)) {
        // 4. Chuyển hướng về trang sản phẩm sau khi lưu thành công
        header("location:../singleproduct.php?id=" . $idsach);
    } else {
        echo "Lỗi: " . mysqli_error($connect);
    }
}
?>