<?php 
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    $tendanhmuc = "";

if(isset($_POST["tendanhmuc"])){
    $tendanhmuc = $_POST["tendanhmuc"];
}

/* THÊM DANH MỤC */
if(isset($_POST["them"])){

    $sql = "INSERT INTO danhmuc(tendanhmuc)
            VALUES('$tendanhmuc')";

    mysqli_query($connect,$sql);

    header("location:../../index.php?ql=qldanhmuc&ac=them");
}


/* SỬA DANH MỤC */
if(isset($_POST["sua"])){

    $id = $_GET['id'];

    $sql = "UPDATE danhmuc 
            SET tendanhmuc='$tendanhmuc'
            WHERE iddanhmuc='$id'";

    mysqli_query($connect,$sql);

    header("location:../../index.php?ql=qldanhmuc&ac=sua&id=".$id);
}


/* XÓA DANH MỤC */
if(isset($_GET['xoa'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM danhmuc 
            WHERE iddanhmuc='$id'";

    mysqli_query($connect,$sql);

    header("location:../../index.php?ql=qldanhmuc&ac=them");
}




?>