<?php
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");

$sql = "SELECT danhgia.*, sach.TenSach, nguoidung.HoTen
        FROM danhgia
        JOIN sach ON danhgia.IDSach = sach.IDSach
        JOIN nguoidung ON danhgia.IDNguoiDung = nguoidung.IDNguoiDung
        ORDER BY IDDanhGia DESC";

$result = mysqli_query($connect, $sql);
?>

<div class="hienthi">
    <table class="table-lietke">
        <tr>
            <th>ID Đánh giá</th>
            <th>Sách</th>
            <th>Người dùng</th>
            <th>Số sao</th>
            <th>Nội dung</th>
            <th>Ngày đánh giá</th>
        </tr>

        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $row['IDDanhGia']; ?></td>
                <td><?php echo $row['TenSach']; ?></td>
                <td><?php echo $row['HoTen']; ?></td>

                <td>
                    <?php
                    for ($i = 1; $i <= $row['SoSao']; $i++) {
                        echo "⭐";
                    }
                    ?>
                </td>

                <td><?php echo $row['NoiDung']; ?></td>

                <td>
                    <?php echo date("d/m/Y H:i", strtotime($row['NgayDanhGia'])); ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>