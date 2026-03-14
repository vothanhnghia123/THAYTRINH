<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $id = $_GET['id'];

    // Lấy thông tin cuốn sách cần sửa
    $sql = "SELECT * FROM sach WHERE IDSach='$id'";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($query);

    // Lấy dữ liệu cho các dropdown
    $theloai = mysqli_query($connect, "SELECT * FROM theloai");
    $nxb = mysqli_query($connect, "SELECT * FROM nhaxuatban");
    $tacgia = mysqli_query($connect, "SELECT * FROM tacgia");
?>

<div class="admin-form-box">
    <form action="modules/sach/xuly.php?id=<?php echo $row['IDSach']; ?>" method="post" enctype="multipart/form-data">

        <div class="admin-form-title">Cập Nhật Thông Tin Sách</div>

        <div class="admin-form-group">
            <label>Tên sách</label>
            <input class="admin-input" type="text" name="tensach" value="<?php echo $row['TenSach']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Thể loại</label>
            <select class="admin-input" name="idtheloai">
                <?php while($tl = mysqli_fetch_array($theloai)){ ?>
                    <option value="<?php echo $tl['IDTheLoai']; ?>" 
                        <?php if($tl['IDTheLoai'] == $row['IDTheLoai']) echo "selected"; ?>>
                        <?php echo $tl['TenTheLoai']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="admin-form-group">
            <label>Nhà xuất bản</label>
            <select class="admin-input" name="idnxb">
                <?php while($n = mysqli_fetch_array($nxb)){ ?>
                    <option value="<?php echo $n['IDNXB']; ?>" 
                        <?php if($n['IDNXB'] == $row['IDNXB']) echo "selected"; ?>>
                        <?php echo $n['TenNXB']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="admin-form-group">
            <label>Tác giả</label>
            <select class="admin-input" name="idtacgia">
                <?php while($tg = mysqli_fetch_array($tacgia)){ ?>
                    <option value="<?php echo $tg['IDTacGia']; ?>" 
                        <?php if($tg['IDTacGia'] == $row['IDTacGia']) echo "selected"; ?>>
                        <?php echo $tg['TenTacGia']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="admin-form-group">
            <label>Giá bán</label>
            <input class="admin-input" type="text" name="giaban" value="<?php echo $row['GiaBan']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Số lượng</label>
            <input class="admin-input" type="text" name="soluong" value="<?php echo $row['SoLuong']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Số trang</label>
            <input class="admin-input" type="text" name="sotrang" value="<?php echo $row['SoTrang']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Năm xuất bản</label>
            <input class="admin-input" type="text" name="namxb" value="<?php echo $row['NamXB']; ?>">
        </div>

        <div class="admin-form-group">
            <label>Mô tả</label>
            <textarea class="admin-input" name="mota" rows="5"><?php echo $row['MoTa']; ?></textarea>
        </div>

        <div class="admin-form-group">
            <label>Hình ảnh hiện tại</label>
            <input class="admin-input" type="file" name="hinhanh">
            <div style="margin-top: 10px;">
                <img src="modules/sach/upload/<?php echo $row['HinhAnh']; ?>" width="80" style="border: 1px solid #ddd;">
            </div>
        </div>

        <div class="admin-form-group">
            <input class="admin-submit-btn" type="submit" name="sua" value="Lưu thay đổi">
        </div>

    </form>
</div>