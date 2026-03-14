<?php 
    if(isset($_GET['ac'])){
    $temp=$_GET['ac'];
  }else{
    $temp='';
  }
  if($temp =="them"){
    include("modules/sach/them.php");
  }
    if($temp =="sua"){
    include("modules/sach/sua.php");
  }
    // Hiển thị trang liệt kê
  include("modules/sach/lietke.php");