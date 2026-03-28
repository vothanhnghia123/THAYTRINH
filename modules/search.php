<?php
include("../config.php");

$key = $_GET['key'];

$sql = "SELECT sach.*, tacgia.TenTacGia
        FROM sach
        LEFT JOIN tacgia ON sach.IDTacGia = tacgia.IDTacGia
        WHERE sach.TenSach LIKE '%$key%' 
           OR tacgia.TenTacGia LIKE '%$key%'
        LIMIT 5";

$result = mysqli_query($connect,$sql);

while($row = mysqli_fetch_assoc($result)){
?>

<a  href="/THAYTRINH/singleproduct.php?id=<?php echo $row['IDSach']; ?>" class="search-item link">

    <img src="/THAYTRINH/image/sach/<?php echo $row['HinhAnh']; ?>" width="40">

    <span><?php echo $row['TenSach']; ?></span>

</a>

<?php
}
?>