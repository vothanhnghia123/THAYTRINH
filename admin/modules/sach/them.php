<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $theloai = mysqli_query($connect, "SELECT * FROM theloai");
    $nxb = mysqli_query($connect, "SELECT * FROM nhaxuatban");
    $tacgia = mysqli_query($connect, "SELECT * FROM tacgia");
?>

<div class="admin-form-box">
    <form action="modules/sach/xuly.php" method="post" enctype="multipart/form-data">

        <div class="admin-form-title">Thêm Sách Mới</div>

        <div class="admin-form-group">
            <label>Tên sách</label>
            <input class="admin-input" type="text" name="tensach" required>
        </div>

        <div class="admin-form-group">
            <label>Thể loại</label>
            <select class="admin-input" name="idtheloai">
                <?php while($row = mysqli_fetch_array($theloai)){ ?>
                    <option value="<?php echo $row['IDTheLoai'] ?>">
                        <?php echo $row['TenTheLoai'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="admin-form-group">
            <label>Nhà xuất bản</label>
            <select class="admin-input" name="idnxb">
                <?php while($row = mysqli_fetch_array($nxb)){ ?>
                    <option value="<?php echo $row['IDNXB'] ?>">
                        <?php echo $row['TenNXB'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="admin-form-group">
            <label>Tác giả</label>
            <select class="admin-input" name="idtacgia">
                <?php while($row = mysqli_fetch_array($tacgia)){ ?>
                    <option value="<?php echo $row['IDTacGia'] ?>">
                        <?php echo $row['TenTacGia'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="admin-form-group">
            <label>Giá bán</label>
            <input class="admin-input" type="text" name="giaban">
        </div>

        <div class="admin-form-group">
            <label>Số lượng</label>
            <input class="admin-input" type="text" name="soluong">
        </div>

        <div class="admin-form-group">
            <label>Số trang</label>
            <input class="admin-input" type="text" name="sotrang">
        </div>

        <div class="admin-form-group">
            <label>Năm xuất bản</label>
            <input class="admin-input" type="text" name="namxb">
        </div>

        <div class="admin-form-group">
            <label>Mô tả</label>
            <textarea class="admin-input" name="mota" rows="5"></textarea>
        </div>

        <div class="admin-form-group">
            <label>Hình ảnh</label>
            <input type="file" name="hinhanh">
        </div>

        <div class="admin-form-group">
            <input class="admin-submit-btn" type="submit" name="them" value="Thêm">
        </div>

    </form>
</div>