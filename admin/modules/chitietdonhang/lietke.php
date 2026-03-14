<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    // Lấy chi tiết đơn hàng kèm tên sách để dễ nhận biết
    $sql = "
        SELECT chitietdonhang.*, sach.TenSach
        FROM chitietdonhang
        LEFT JOIN sach ON chitietdonhang.IDSach = sach.IDSach
        ORDER BY IDCTDH DESC
    ";

    $result = mysqli_query($connect, $sql);
?>

<div class="hienthi">
    <table class="table-danhmuc">
        <tr>
            <th>ID CTĐH</th>
            <th>ID Đơn</th>
            <th>Tên sách</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $thanhtien = $row['SoLuong'] * $row['DonGia'];
        ?>
                <tr>
                    <td><?php echo $row['IDCTDH']; ?></td>
                    <td><?php echo $row['IDDonHang']; ?></td>
                    <td><?php echo $row['TenSach']; ?></td>
                    <td style="text-align: center;"><?php echo $row['SoLuong']; ?></td>
                    <td><?php echo number_format($row['DonGia'], 0, ",", "."); ?> VNĐ</td>
                    <td><b style="color: #2e7d32;"><?php echo number_format($thanhtien, 0, ",", "."); ?> VNĐ</b></td>
                </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td colspan="6" style="text-align:center; padding: 20px;">
                    Chưa có dữ liệu chi tiết cho các đơn hàng.
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>