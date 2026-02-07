<?php 
    if(isset($_GET["ql"])){
      $temp=$_GET["ql"];
    }else {
      $temp="";
    }
    if($temp=='qldanhmuc'){
        include('danhmuc/main.php');
    };
    include('trangchu.php')

?>