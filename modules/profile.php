<?php
session_start();
include("../config.php");

if (!isset($_SESSION['IDNguoiDung'])) {
    header("location:login.php");
    exit();
}

$id = intval($_SESSION['IDNguoiDung']);

if(isset($_POST['luu'])){

    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];

    $sql_update = "UPDATE nguoidung 
                   SET HoTen='$hoten',
                       Email='$email',
                       DienThoai='$dienthoai',
                       DiaChi='$diachi'
                   WHERE IDNguoiDung=$id";

        mysqli_query($connect,$sql_update);

        header("Location: profile.php?success=1");
        exit();
}

// xử lý đổi mật khẩu
if(isset($_POST['doimatkhau'])){

    $oldpass = md5($_POST['oldpass']);
    $newpass = md5($_POST['newpass']);
    $renewpass = md5($_POST['renewpass']);

    // lấy mật khẩu hiện tại
    $sql_check = "SELECT MatKhau FROM nguoidung WHERE IDNguoiDung=$id";
    $result_check = mysqli_query($connect,$sql_check);
    $row_check = mysqli_fetch_assoc($result_check);

    if($oldpass != $row_check['MatKhau']){
        $pass_error = "Mật khẩu cũ không đúng";
    }
    elseif($newpass != $renewpass){
        $pass_error = "Mật khẩu nhập lại không khớp";
    }
    else{

        $sql_update_pass = "UPDATE nguoidung 
                            SET MatKhau='$newpass'
                            WHERE IDNguoiDung=$id";

        mysqli_query($connect,$sql_update_pass);

        header("Location: profile.php?page=password&successpass=1");
        exit();
    }
}

$sql = "SELECT * FROM nguoidung WHERE IDNguoiDung = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

$page = isset($_GET['page']) ? $_GET['page'] : "info";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông tin người dùng</title>
    <link rel="stylesheet" href="../css/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php 
        include('header.php');
    ?>

    <div class="profile-container">

    <h2>Thông tin người dùng</h2>


    <div class="profile-content">

    <!-- Bên trái -->
    <div class="profile-buttons">

        <a href="profile.php?page=info" class="btn">Thông tin</a>

        <a href="profile.php?page=orders" class="btn">Đơn hàng của tôi</a>

        <a href="profile.php?page=password" class="btn">Đổi mật khẩu</a>

        <a href="logout.php" class="btn logout">Đăng xuất</a>

    </div>

    <!-- Bên phải -->
    <div class="user-info">

        <?php if(isset($_GET['success'])){ ?>
            <div class="success-msg">
            ✔ Cập nhật thành công
            </div>
        <?php } ?>

        <?php if ($page == "info") { ?>
            <form method="POST">
                <div class="info-row">
                    <span>Họ tên:</span>
                    <input type="text" name="hoten" value="<?php echo $row['HoTen']; ?>">
                </div>

                <div class="info-row">
                    <span>Email:</span>
                    <input type="email" name="email" value="<?php echo $row['Email']; ?>">
                </div>

                <div class="info-row">
                    <span>Điện thoại:</span>
                    <input type="text" name="dienthoai" value="<?php echo $row['DienThoai']; ?>">
                </div>

                <div class="info-row">
                    <span>Địa chỉ:</span>
                    <input type="text" name="diachi" value="<?php echo $row['DiaChi']; ?>">
                </div>

                <div class="save-box">
                    <button type="submit" name="luu" class="btn save">Lưu thay đổi</button>
                </div>
            </form>
        <?php } ?>
                
                <?php if(isset($_GET['successpass'])){ ?>
                        <div class="success-msg">
                        ✔ Đổi mật khẩu thành công
                        </div>
                    <?php } ?>

                    <?php if(isset($pass_error)){ ?>
                    <div class="error-msg">
                    <?php echo $pass_error; ?>
                    </div>
                    <?php } ?>

        <?php if ($page == "password") { ?>
            <form method="POST" action="">
                <div class="info-row">
                    <span>Mật khẩu cũ:</span>

                    <div class="password-input">
                        <input type="password" name="oldpass" id="oldpass">
                        <span class="show-pass" onclick="togglePass()">Hiện</span>
                    </div>
                </div>

                <div class="info-row">
                    <span>Mật khẩu mới:</span>
                    <input type="password" name="newpass">
                </div>

                <div class="info-row">
                    <span>Nhập lại:</span>
                    <input type="password" name="renewpass">
                </div>

                <div class="save-box">
                    <button name="doimatkhau" class="btn save">Đổi mật khẩu</button>
                </div>
            </form>
        <?php } ?>

        <?php if ($page == "orders") { ?>
            <table class="order-table">
                <tr>
                    <th>Mã đơn</th>
                    <th>Ngày</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>

                <?php
                $sql_order = "SELECT * FROM donhang WHERE IDNguoiDung = $id";
                $result_order = mysqli_query($connect, $sql_order);

                while ($order = mysqli_fetch_assoc($result_order)) {
                ?>
                    <tr>
                        <td><?php echo $order['IDDonHang']; ?></td>
                        <td><?php echo $order['NgayDat']; ?></td>
                        <td><?php echo number_format($order['TongTien']); ?> đ</td>
                        <td><?php echo $order['TrangThai']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>

    </div>
    

</div>

</div>
<script>
    /*hiện mk củ */
function togglePass(){
    var pass = document.getElementById("oldpass");
    var btn = document.querySelector(".show-pass");

    if(pass.type === "password"){
        pass.type = "text";
        btn.innerText = "Ẩn";
    }else{
        pass.type = "password";
        btn.innerText = "Hiện";
    }
}
</script>



<script>
    /*5s ẩn thông báo */
setTimeout(function(){
    var msgs = document.querySelectorAll(".success-msg, .error-msg");

    msgs.forEach(function(msg){
        msg.style.display = "none";
    });

},5000);
</script>
</body>
</html>