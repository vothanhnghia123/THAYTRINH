<?php
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");
$id = $_GET['id'];

$sql_danhmuc = "SELECT * FROM danhmuc WHERE IDDanhMuc='$id'";
$kq_danhmuc = mysqli_query($connect, $sql_danhmuc);
$kq_asarray = mysqli_fetch_assoc($kq_danhmuc);
?>
<div class="admin-form-box">
    <form action="modules/danhmuc/xuly.php?id=<?php echo $kq_asarray['IDDanhMuc']; ?>" 
        method="post" enctype="multipart/form-data">

        <div class="admin-form-title">
            Form dữ liệu
        </div>

        <div class="admin-form-group">
            <label>Id Navbar</label>
            <input class="admin-input" type="text" name="iddanhmuc"
                value="<?php echo $kq_asarray['IDDanhMuc']; ?>" required>
        </div>

        <div class="admin-form-group">
            <label>Tên Navbar</label>
            <input class="admin-input" type="text" name="tendanhmuc"
                value="<?php echo $kq_asarray['TenDanhMuc']; ?>" required>
        </div>


        <div class="admin-form-group">
            <input class="admin-submit-btn" type="submit" name="sua" value="Xử lý">
        </div>

    </form>
</div>