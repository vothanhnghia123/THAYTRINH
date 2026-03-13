<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    // Lấy dữ liệu từ form (nếu có)
    $tennxb = isset($_POST["tennxb"]) ? $_POST["tennxb"] : "";
    $diachi = isset($_POST["diachi"]) ? $_POST["diachi"] : "";
    $dienthoai = isset($_POST["dienthoai"]) ? $_POST["dienthoai"] : "";

    # THÊM
    if (isset($_POST["them"])) {
        $sql = "INSERT INTO nhaxuatban(TenNXB, DiaChi, DienThoai) 
                VALUES('$tennxb', '$diachi', '$dienthoai')";
        
        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qlnhaxuatban&ac=them");
    }

    # XÓA
    else if (isset($_GET["xoa"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM nhaxuatban WHERE IDNXB='$id'";

        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qlnhaxuatban&ac=them");
    }

    # SỬA
    else if (isset($_POST["sua"])) {
        $id = $_GET["id"]; // Thường ID được lấy từ URL ở form sửa

        $sql = "UPDATE nhaxuatban 
                SET TenNXB = '$tennxb', 
                    DiaChi = '$diachi', 
                    DienThoai = '$dienthoai' 
                WHERE IDNXB = '$id'";

        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qlnhaxuatban&ac=them");
    }
?>