<?php 
if(isset($_GET["ql"])){
    $temp = $_GET["ql"];
}else{
    $temp = "";
}

if($temp == 'qldanhmuc'){
    include('danhmuc/main.php');
}
else if($temp == "qltheloai"){
    include("theloai/main.php");
}
else if($temp == "qlsach"){
    include("sach/main.php");
}
else if($temp == "qltacgia"){
    include("tacgia/main.php");
}
else if($temp == "qlnhaxuatban"){
    include("nhaxuatban/main.php");
}
else if($temp == "qldonhang"){
    include("donhang/main.php");
}
else if($temp == "qlchitietdonhang"){
    include("chitietdonhang/main.php");
}
else{
    include('trangchu.php');
}
?>