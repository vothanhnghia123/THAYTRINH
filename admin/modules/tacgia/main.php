<?php 
    if(isset($_GET['ac'])){
    $temp=$_GET['ac'];
  }else{
    $temp='';
  }
  if($temp =="them"){
    include("modules/tacgia/them.php");
  }
    if($temp =="sua"){
    include("modules/tacgia/sua.php");
  }
    // Hiển thị trang liệt kê
  include("modules/tacgia/lietke.php");