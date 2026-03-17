<?php
session_start();
include("../config.php");

if(!isset($_SESSION['IDNguoiDung'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['IDNguoiDung'];

$sql = "SELECT DienThoai, DiaChi FROM nguoidung WHERE IDNguoiDung = '$id'";
$kq = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($kq);

// Nếu thiếu thông tin → chuyển sang nhập
if(empty($row['DienThoai']) || empty($row['DiaChi'])){
    header("Location: diachinhanhang.php");
    exit();
}

// Nếu đủ → cho đặt luôn
header("Location: DatHang.php");
exit();