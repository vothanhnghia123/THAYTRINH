<?php
include("config.php");

mysqli_set_charset($connect,"utf8");

$sql_sach = "SELECT * FROM sach ORDER BY rand() LIMIT 8";
$load_sach = mysqli_query($connect,$sql_sach);
?>

<div class="sales">
  <div class="container sales-product">

    <h3 class="title-sale">SÁCH GỢI Ý</h3>

    <div class="product-item">

      <?php while($row = mysqli_fetch_array($load_sach)) { ?>

      <a class="item-sales" href="singleproduct.php?id=<?php echo $row['IDSach']; ?>">

        <img class="product-image"
        src="admin/modules/sach/upload/<?php echo $row['HinhAnh']; ?>">

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

    </div>

  </div>
</div>