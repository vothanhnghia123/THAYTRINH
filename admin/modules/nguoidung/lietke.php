<?php
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");

$sql = "SELECT * FROM nguoidung ORDER BY IDNguoiDung DESC";
$result = mysqli_query($connect, $sql);
?>

<div class="hienthi">
    <table class="table-lietke">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Vai trò</th>
            <th>Hành động</th>
            
        </tr>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_array($result)) { ?>

                <tr>
                        <td><?php echo $row['IDNguoiDung']; ?></td>
                        <td><?php echo $row['HoTen']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['DienThoai']; ?></td>
                        <td><?php echo $row['DiaChi']; ?></td>

                        <td id="role-<?= $row['IDNguoiDung'] ?>">
                            <?php echo ($row['IDVaiTro']==1) ? "Admin" : "User"; ?>
                        </td>

                        <td id="action-<?= $row['IDNguoiDung'] ?>">
                            <?php if($row['IDVaiTro'] != 1){ ?>
                                <button class="btn-cap" onclick="capQuyen(<?= $row['IDNguoiDung'] ?>)">
                                    Cấp admin
                                </button>
                            <?php } else { ?>
                                <button class="btn-ha" onclick="haQuyen(<?= $row['IDNguoiDung'] ?>)">
                                    Hạ quyền
                                </button>
                            <?php } ?>
                        </td>
                   
                </tr>

            <?php } ?>
        <?php } else { ?>

            <tr>
                <td colspan="6" style="text-align:center;">Chưa có người dùng nào trong hệ thống.</td>
            </tr>

        <?php } ?>
    </table>
</div>
<script>
function capQuyen(id){
    fetch('modules/nguoidung/capquyen.php?id=' + id)
    .then(res => res.text())
    .then(data => {
        document.getElementById("role-"+id).innerText = "Admin";

        document.getElementById("action-"+id).innerHTML = 
            '<button class="btn-ha" onclick="haQuyen('+id+')">Hạ quyền</button>';
    });
}

function haQuyen(id){
    fetch('modules/nguoidung/haquyen.php?id=' + id)
    .then(res => res.text())
    .then(data => {
        document.getElementById("role-"+id).innerText = "User";

        document.getElementById("action-"+id).innerHTML = 
           '<button class="btn-cap" onclick="capQuyen('+id+')">Cấp admin</button>';
    });
}
</script>