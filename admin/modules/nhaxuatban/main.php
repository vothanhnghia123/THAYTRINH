<?php 
    if(isset($_GET['ac'])){
    $temp=$_GET['ac'];
  }else{
    $temp='';
  }
  if($temp =="them"){
    include("modules/nhaxuatban/them.php");
  }
    if($temp =="sua"){
    include("modules/nhaxuatban/sua.php");
  }
    // Hiển thị trang liệt kê
  include("modules/nhaxuatban/lietke.php");