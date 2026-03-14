<?php
    $connect = mysqli_connect("localhost", "root", "", "bansach");
    mysqli_set_charset($connect, "utf8");

    // Lấy dữ liệu từ POST
    $tensach    = $_POST['tensach'] ?? "";
    $idtheloai  = $_POST['idtheloai'] ?? "";
    $idnxb      = $_POST['idnxb'] ?? "";
    $idtacgia   = $_POST['idtacgia'] ?? "";
    $giaban     = $_POST['giaban'] ?? "";
    $soluong    = $_POST['soluong'] ?? "";
    $sotrang    = $_POST['sotrang'] ?? "";
    $namxb      = $_POST['namxb'] ?? "";
    $mota       = $_POST['mota'] ?? "";

    // Xử lý hình ảnh
    $hinhanh    = $_FILES['hinhanh']['name'] ?? "";
    $tmp        = $_FILES['hinhanh']['tmp_name'] ?? "";

    # ================= THÊM =================
    if (isset($_POST['them'])) {
        move_uploaded_file($tmp, "upload/" . $hinhanh);

        $sql = "INSERT INTO sach(TenSach, IDTheLoai, IDNXB, IDTacGia, GiaBan, SoLuong, MoTa, HinhAnh, SoTrang, NamXB) 
                VALUES('$tensach', '$idtheloai', '$idnxb', '$idtacgia', '$giaban', '$soluong', '$mota', '$hinhanh', '$sotrang', '$namxb')";

        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qlsach&ac=them");
    }

    # ================= XÓA =================
    else if (isset($_GET['xoa'])) {
        $id = $_GET['id'];
        
        // (Tùy chọn) Thêm code xóa file ảnh vật lý trong thư mục uploads tại đây nếu muốn sạch host
        
        $sql = "DELETE FROM sach WHERE IDSach='$id'";
        mysqli_query($connect, $sql);
        header("location:../../index.php?ql=qlsach&ac=them");
    }

    # ================= SỬA =================
    else if(isset($_POST['sua'])){

    $id = $_GET['id'];

    if(!empty($_FILES['hinhanh']['name'])){

        $hinhanh = $_FILES['hinhanh']['name'];
        $tmp = $_FILES['hinhanh']['tmp_name'];

        move_uploaded_file($tmp,"sach/upload/".$hinhanh);

        $sql = "UPDATE sach SET
                TenSach='$tensach',
                IDTheLoai='$idtheloai',
                IDNXB='$idnxb',
                IDTacGia='$idtacgia',
                GiaBan='$giaban',
                SoLuong='$soluong',
                MoTa='$mota',
                HinhAnh='$hinhanh',
                SoTrang='$sotrang',
                NamXB='$namxb'
                WHERE IDSach='$id'";

    }
    else{

        $sql = "UPDATE sach SET
                TenSach='$tensach',
                IDTheLoai='$idtheloai',
                IDNXB='$idnxb',
                IDTacGia='$idtacgia',
                GiaBan='$giaban',
                SoLuong='$soluong',
                MoTa='$mota',
                SoTrang='$sotrang',
                NamXB='$namxb'
                WHERE IDSach='$id'";

    }

    mysqli_query($connect,$sql);

    header("location:../../index.php?ql=qlsach&ac=them");

    }
?>