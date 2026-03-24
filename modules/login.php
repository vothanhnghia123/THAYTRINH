<?php
session_start();
include("../config.php");

$error = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $matkhau = md5($_POST['matkhau']);

    $sql = "SELECT * FROM nguoidung 
            WHERE Email = '$email' AND MatKhau = '$matkhau'";

    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['IDNguoiDung'] = $row['IDNguoiDung'];
        $_SESSION['HoTen'] = $row['HoTen'];
        $_SESSION['IDVaiTro'] = $row['IDVaiTro']; // 🔥 thêm dòng này

            // phân quyền
            if($row['IDVaiTro'] == 1){
                header("location:../admin/index.php"); // admin
            }else{
                header("location:../index.php"); // user
            }
            exit();
    } else {

         $error = "Sai tài khoản hoặc mật khẩu";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="../css/style.css">

<title>Đăng nhập</title>

</head>

<body>

<div class="auth-container">

    <h2>Đăng nhập</h2>

    <form method="POST" class="auth-form">

        <input type="email" name="email" placeholder="Email">

        <input type="password" name="matkhau" placeholder="Mật khẩu">

        <button name="login">Đăng nhập</button>
        <?php if($error != ""){ ?>
        <p class="login-error"><?php echo $error; ?></p>
    <?php } ?>

    </form>
    <p class="auth-switch">
        Bạn chưa có tài khoản? 
        <a href="register.php">Đăng ký</a>
    </p>
</div>

</body>
</html>