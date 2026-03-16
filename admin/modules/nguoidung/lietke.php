<?php
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");

$sql = "SELECT * FROM nguoidung ORDER BY IDNguoiDung DESC";
$result = mysqli_query($connect, $sql);
?>

<div class="hienthi">
    <table class="table-danhmuc">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            
        </tr>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_array($result)) { ?>

                <tr>
                    <td><?php echo $row['IDNguoiDung']; ?></td>
                    <td><?php echo $row['HoTen']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['DienThoai']; ?></td>
                    <td><?php echo $row['DiaChi']; ?></td>

                    
                </tr>

            <?php } ?>
        <?php } else { ?>

            <tr>
                <td colspan="6" style="text-align:center;">Chưa có người dùng nào trong hệ thống.</td>
            </tr>

        <?php } ?>
    </table>
</div>