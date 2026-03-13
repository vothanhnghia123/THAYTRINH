<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $id = $_GET['id'];

    $sql = "SELECT * FROM tacgia WHERE IDTacGia='$id'";
    $kq = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($kq);
?>

<div class="admin-form-box">
    <form action="modules/tacgia/xuly.php?id=<?php echo $row['IDTacGia']; ?>" method="post">

        <div class="admin-form-title">
            Cập Nhật Thông Tin Tác Giả
        </div>

        <div class="admin-form-group">
            <label>ID</label>
            <input class="admin-input" type="text" value="<?php echo $row['IDTacGia']; ?>" readonly>
        </div>

        <div class="admin-form-group">
            <label>Tên tác giả</label>
            <input class="admin-input" type="text" name="tentacgia" value="<?php echo $row['TenTacGia']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Tiểu sử</label>
            <textarea class="admin-input" name="tieusu" rows="5"><?php echo $row['TieuSu']; ?></textarea>
        </div>

        <div class="admin-form-group">
            <input class="admin-submit-btn" type="submit" name="sua" value="Lưu thay đổi">
        </div>

    </form>
</div>