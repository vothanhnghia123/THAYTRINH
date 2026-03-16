<?php
$sql_rating = "
    SELECT 
        COUNT(*) as tong,
        AVG(SoSao) as trungbinh,
        SUM(CASE WHEN SoSao = 5 THEN 1 ELSE 0 END) as sao5,
        SUM(CASE WHEN SoSao = 4 THEN 1 ELSE 0 END) as sao4,
        SUM(CASE WHEN SoSao = 3 THEN 1 ELSE 0 END) as sao3,
        SUM(CASE WHEN SoSao = 2 THEN 1 ELSE 0 END) as sao2,
        SUM(CASE WHEN SoSao = 1 THEN 1 ELSE 0 END) as sao1
    FROM danhgia
    WHERE IDSach = '$idsach'
";

$result_rating = mysqli_query($connect, $sql_rating);
$rating = mysqli_fetch_assoc($result_rating);

$tong = $rating['tong'];
$avg = round($rating['trungbinh'], 1);

// Tính toán phần trăm cho từng mức sao (kiểm tra $tong để tránh lỗi chia cho 0)
$pt5 = $tong ? ($rating['sao5'] / $tong) * 100 : 0;
$pt4 = $tong ? ($rating['sao4'] / $tong) * 100 : 0;
$pt3 = $tong ? ($rating['sao3'] / $tong) * 100 : 0;
$pt2 = $tong ? ($rating['sao2'] / $tong) * 100 : 0;
$pt1 = $tong ? ($rating['sao1'] / $tong) * 100 : 0;
?>
<?php
$sql_feedback = "
    SELECT danhgia.*, nguoidung.HoTen
    FROM danhgia
    LEFT JOIN nguoidung ON danhgia.IDNguoiDung = nguoidung.IDNguoiDung
    WHERE danhgia.IDSach = '$idsach'
    ORDER BY danhgia.NgayDanhGia DESC
    LIMIT 5
";
$result_feedback = mysqli_query($connect, $sql_feedback);
?>

<div class="write-review-box" style="margin-top:30px">
    <h4>Đánh giá sản phẩm</h4>

    <?php if (!isset($_SESSION['IDNguoiDung'])) { ?>

        <div style="padding:20px; border:1px solid #ddd; border-radius:8px">
            <p>
                Chỉ có thành viên mới có thể viết nhận xét.
                Vui lòng 
                <a href="login.php">đăng nhập</a> 
                hoặc 
                <a href="register.php">đăng ký</a>.
            </p>
        </div>

        <?php } else { ?>


        <div class="rating-summary">

        <div class="rating-left">
            <h1><?php echo $avg ?>/5</h1>

            <div class="stars">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= round($avg)) {
                        echo '<i class="fa fa-star"></i>';
                    } else {
                        echo '<i class="fa-regular fa-star"></i>';
                    }
                }
                ?>
            </div>

            <p>(<?php echo $tong ?> đánh giá)</p>
        </div>

        <div class="rating-right">

            <div class="row-star">
                <span>5 sao</span>
                <div class="bar">
                    <div style="width:<?php echo $pt5 ?>%"></div>
                </div>
                <span><?php echo round($pt5) ?>%</span>
            </div>

            <div class="row-star">
                <span>4 sao</span>
                <div class="bar">
                    <div style="width:<?php echo $pt4 ?>%"></div>
                </div>
                <span><?php echo round($pt4) ?>%</span>
            </div>

            <div class="row-star">
                <span>3 sao</span>
                <div class="bar">
                    <div style="width:<?php echo $pt3 ?>%"></div>
                </div>
                <span><?php echo round($pt3) ?>%</span>
            </div>

            <div class="row-star">
                <span>2 sao</span>
                <div class="bar">
                    <div style="width:<?php echo $pt2 ?>%"></div>
                </div>
                <span><?php echo round($pt2) ?>%</span>
            </div>

            <div class="row-star">
                <span>1 sao</span>
                <div class="bar">
                    <div style="width:<?php echo $pt1 ?>%"></div>
                </div>
                <span><?php echo round($pt1) ?>%</span>
            </div>

        </div>
        <div class="rating-action">

            <button id="btn-review" class="btn-review">
                <i class="fa fa-pen"></i> Viết đánh giá
            </button>

        </div>

    </div>

        <div id="review-form" style="display:none; margin-top:20px; border:1px solid #ddd; padding:20px; border-radius:8px">
            <form action="modules/feedback.php" method="POST">
                <input type="hidden" name="idsach" value="<?php echo $idsach; ?>">

                <div class="rating-options">
                    <label><input type="radio" name="sosao" value="5" checked> ⭐⭐⭐⭐⭐</label><br>
                    <label><input type="radio" name="sosao" value="4"> ⭐⭐⭐⭐</label><br>
                    <label><input type="radio" name="sosao" value="3"> ⭐⭐⭐</label><br>
                    <label><input type="radio" name="sosao" value="2"> ⭐⭐</label><br>
                    <label><input type="radio" name="sosao" value="1"> ⭐</label>
                </div>

                <textarea name="noidung" class="form-control" rows="4" placeholder="Cảm nhận của bạn về cuốn sách này..." required></textarea>

                <button type="submit" class="btn btn-danger" style="margin-top:10px">
                    Gửi đánh giá
                </button>
            </form>
        </div>

    <?php } ?>
</div>
<!-- bái đáng giá -->
<div class="review-section" style="margin-top:50px">
    <h4 style="font-weight:bold">Mới nhất </h4>

    <?php if (mysqli_num_rows($result_feedback) > 0) { ?>
        <?php while ($dg = mysqli_fetch_assoc($result_feedback)) { ?>
            <div class="review-item" style="border-bottom:1px solid #eee; padding:15px 0">
                <b><?php echo $dg['HoTen']; ?></b>

                <div style="color:#f5a623">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $dg['SoSao']) {
                            echo '<i class="fa fa-star"></i>';
                        } else {
                            echo '<i class="fa-regular fa-star"></i>';
                        }
                    }
                    ?>
                </div>

                <p style="margin-top:5px"><?php echo $dg['NoiDung']; ?></p>

                <small style="color:gray">
                    <?php echo date("d/m/Y", strtotime($dg['NgayDanhGia'])); ?>
                </small>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p style="color:gray">Chưa có đánh giá nào cho sản phẩm này.</p>
    <?php } ?>
</div>