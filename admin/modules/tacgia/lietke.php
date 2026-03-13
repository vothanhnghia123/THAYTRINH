<?php 
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $sql_tacgia = "SELECT * FROM tacgia";
    $load_tacgia = mysqli_query($connect, $sql_tacgia);
?>

<div class="hienthi">
    <table class="table-danhmuc">
        <tr>
            <th>ID</th>
            <th>Tên tác giả</th>
            <th>Tiểu sử</th>
            <th colspan="2">Quản lý</th>
        </tr>

        <?php 
        if (mysqli_num_rows($load_tacgia) > 0) {
            while ($row = mysqli_fetch_array($load_tacgia)) {
        ?>
                <tr>
                    <td><?php echo $row['IDTacGia']; ?></td>
                    <td><?php echo $row['TenTacGia']; ?></td>
                    <td style="max-width:300px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                        <?php echo $row['TieuSu']; ?>
                    </td>
                    <td>
                        <a onclick="return confirm('Bạn có chắc muốn xóa?')" 
                           href="modules/tacgia/xuly.php?xoa=1&id=<?php echo $row['IDTacGia']; ?>">
                           Xóa
                        </a>
                    </td>
                    <td>
                        <a href="index.php?ql=qltacgia&ac=sua&id=<?php echo $row['IDTacGia']; ?>">
                           Sửa
                        </a>
                    </td>
                </tr>
        <?php 
            }
        } else {
        ?>
            <tr>
                <td colspan="5" style="text-align:center;">Chưa có dữ liệu tác giả</td>
            </tr>
        <?php 
        } 
        ?>
    </table>
</div>