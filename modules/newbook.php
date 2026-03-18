<?php
include("config.php");

mysqli_set_charset($connect,"utf8");

$sql_sach = "SELECT * FROM sach ORDER BY NgayNhap DESC LIMIT 8";
$load_sach = mysqli_query($connect,$sql_sach);
?>

<div class="book-carousel-section">
    <div class="container">
        <div class="book-carousel-box">
            <h3 class="book-carousel-title">SÁCH MỚI</h3>

            <div class="book-carousel-wrapper">
                <button class="book-carousel-btn btn-prev" onclick="moveSlide(-1)">❮</button>

                <div class="book-carousel-container" id="bookSlider">
                    <?php while($row = mysqli_fetch_array($load_sach)) { ?>
                    <a class="book-carousel-item" href="singleproduct.php?id=<?php echo $row['IDSach']; ?>">
                        <div class="book-card-img">
                            <img src="/THAYTRINH/Image/sach/<?php echo $row['HinhAnh']; ?>" alt="<?php echo $row['TenSach']; ?>">
                        </div>
                        <div class="book-card-info">
                            <h4 class="book-title"><?php echo $row['TenSach']; ?></h4>
                            <p class="book-price">
                                <?php echo number_format($row['GiaBan'], 0, ",", "."); ?> đ
                            </p>
                        </div>
                    </a>
                    <?php } ?>
                </div>

                <button class="book-carousel-btn btn-next" onclick="moveSlide(1)">❯</button>
            </div>
        </div>
    </div>
</div>
<script>
function moveSlide(direction) {
    const slider = document.getElementById("bookSlider");
    // Cuộn một khoảng bằng 3/4 chiều rộng khung hiển thị để mượt hơn
    const scrollAmount = slider.clientWidth * 0.8; 
    
    slider.scrollBy({
        left: direction * scrollAmount,
        behavior: "smooth"
    });
}
</script>