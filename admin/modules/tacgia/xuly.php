<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    // Lấy dữ liệu từ POST
    $tentacgia = isset($_POST['tentacgia']) ? $_POST['tentacgia'] : "";
    $tieusu = isset($_POST['tieusu']) ? $_POST['tieusu'] : "";

    # THÊM
    if (isset($_POST['them'])) {
        $sql = "INSERT INTO tacgia(TenTacGia, TieuSu) 
                VALUES('$tentacgia', '$tieusu')";

        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qltacgia&ac=them");
    }

    # XÓA
    else if (isset($_GET['xoa'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM tacgia WHERE IDTacGia='$id'";

        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qltacgia&ac=them");
    }

    # SỬA
    else if (isset($_POST['sua'])) {
        $id = $_GET['id'];
        $sql = "UPDATE tacgia 
                SET TenTacGia = '$tentacgia', 
                    TieuSu = '$tieusu' 
                WHERE IDTacGia = '$id'";

        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qltacgia&ac=them");
    }
?>