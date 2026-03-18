<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/singleproduct.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>Chi tiết sách</title>
</head>

<body>
    <div id="msg-add">
    <i class="fa fa-check"></i> Đã thêm sản phẩm vào giỏ hàng!
    </div>
    <?php
    session_start();
    ?>
    <?php
        include("config.php");
        include("modules/header.php");

        mysqli_set_charset($connect, "utf8");

        if (isset($_GET["id"])) {
            $idsach = $_GET["id"];
        } else {
            header("location:index.php");
            exit();
        }

        /* Truy vấn JOIN để lấy thông tin chi tiết từ các bảng liên quan */
        $sql_sach = "
            SELECT sach.*, 
                   tacgia.TenTacGia,
                   theloai.TenTheLoai,
                   nhaxuatban.TenNXB
            FROM sach
            LEFT JOIN tacgia ON sach.IDTacGia = tacgia.IDTacGia
            LEFT JOIN theloai ON sach.IDTheLoai = theloai.IDTheLoai
            LEFT JOIN nhaxuatban ON sach.IDNXB = nhaxuatban.IDNXB
            WHERE sach.IDSach = '$idsach'
        ";

        $load_sach = mysqli_query($connect, $sql_sach);
    ?>

    <div class="container single-product" style="margin-top: 50px; margin-bottom: 50px;">

        <?php
        if (mysqli_num_rows($load_sach) > 0) {
            while ($row = mysqli_fetch_array($load_sach)) {
        ?>
                <div class="row">
                    <div class="col-md-5">
                        <img class="product-img img-fluid" 
                             src="/THAYTRINH/image/sach/<?php echo $row['HinhAnh']; ?>" 
                             alt="<?php echo $row['TenSach']; ?>" 
                             style="width: 100%; border: 1px solid #eee; border-radius: 8px;">
                    </div>

                    <div class="col-md-7 product-description">
                        <h2 style="font-weight: bold; color: #333;">
                            <?php echo $row['TenSach']; ?>
                        </h2>

                        <h3 style="color: #d9534f; margin: 20px 0;">
                            Giá: <?php echo number_format($row['GiaBan'], 0, ",", "."); ?> đ
                        </h3>

                        <ul class="list-unstyled info-book" style="line-height: 2; font-size: 16px;">
                            <li><i class="fa-solid fa-user-pen" style="width: 25px;"></i> <b>Tác giả:</b> <?php echo $row['TenTacGia']; ?></li>
                            <li><i class="fa-solid fa-tags" style="width: 25px;"></i> <b>Thể loại:</b> <?php echo $row['TenTheLoai']; ?></li>
                            <li><i class="fa-solid fa-building-columns" style="width: 25px;"></i> <b>Nhà xuất bản:</b> <?php echo $row['TenNXB']; ?></li>
                            <li><i class="fa-solid fa-file-lines" style="width: 25px;"></i> <b>Số trang:</b> <?php echo $row['SoTrang']; ?> trang</li>
                            <li><i class="fa-solid fa-calendar-days" style="width: 25px;"></i> <b>Năm xuất bản:</b> <?php echo $row['NamXB']; ?></li>
                            <li><i class="fa-solid fa-boxes-stacked" style="width: 25px;"></i> <b>Tình trạng:</b> 
                                <?php echo ($row['SoLuong'] > 0) ? '<span class="text-success">Còn hàng ('.$row['SoLuong'].')</span>' : '<span class="text-danger">Hết hàng</span>'; ?>
                            </li>
                        </ul>

                        <div style="margin-top: 30px;">
                            <h5 style="border-bottom: 2px solid #eee; padding-bottom: 10px; font-weight: bold; color: #555;">
                                MÔ TẢ SÁCH
                            </h5>
                            <p style="line-height: 1.8; color: #666; text-align: justify;">
                                <?php echo nl2br($row['MoTa']); ?>
                            </p>
                        </div>
                            
                        <div style="margin-top: 30px;">
                            <button 
                                    class="btn btn-danger btn-lg shadow-sm add-cart" 
                                    data-id="<?php echo $row['IDSach']; ?>" 
                                    style="padding: 10px 30px; font-weight: bold;"
                                >
                                    <i class="fa-solid fa-cart-shopping"></i> THÊM VÀO GIỎ HÀNG
                                </button>
                                
                             
                        </div>
                       
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='alert alert-warning text-center'>Rất tiếc, không tìm thấy thông tin cuốn sách này!</div>";
        }
        ?>
    </div>
    <div class="container single-product" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="row">
            <?php include("modules/review.php"); ?>
        </div>
    </div>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        let btn = document.querySelector(".add-cart");

        if (btn) {
            btn.addEventListener("click", function() {

                let id = this.dataset.id;

                // Gửi yêu cầu thêm vào giỏ hàng qua Ajax
                fetch("modules/ajax_add_cart.php?id=" + id + "&so_luong=1")
                    .then(response => response.text())
                    .then(data => {
                        
                        // 1. Hiển thị thông báo thành công
                        let msg = document.getElementById("msg-add");
                        if (msg) {
                            msg.style.display = "block";
                            setTimeout(() => {
                                msg.style.display = "none";
                            }, 2000);
                        }


                        // 2. Cập nhật số lượng trên icon giỏ hàng (Header)
                        let cart = document.getElementById("cart-count");

                        if(cart){
                            if(data > 0){
                                cart.innerText = data;
                                cart.style.display = "inline-block";
                            }else{
                                cart.style.display = "none";
                            }
                        }

                    })
                    .catch(error => {
                        console.error('Lỗi khi thêm vào giỏ hàng:', error);
                    });
            });
        }

    });
</script>
<script>
document.getElementById("btn-review").addEventListener("click", function(){

    var form = document.getElementById("review-form");

    if(form.style.display === "none"){
        form.style.display = "block";
    }else{
        form.style.display = "none";
    }

});
</script>
</body>
</html>