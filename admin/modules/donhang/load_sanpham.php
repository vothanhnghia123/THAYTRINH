<?php
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");

$id = $_POST['id'];

$sql = "SELECT chitietdonhang.*, sach.TenSach
        FROM chitietdonhang
        JOIN sach ON chitietdonhang.IDSach = sach.IDSach
        WHERE IDDonHang = $id";

$result = mysqli_query($connect, $sql);

while($row = mysqli_fetch_array($result)){
    echo "<p>".$row['TenSach']." - SL: ".$row['SoLuong']." - Giá: ".number_format($row['DonGia'])." VNĐ</p>";
}
?>