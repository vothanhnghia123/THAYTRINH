<?php
session_start();
include("../config.php");
?>

<h2>Nhập thông tin nhận hàng</h2>

<form action="luu_diachi.php" method="post">
    <input type="text" name="sdt" placeholder="Số điện thoại" required><br><br>
    <input type="text" name="diachi" placeholder="Địa chỉ nhận hàng" required><br><br>

    <button type="submit">Lưu & Đặt hàng</button>
</form>
