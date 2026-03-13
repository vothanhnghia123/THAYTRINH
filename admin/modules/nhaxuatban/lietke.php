<?php 
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");

$sql_nxb = "SELECT * FROM nhaxuatban";
$load_nxb = mysqli_query($connect,$sql_nxb);
?>

<div class="hienthi">
<table class="table-danhmuc">

<tr>
    <th>ID</th>
    <th>Tên NXB</th>
    <th>Địa chỉ</th>
    <th>Điện thoại</th>
    <th colspan="2">Quản lý</th>
</tr>

<?php 
if(mysqli_num_rows($load_nxb) > 0){
    while($row = mysqli_fetch_array($load_nxb)){
?>

<tr>
    <td><?php echo $row["IDNXB"]; ?></td>

    <td><?php echo $row["TenNXB"]; ?></td>

    <td><?php echo $row["DiaChi"]; ?></td>

    <td><?php echo $row["DienThoai"]; ?></td>

    <td>
        <a onclick="return confirm('Bạn có chắc muốn xóa nhà xuất bản này không?')" 
        href="index.php?ql=qlnxb&ac=sua&id=<?php echo $row['IDNXB']; ?>">
        Xóa
        </a>
    </td>

    <td>
        <a href="index.php?ql=qlnhaxuatban&ac=sua&id=<?php echo $row['IDNXB']; ?>">
        Sửa
        </a>
    </td>

</tr>

<?php 
    }
}else{
?>

<tr>
<td colspan="6">Chưa có nhà xuất bản</td>
</tr>

<?php } ?>

</table>
</div>