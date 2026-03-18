
<?php
include("../config.php");
mysqli_set_charset($connect,"utf8");

// Tổng doanh thu (theo ngày hôm nay)
$sql_doanhthu = "SELECT SUM(TongTien) as doanhthu 
                 FROM donhang 
                 WHERE DATE(NgayDat) = CURDATE()";
$kq_doanhthu = mysqli_query($connect, $sql_doanhthu);
$row_doanhthu = mysqli_fetch_assoc($kq_doanhthu);
$doanhthu = $row_doanhthu['doanhthu'] ?? 0;

// Đơn hàng mới (chờ xử lý)
$sql_donhang = "SELECT COUNT(*) as soluong 
                FROM donhang 
                WHERE TrangThai = 'chờ xử lý'";
$kq_donhang = mysqli_query($connect, $sql_donhang);
$row_donhang = mysqli_fetch_assoc($kq_donhang);
$donhang_moi = $row_donhang['soluong'];

// Tổng số sách
$sql_sach = "SELECT COUNT(*) as tong FROM sach";
$kq_sach = mysqli_query($connect, $sql_sach);
$row_sach = mysqli_fetch_assoc($kq_sach);
$tong_sach = $row_sach['tong'];

// Tổng khách hàng
$sql_user = "SELECT COUNT(*) as tong FROM nguoidung";
$kq_user = mysqli_query($connect, $sql_user);
$row_user = mysqli_fetch_assoc($kq_user);
$tong_user = $row_user['tong'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="dashboard">

    <h2>Trang Quản Trị</h2>

    <div class="dashboard-grid">

        <!-- Doanh thu -->
        <div class="card">
            <h4>Tổng doanh thu (hôm nay)</h4>
            <p class="number">
                <?php echo number_format($doanhthu,0,",","."); ?> đ
            </p>
        </div>

        <!-- Đơn hàng -->
        <div class="card">
            <h4>Đơn hàng mới</h4>
            <p class="number">
                <?php echo $donhang_moi; ?>
            </p>
        </div>

        <!-- Sách -->
        <div class="card">
            <h4>Tổng số sách</h4>
            <p class="number">
                <?php echo $tong_sach; ?>
            </p>
        </div>

        <!-- Khách hàng -->
        <div class="card">
            <h4>Khách hàng</h4>
            <p class="number">
                <?php echo $tong_user; ?>
            </p>
        </div>

    </div>

</div>
</body>
</html>