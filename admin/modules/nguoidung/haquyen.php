<?php
session_start();
include("../../config.php");

if($_SESSION['IDVaiTro'] != 1){
    die("Không có quyền!");
}

$id = intval($_GET['id']);

$sql = "UPDATE nguoidung SET IDVaiTro = 2 WHERE IDNguoiDung = $id";
mysqli_query($connect, $sql);

echo "ok";
?>