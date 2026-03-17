<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    // Sắp xếp đơn hàng mới nhất lên đầu (DESC)
    $sql = "SELECT * FROM donhang ORDER BY IDDonHang DESC";
    $result = mysqli_query($connect, $sql);
?>

<div class="hienthi">
    <table class="table-lietke">
        <tr>
            <th>ID Đơn</th>
            <th>ID Người dùng</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <tr>
                    <td><?php echo $row['IDDonHang']; ?></td>
                    <td><?php echo $row['IDNguoiDung']; ?></td>
                    <td><?php echo date("d/m/Y H:i", strtotime($row['NgayDat'])); ?></td>
                    <td><b style="color: red;"><?php echo number_format($row['TongTien'], 0, ",", "."); ?> VNĐ</b></td>
                    <td>
                        <?php 
                            // Gợi ý: Hiển thị trạng thái theo màu sắc để dễ quản lý
                            if ($row['TrangThai'] == 0) echo '<span style="color: blue;">Đơn hàng mới</span>';
                            else if ($row['TrangThai'] == 1) echo '<span style="color: green;">Đã xử lý</span>';
                            else echo '<span style="color: gray;">Đã hủy</span>';
                        ?>
                    </td>
                </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td colspan="5" style="text-align:center;">
                    Chưa có đơn hàng nào trong hệ thống.
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>