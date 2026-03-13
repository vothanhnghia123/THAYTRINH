<?php 
$connect = mysqli_connect("localhost","root","","bansach");
mysqli_set_charset($connect,"utf8");

$sql_danhmuc = "SELECT * FROM danhmuc";
$load_danhmuc = mysqli_query($connect,$sql_danhmuc);
?>

<div class="hienthi">
<table class="table-danhmuc">

<tr>
    <th>ID</th>
    <th>Tên danh mục</th>
    <th colspan="2">Quản lý</th>
</tr>

<?php 
    if(mysqli_num_rows($load_danhmuc) > 0){
        while($row = mysqli_fetch_array($load_danhmuc)){
    ?>

    <tr>
        <td><?php echo $row["IDDanhMuc"]; ?></td>

         <td><?php echo $row["TenDanhMuc"]; ?></td>

    <td>
        <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')" 
            href="modules/danhmuc/xuly.php?xoa=1&id=<?php echo $row["IDDanhMuc"]; ?>">
            Xóa
        </a>
    </td>

    <td>
        <a href="index.php?ql=qldanhmuc&ac=sua&id=<?php echo $row['IDDanhMuc']; ?>">Sửa</a>
    </td>
</tr>

<?php 
    }
}else{
?>

<tr>
<td colspan="4">Chưa có danh mục</td>
</tr>

<?php } ?>

</table>
</div>