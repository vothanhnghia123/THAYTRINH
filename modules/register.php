<?php
session_start();
include("../config.php");

if (isset($_POST['register'])) {

    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $matkhau = md5($_POST['matkhau']);

    $sql = "INSERT INTO nguoidung(HoTen, Email, MatKhau)
            VALUES('$hoten', '$email', '$matkhau')";

    mysqli_query($connect, $sql);

    header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="../css/style.css">

<title>Đăng ký</title>

</head>

<body>

<div class="auth-container">

    <h2>Đăng ký</h2>

    <form method="POST" class="auth-form">

        <input type="text" name="hoten" placeholder="Họ tên" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="matkhau" placeholder="Mật khẩu" required>

        <button name="register">Đăng ký</button>

    </form>
    <p class="auth-switch">
        Đã có tài khoản? 
        <a href="login.php">Đăng nhập</a>
    </p>
</div>

</body>
</html>