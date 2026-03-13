<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $id = $_GET['id'];

    $sql_nxb = "SELECT * FROM nhaxuatban WHERE IDNXB='$id'";
    $kq_nxb = mysqli_query($connect, $sql_nxb);
    $row = mysqli_fetch_assoc($kq_nxb);
?>

<div class="admin-form-box">
    <form action="modules/nhaxuatban/xuly.php?id=<?php echo $row['IDNXB']; ?>" method="post">

        <div class="admin-form-title">
            Cập Nhật Nhà Xuất Bản
        </div>

        <div class="admin-form-group">
            <label>ID Nhà xuất bản</label>
            <input class="admin-input" type="text" name="idnxb" 
                   value="<?php echo $row['IDNXB']; ?>" readonly>
        </div>

        <div class="admin-form-group">
            <label>Tên nhà xuất bản</label>
            <input class="admin-input" type="text" name="tennxb" 
                   value="<?php echo $row['TenNXB']; ?>" required>
        </div>

        <div class="admin-form-group">
            <label>Địa chỉ</label>
            <input class="admin-input" type="text" name="diachi" 
                   value="<?php echo $row['DiaChi']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Điện thoại</label>
            <input class="admin-input" type="text" name="dienthoai" 
                   value="<?php echo $row['DienThoai']; ?>">
        </div>

        <div class="admin-form-group">
            <input class="admin-submit-btn" type="submit" name="sua" value="Lưu thay đổi">
        </div>

    </form>
</div>