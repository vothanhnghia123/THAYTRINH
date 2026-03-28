<?php
session_start();
include("../config.php");

$keyword = "";

if(isset($_GET['keyword'])){
    $keyword = trim($_GET['keyword']);
}

$key = mysqli_real_escape_string($connect, $keyword);

// tìm tất cả sản phẩm
$sql = "SELECT sach.*, tacgia.TenTacGia
        FROM sach
        LEFT JOIN tacgia ON sach.IDTacGia = tacgia.IDTacGia
        WHERE sach.TenSach LIKE '%$key%' 
           OR tacgia.TenTacGia LIKE '%$key%'
        ORDER BY sach.IDSach DESC";

$query = mysqli_query($connect,$sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<title>Tìm kiếm</title>
</head>

<body>

<?php include("../modules/header.php"); ?>

<div class="sales">
  <div class="container sales-product">
    <div class="box-white">

      <h3 class="title-sale">
        KẾT QUẢ TÌM KIẾM: "<?php echo $keyword; ?>"
      </h3>

      <div class="product-item">

        <?php if(mysqli_num_rows($query) > 0){ ?>

            <?php while($row = mysqli_fetch_assoc($query)){ ?>

                <a class="item-sales" href="/THAYTRINH/singleproduct.php?id=<?php echo $row['IDSach']; ?>">

                    <img class="product-image"
                    src="/THAYTRINH/image/sach/<?php echo $row['HinhAnh']; ?>">

                    <div class="product-detail">

                        <h4 class="product-title">
                            <?php echo $row['TenSach']; ?>
                        </h4>

                        <p class="price">
                            <?php echo number_format($row['GiaBan'],0,",","."); ?> đ
                        </p>

                    </div>

                </a>

            <?php } ?>

        <?php } else { ?>
            <p>Không tìm thấy sản phẩm!</p>
        <?php } ?>

      </div>

    </div>
  </div>
</div>
<?php 
    include('../modules/product.php');
?>

</body>
</html>