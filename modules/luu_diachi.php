<?php
session_start();
include("../config.php");

$id = $_SESSION['IDNguoiDung'];

$sdt = $_POST['sdt'];
$diachi = $_POST['diachi'];
$thanhtoan = $_POST['thanhtoan'];

// Lưu user
$sql = "UPDATE nguoidung 
        SET DienThoai='$sdt', DiaChi='$diachi'
        WHERE IDNguoiDung='$id'";
mysqli_query($connect,$sql);

// 👉 chuyển qua đặt hàng + truyền thanh toán
header("Location: DatHang.php?thanhtoan=".$thanhtoan);
exit();