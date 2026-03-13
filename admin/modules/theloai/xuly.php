<?php 
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");

$tentheloai = "";
$iddanhmuc = "";

if(isset($_POST["tentheloai"])){
    $tentheloai = $_POST["tentheloai"];
}

if(isset($_POST["iddanhmuc"])){
    $iddanhmuc = $_POST["iddanhmuc"];
}


/* THÊM THỂ LOẠI */

if(isset($_POST["them"])){

    $tentheloai = $_POST["tentheloai"];
    $iddanhmuc = $_POST["iddanhmuc"];

    $sql = "INSERT INTO theloai(TenTheLoai,IDDanhMuc)
            VALUES('$tentheloai','$iddanhmuc')";

    mysqli_query($connect,$sql);

    header("location:../../index.php?ql=qltheloai&ac=them");
}


/* SỬA THỂ LOẠI */

if(isset($_POST["sua"])){

$id = $_GET["id"];

$sql = "UPDATE theloai
SET TenTheLoai='$tentheloai',
IDDanhMuc='$iddanhmuc'
WHERE IDTheLoai='$id'";

mysqli_query($connect,$sql);

header("location:../../index.php?ql=qltheloai");

}


/* XÓA THỂ LOẠI */

if(isset($_GET["xoa"])){

$id = $_GET["id"];

$sql = "DELETE FROM theloai
WHERE IDTheLoai='$id'";

mysqli_query($connect,$sql);

header("location:../../index.php?ql=qltheloai");

}

?>