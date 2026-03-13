<?php 
if(isset($_GET['ac'])){
    $temp = $_GET['ac'];
}else{
    $temp = '';
}

if($temp == "them"){
    include("modules/danhmuc/them.php");
}
else if($temp == "sua"){
    include("modules/danhmuc/sua.php");
}

include("modules/danhmuc/lietke.php");
?>