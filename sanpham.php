<?php
include("config.php");

$title = "";

// ================== BƯỚC 1: XỬ LÝ ĐIỀU KIỆN ==================
$where = "";
$join = "";

if(isset($_GET['danhmuc'])){
    $id = intval($_GET['danhmuc']);
    $where = "WHERE theloai.IDDanhMuc = '$id'";
    $join = "JOIN theloai ON sach.IDTheLoai = theloai.IDTheLoai";

    $sql_ten = "SELECT TenDanhMuc as ten FROM danhmuc WHERE IDDanhMuc='$id'";
    $row_ten = mysqli_fetch_assoc(mysqli_query($connect,$sql_ten));
    $title = $row_ten['ten'];
}
elseif(isset($_GET['theloai'])){
    $id = intval($_GET['theloai']);
    $where = "WHERE sach.IDTheLoai = '$id'";

    $sql_ten = "SELECT TenTheLoai as ten FROM theloai WHERE IDTheLoai='$id'";
    $row_ten = mysqli_fetch_assoc(mysqli_query($connect,$sql_ten));
    $title = $row_ten['ten'];
}
else{
    $title = "Tất cả sách";
}

// ================== BƯỚC 2: ĐẾM ==================
$sql_count = "SELECT COUNT(*) as total FROM sach $join $where";
$result_count = mysqli_query($connect,$sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];

// ================== BƯỚC 3: PHÂN TRANG ==================
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;

$total_page = ceil($total_records / $limit);

if($current_page > $total_page) $current_page = $total_page;
if($current_page < 1) $current_page = 1;

$start = ($current_page - 1) * $limit;

// ================== BƯỚC 4: LẤY DATA ==================
$sql = "SELECT sach.* FROM sach $join $where LIMIT $start, $limit";
$query = mysqli_query($connect,$sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="/THAYTRINH/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sản phẩm</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php include('modules/header.php'); ?>
<div class="sales">
    <div class="container mt-3">
        <div class="row">

            <!-- ===== SIDEBAR ===== -->
            <div class="col-md-2 sidebar">
                <h5>SÁCH</h5>

                <ul class="menu-left">

                    <!-- TẤT CẢ -->
                    <li>
                        <a href="sanpham.php">Tất cả sách</a>
                    </li>

                    <!-- DANH MỤC -->
                    <?php
                    $dm = mysqli_query($connect,"SELECT * FROM danhmuc");
                    while($row_dm = mysqli_fetch_assoc($dm)){
                    ?>
                        <li>
                            <?php
                                $active = "";
                                if(isset($_GET['danhmuc']) && $_GET['danhmuc'] == $row_dm['IDDanhMuc']){
                                    $active = "show"; // bootstrap class
                                }
                                // mở luôn khi click thể loại thuộc danh mục đó
                                if(isset($_GET['theloai'])){
                                    $id_tl = $_GET['theloai'];

                                    $check = mysqli_query($connect,"
                                        SELECT * FROM theloai 
                                        WHERE IDTheLoai='$id_tl' 
                                        AND IDDanhMuc='".$row_dm['IDDanhMuc']."'
                                    ");

                                    if(mysqli_num_rows($check) > 0){
                                        $active = "show";
                                    }
                                }
                            ?>
                            <!-- Tên danh mục -->
                            <a href="?danhmuc=<?php echo $row_dm['IDDanhMuc']; ?>">
                                <?php echo $row_dm['TenDanhMuc']; ?>
                            </a>

                            <!-- THỂ LOẠI (ẩn/hiện) -->
                            <ul class="collapse submenu <?php echo $active; ?>" id="dm<?php echo $row_dm['IDDanhMuc']; ?>">

                                <?php
                                $id_dm = $row_dm['IDDanhMuc'];
                                $tl = mysqli_query($connect,"SELECT * FROM theloai WHERE IDDanhMuc='$id_dm'");
                                while($row_tl = mysqli_fetch_assoc($tl)){
                                    echo '<li>
                                            <a href="?theloai='.$row_tl['IDTheLoai'].'">
                                                '.$row_tl['TenTheLoai'].'
                                            </a>
                                        </li>';
                                }
                                ?>

                            </ul>

                        </li>
                    <?php } ?>

                </ul>
            </div>

            <!-- ===== CONTENT ===== -->
            <div class="col-md-10 content-right">

                <h4><?php echo $title; ?></h4>

                <div class="product-item page-sanpham">

                <?php if(mysqli_num_rows($query) > 0){ ?>
                    <?php while($row = mysqli_fetch_assoc($query)){ ?>

                    <a class="item-sales" href="singleproduct.php?id=<?php echo $row['IDSach']; ?>">

                        <img class="product-image"
                        src="/THAYTRINH/image/sach/<?php echo $row['HinhAnh']; ?>">

                        <div class="product-detail">
                            <h6 class="product-title"><?php echo $row['TenSach']; ?></h6>
                            <p class="price"><?php echo number_format($row['GiaBan'],0,",","."); ?> đ</p>
                        </div>

                    </a>

                    <?php } ?>
                <?php } else { ?>
                    <p>Không có sản phẩm</p>
                <?php } ?>

                </div>

                <!-- ===== PHÂN TRANG ===== -->
                <div class="pagination text-center mt-3">

                    <?php
                    $param = "";
                    if(isset($_GET['danhmuc'])){
                        $param = "&danhmuc=".$_GET['danhmuc'];
                    }
                    if(isset($_GET['theloai'])){
                        $param = "&theloai=".$_GET['theloai'];
                    }

                        $range = 2;

                        // Prev
                        if ($current_page > 1){
                            echo '<a class="page-btn" href="?page='.($current_page-1).$param.'">«</a>';
                        }

                        // Trang đầu
                        if ($current_page > $range + 1){
                            echo '<a class="page-btn" href="?page=1'.$param.'">1</a>';
                            if ($current_page > $range + 2){
                                echo '<span class="page-btn">...</span>'; // vẫn dùng class cũ
                            }
                        }

                        // Các trang xung quanh
                        for ($i = max(1, $current_page - $range); $i <= min($total_page, $current_page + $range); $i++){
                            if ($i == $current_page){
                                echo '<span class="active">'.$i.'</span>';
                            } else {
                                echo '<a class="page-btn" href="?page='.$i.$param.'">'.$i.'</a>';
                            }
                        }

                        // Trang cuối
                        if ($current_page < $total_page - $range){
                            if ($current_page < $total_page - $range - 1){
                                echo '<span class="page-btn">...</span>'; // giữ style cũ
                            }
                            echo '<a class="page-btn" href="?page='.$total_page.$param.'">'.$total_page.'</a>';
                        }

                        // Next
                        if ($current_page < $total_page){
                            echo '<a class="page-btn" href="?page='.($current_page+1).$param.'">»</a>';
                        }
                    ?>

                </div>

            </div>

        </div>
        
    </div>
    <?php 
        include('modules/product.php');
    ?>
</div>
</body>
</html>