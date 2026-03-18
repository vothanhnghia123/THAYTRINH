<?php
include("config.php");

mysqli_set_charset($connect,"utf8");

$sql_sach = "SELECT sach.* 
             FROM sach
             JOIN theloai ON sach.IDTheLoai = theloai.IDTheLoai
             JOIN danhmuc ON theloai.IDDanhMuc = danhmuc.IDDanhMuc
             WHERE danhmuc.TenDanhMuc = 'Văn học'
             ORDER BY rand()
             LIMIT 10";
$load_sach = mysqli_query($connect,$sql_sach);

$sql_dm = "SELECT IDDanhMuc FROM danhmuc WHERE TenDanhMuc = 'Văn học' LIMIT 1";
$kq_dm = mysqli_query($connect, $sql_dm);
$dm = mysqli_fetch_assoc($kq_dm);
?>

<div class="sales">
  <div class="container sales-product">
    <div class="box-white">
      <h3 class="title-sale">VĂN HỌC</h3>
      <div class="product-item">

        <?php while($row = mysqli_fetch_array($load_sach)) { ?>

        <a class="item-sales" href="singleproduct.php?id=<?php echo $row['IDSach']; ?>">

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

      </div>
          <div class="view-more">
              <a href="/THAYTRINH/modules/sanpham.php?danhmuc=<?php echo $dm['IDDanhMuc']; ?>" class="btn-view-more">Xem thêm</a>
          </div>
    </div>
  </div>
</div>