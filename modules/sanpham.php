<?php
include("../config.php");

$title = "";

if(isset($_GET['danhmuc'])){
    $id = intval($_GET['danhmuc']);

    $sql = "SELECT sach.* 
            FROM sach
            JOIN theloai ON sach.IDTheLoai = theloai.IDTheLoai
            WHERE theloai.IDDanhMuc = '$id'";

    $sql_ten = "SELECT TenDanhMuc as ten FROM danhmuc WHERE IDDanhMuc='$id'";
    $row_ten = mysqli_fetch_assoc(mysqli_query($connect,$sql_ten));
    $title = $row_ten['ten'];
}
elseif(isset($_GET['theloai'])){
    $id = intval($_GET['theloai']);

    $sql = "SELECT * FROM sach WHERE IDTheLoai = '$id'";

    $sql_ten = "SELECT TenTheLoai as ten FROM theloai WHERE IDTheLoai='$id'";
    $row_ten = mysqli_fetch_assoc(mysqli_query($connect,$sql_ten));
    $title = $row_ten['ten'];
}
else{
    $sql = "SELECT * FROM sach";
}

$query = mysqli_query($connect,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/THAYTRINH/css/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
	<?php
		include('header.php');
	?>
    <h2><?php echo $title; ?></h2>

<div class="product-item">

<?php if(mysqli_num_rows($query) > 0){ ?>

    <?php while($row = mysqli_fetch_assoc($query)){ ?>

    <a class="item-sales" href="../singleproduct.php?id=<?php echo $row['IDSach']; ?>">

        <img class="product-image"
         src="../admin/modules/sach/upload/<?php echo $row['HinhAnh']; ?>">

        <div class="product-detail">
            <h4 class="product-title"><?php echo $row['TenSach']; ?></h4>
            <p class="price"><?php echo number_format($row['GiaBan'],0,",","."); ?> đ</p>
        </div>

    </a>

    <?php } ?>

<?php } else { ?>

    <p>Không có sản phẩm</p>

<?php } ?>

</div>
</body>
</html>