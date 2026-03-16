<?php
session_start();

$id = $_GET['id'];
$sl = $_GET['so_luong'];

if(isset($_SESSION['id_them_vao_gio'])){

    $trunglap = false;

    for($i=0;$i<count($_SESSION['id_them_vao_gio']);$i++){

        if($_SESSION['id_them_vao_gio'][$i] == $id){

            $_SESSION['sl_them_vao_gio'][$i] += $sl;
            $trunglap = true;
            break;
        }
    }

    if(!$trunglap){
        $_SESSION['id_them_vao_gio'][] = $id;
        $_SESSION['sl_them_vao_gio'][] = $sl;
    }

}else{

    $_SESSION['id_them_vao_gio'][0] = $id;
    $_SESSION['sl_them_vao_gio'][0] = $sl;

}

$dem = 0;

if(isset($_SESSION['sl_them_vao_gio'])){
    foreach($_SESSION['sl_them_vao_gio'] as $sl){
        $dem += $sl;
    }
}

echo $dem;
?>