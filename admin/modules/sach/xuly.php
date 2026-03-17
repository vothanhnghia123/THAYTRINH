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

    if(!empty($_FILES['hinhanh']['name'])){

        $hinhanh = time().'_'.$_FILES['hinhanh']['name'];
        $tmp = $_FILES['hinhanh']['tmp_name'];

            $allow = ['jpg','png','jpeg'];
            $ext = strtolower(pathinfo($hinhanh, PATHINFO_EXTENSION));

            if(!in_array($ext,$allow)){
                echo "Chỉ cho phép jpg/png!";
                exit();
            }

        move_uploaded_file($tmp,"modules/sach/upload/".$hinhanh);
    } else {
        $hinhanh = ""; // hoặc ảnh mặc định
    }

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
    $duongdan = __DIR__ . "/upload/";

    if(!empty($_FILES['hinhanh']['name'])){

        $hinhanh = $_FILES['hinhanh']['name'];
        $tmp = $_FILES['hinhanh']['tmp_name'];

        $allow = ['jpg','png','jpeg'];
        $ext = strtolower(pathinfo($hinhanh, PATHINFO_EXTENSION));

        if(!in_array($ext,$allow)){
            echo "Chỉ cho phép jpg/png!";
            exit();
        }

        if(move_uploaded_file($tmp, $duongdan.$hinhanh)){

            // lấy ảnh cũ
            $sql_old = "SELECT HinhAnh FROM sach WHERE IDSach='$id'";
            $query_old = mysqli_query($connect,$sql_old);
            $row_old = mysqli_fetch_assoc($query_old);

            // xóa ảnh cũ
            if(!empty($row_old['HinhAnh']) && file_exists($duongdan.$row_old['HinhAnh'])){
                unlink($duongdan.$row_old['HinhAnh']);
            }

            // update có ảnh
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
        } else {
            echo "Upload ảnh thất bại!";
            exit();
        }

    } else {
        // update KHÔNG đổi ảnh
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