<?php 
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

   $sql_theloai = "SELECT theloai.*, danhmuc.TenDanhMuc 
    FROM theloai
    INNER JOIN danhmuc 
    ON theloai.IDDanhMuc = danhmuc.IDDanhMuc";

    $load_theloai = mysqli_query($connect,$sql_theloai);
?>

<div class="hienthi">
    <table class="table-lietke">
        <tr>
            <th>ID</th>
            <th>Tên thể loại</th>
            <th>Danh mục</th>
            <th colspan="2">Quản lý</th>
        </tr>

        <?php 
        if (mysqli_num_rows($load_theloai) > 0) {
            while ($row = mysqli_fetch_array($load_theloai)) {
        ?>
                <tr>
                    <td><?php echo $row["IDTheLoai"]; ?></td>
                    <td><?php echo $row["TenTheLoai"]; ?></td>
                    <td><?php echo $row["TenDanhMuc"]; ?></td>
                    <td>
                        <a onclick="return confirm('Bạn có chắc muốn xóa?')" 
                            href="modules/theloai/xuly.php?xoa=1&id=<?php echo $row['IDTheLoai']; ?>">
                            Xóa
                        </a>
                        |
                        <a href="index.php?ql=qltheloai&ac=sua&id=<?php echo $row['IDTheLoai']; ?>">
                            Sửa
                        </a>
                    </td>
                </tr>
        <?php 
            }
        } else {
        ?>
            <tr>
                <td colspan="5">Chưa có thể loại</td>
            </tr>
        <?php 
        } 
        ?>
    </table>
</div>