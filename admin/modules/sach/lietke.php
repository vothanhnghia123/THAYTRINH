<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $sql = "
        SELECT sach.*, theloai.TenTheLoai, nhaxuatban.TenNXB, tacgia.TenTacGia
        FROM sach
        LEFT JOIN theloai ON sach.IDTheLoai = theloai.IDTheLoai
        LEFT JOIN nhaxuatban ON sach.IDNXB = nhaxuatban.IDNXB
        LEFT JOIN tacgia ON sach.IDTacGia = tacgia.IDTacGia
    ";

    $result = mysqli_query($connect, $sql);
?>

<table class="table-danhmuc">
    <tr>
        <th>ID</th>
        <th>Tên sách</th>
        <th>Thể loại</th>
        <th>NXB</th>
        <th>Tác giả</th>
        <th>Giá</th>
        <th>Năm XB</th>
        <th>Hình</th>
        <th>Quản lý</th>
    </tr>

    <?php 
    // Kiểm tra xem có cuốn sách nào trong database không
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) { 
    ?>
            <tr>
                <td><?php echo $row['IDSach']; ?></td>
                <td><?php echo $row['TenSach']; ?></td>
                <td><?php echo $row['TenTheLoai']; ?></td>
                <td><?php echo $row['TenNXB']; ?></td>
                <td><?php echo $row['TenTacGia']; ?></td>
                <td><?php echo number_format($row['GiaBan'], 0, ",", "."); ?> VNĐ</td>
                <td><?php echo $row['NamXB']; ?></td>
                <td>
                    <img src="modules/sach/upload/<?php echo $row['HinhAnh']; ?>" width="60" alt="Hình sách">
                </td>
                <td>
                    <a onclick="return confirm('Bạn có chắc muốn xóa?')" 
                       href="modules/sach/xuly.php?xoa=1&id=<?php echo $row['IDSach']; ?>">
                       Xóa
                    </a>
                    |
                    <a href="index.php?ql=qlsach&ac=sua&id=<?php echo $row['IDSach']; ?>">
                       Sửa
                    </a>
                </td>
            </tr>
    <?php 
        } 
    } else { 
        // Thông báo khi không có dữ liệu
    ?>
        <tr>
            <td colspan="9" style="text-align: center; padding: 20px;">
                Hiện tại chưa có cuốn sách nào trong danh sách.
            </td>
        </tr>
    <?php 
    } 
    ?>
</table>