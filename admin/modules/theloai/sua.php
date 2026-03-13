<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $id = $_GET['id'];

    // Lấy dữ liệu của thể loại cần sửa
    $sql = "SELECT * FROM theloai WHERE IDTheLoai='$id'";
    $kq = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($kq);

    // Lấy danh sách danh mục để đổ vào dropdown
    $sql_danhmuc = "SELECT * FROM danhmuc";
    $danhmuc = mysqli_query($connect, $sql_danhmuc);
?>

<div class="admin-form-box">
    <form action="modules/theloai/xuly.php?id=<?php echo $row['IDTheLoai']; ?>" method="post">

        <div class="admin-form-title">
            Cập Nhật Thể Loại
        </div>

        <div class="admin-form-group">
            <label>Tên thể loại</label>
            <input class="admin-input" type="text" name="tentheloai" value="<?php echo $row['TenTheLoai']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Danh mục</label>
            <select class="admin-input" name="iddanhmuc">
                <?php
                while($dm = mysqli_fetch_array($danhmuc)){
                ?>
                    <option value="<?php echo $dm['IDDanhMuc']; ?>" 
                        <?php if($dm['IDDanhMuc'] == $row['IDDanhMuc']) { echo "selected"; } ?>>
                        <?php echo $dm['TenDanhMuc']; ?>
                    </option>
                <?php 
                } 
                ?>
            </select>
        </div>

        <div class="admin-form-group">
            <input class="admin-submit-btn" type="submit" name="sua" value="Lưu thay đổi">
        </div>

    </form>
</div>