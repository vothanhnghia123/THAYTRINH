<?php 
    if(isset($_GET['ac'])){
    $temp=$_GET['ac'];
  }else{
    $temp='';
  }
  if($temp =="them"){
    include("modules/danhmuc/them.php");
  }
?>