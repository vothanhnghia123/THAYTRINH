<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $sql = "SELECT * FROM danhmuc";
    $danhmuc = mysqli_query($connect, $sql);
?>

<div class="admin-form-box">
    <form action="modules/theloai/xuly.php" method="post">

        <div class="admin-form-title">
            Form dữ liệu
        </div>

        <div class="admin-form-group">
            <label>Tên thể loại</label>
            <input class="admin-input" type="text" name="tentheloai">
        </div>

        <div class="admin-form-group">
            <label>Danh mục</label>
            <select class="admin-input" name="iddanhmuc">
                <option value="">-- Chọn danh mục --</option>
                <?php
                while($row = mysqli_fetch_array($danhmuc)){
                ?>
                    <option value="<?php echo $row['IDDanhMuc']; ?>">
                        <?php echo $row['TenDanhMuc']; ?>
                    </option>
                <?php 
                } 
                ?>
            </select>
        </div>

        <div class="admin-form-group">
            <input class="admin-submit-btn" type="submit" name="them" value="Xử lý">
        </div>

    </form>
</div>