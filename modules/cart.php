<?php
session_start();

include("../config.php");
/* thông báo */
$thongbao = "";

if(isset($_GET['them'])){
    $thongbao = "Đã thêm sản phẩm vào giỏ hàng!";
}

/* xóa */
if(isset($_GET['xoa'])){

    $vitri = $_GET['xoa'];

    unset($_SESSION['id_them_vao_gio'][$vitri]);
    unset($_SESSION['sl_them_vao_gio'][$vitri]);

    $_SESSION['id_them_vao_gio'] = array_values($_SESSION['id_them_vao_gio']);
    $_SESSION['sl_them_vao_gio'] = array_values($_SESSION['sl_them_vao_gio']);
}
/*xóa tất cả */
if(isset($_GET['xoatatca'])){
    unset($_SESSION['id_them_vao_gio']);
    unset($_SESSION['sl_them_vao_gio']);
}
/* nút tăng giảm */
if(isset($_GET['tang'])){
    $vitri = $_GET['tang'];
    $_SESSION['sl_them_vao_gio'][$vitri]++;

    header("Location: cart.php");
    exit();
}

if(isset($_GET['giam'])){
    $vitri = $_GET['giam'];
    $_SESSION['sl_them_vao_gio'][$vitri]--;

    if($_SESSION['sl_them_vao_gio'][$vitri] <=0){
        unset($_SESSION['id_them_vao_gio'][$vitri]);
        unset($_SESSION['sl_them_vao_gio'][$vitri]);

        $_SESSION['id_them_vao_gio'] = array_values($_SESSION['id_them_vao_gio']);
        $_SESSION['sl_them_vao_gio'] = array_values($_SESSION['sl_them_vao_gio']);
    }

    header("Location: cart.php");
    exit();
}
mysqli_set_charset($connect,"utf8");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="/THAYTRINH/css/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Giỏ hàng của bạn</title>
</head>

<body>
	<?php
		include('header.php');
	?>
	<?php
		if (isset($_GET['added'])) {
	?>
		<div class="alert alert-success" style="
			position: fixed;
			top: 100px;
			left: 30px;
			width: 250px;
			z-index: 999;
		">
			Đã thêm sản phẩm vào giỏ hàng!
		</div>
	<?php
		}
	?>
<?php
    // Xử lý thêm sản phẩm vào session giỏ hàng
    if (isset($_GET['id'])) {

        $id = $_GET['id'];
    	$sl = $_GET['so_luong'];

        if (isset($_SESSION['id_them_vao_gio'])) {
            $so = count($_SESSION['id_them_vao_gio']);
            $trung_lap = "khong";

            for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
                if ($_SESSION['id_them_vao_gio'][$i] == $_GET['id']) {
                    $trung_lap = "co";
                    $vi_tri_trung_lap = $i;
                    break;
                }
            }

            if ($trung_lap == "khong") {
                $_SESSION['id_them_vao_gio'][$so] = $_GET['id'];
                $_SESSION['sl_them_vao_gio'][$so] = $_GET['so_luong'];
            } else {
                $_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] += $_GET['so_luong'];
            }
        } else {
            $_SESSION['id_them_vao_gio'][0] = $_GET['id'];
            $_SESSION['sl_them_vao_gio'][0] = $_GET['so_luong'];
        }
		if(isset($_GET['back'])){
			header("Location: ../singleproduct.php?id=".$_GET['back']."&added=1");
		}else{
			header("Location: cart.php?them=1");
		}
		exit();
    }

    // Kiểm tra trạng thái giỏ hàng
    $gio_hang = "khong";
    if (isset($_SESSION['id_them_vao_gio'])) {
        $tong_sl = 0;
        for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
            $tong_sl += $_SESSION['sl_them_vao_gio'][$i];
        }
        if ($tong_sl != 0) { $gio_hang = "co"; }
    }
?>

	<div class="cart-container">
				<?php if($thongbao!=""){ ?>
			<div class="alert alert-success text-center" style="margin:20px;">
				<?php echo $thongbao; ?>
			</div>
			<?php } ?>
    <div class="cart-left">
        <div class="cart-header">
			<h2>GIỎ HÀNG CỦA BẠN</h2>

			<a href="cart.php?xoatatca=1" class="btn-delete-all">
				Xóa tất cả
			</a>
		</div>

		<div class="select-all">
			<input type="checkbox" id="check-all" checked>
			<label for="check-all">Chọn tất cả</label>
		</div>

        <?php
        if ($gio_hang == "khong") {
            echo "<div style='padding: 20px; background: #fffbe6; border: 1px solid #ffe58f; border-radius: 8px;'>Giỏ hàng của bạn đang trống.</div>";
        } else {
            $tong_cong = 0;
            for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
                $sql = "SELECT * FROM sach WHERE IDSach = '".$_SESSION['id_them_vao_gio'][$i]."'";
                $result = mysqli_query($connect,$sql);
				$rows = mysqli_fetch_array($result);

				if($rows){

					$sl = $_SESSION['sl_them_vao_gio'][$i];
					$tien = $rows['GiaBan'] * $sl;
					$tong_cong += $tien;
        		?>
                <div class="cart-item">

					<input type="checkbox"
						class="check-item"
						data-price="<?php echo $tien; ?>"
						checked>

					<img src="../admin/modules/sach/upload/<?php echo $rows['HinhAnh']; ?>" class="cart-img">

					<div class="cart-info">
						<h4 class="book-name"><?php echo $rows['TenSach']; ?></h4>
						<p class="cart-price">
							<?php echo number_format($rows['GiaBan'],0,",","."); ?> đ
						</p>
					</div>

					<div class="cart-qty">

						<a href="cart.php?giam=<?php echo $i; ?>" class="btn-qty">-</a>

						<span class="qty"><?php echo $sl; ?></span>

						<a href="cart.php?tang=<?php echo $i; ?>" class="btn-qty">+</a>

					</div>

					<div class="cart-total">
						<?php echo number_format($tien,0,",","."); ?> đ
					</div>

					<a href="cart.php?xoa=<?php echo $i; ?>" class="btn-delete">Xóa</a>

				</div>
				<?php
				}
				?>
        <?php
            }
        ?>
            
        <?php
        }
        ?>
    </div>

    <div class="cart-right">
        <h3 style="margin-top: 0; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Thông tin nhận hàng</h3>
        <form action="DatHang.php" method="post">
            <label>Họ và tên *</label>
            <input type="text" name="ten" placeholder="Nhập tên người nhận" required>

            <label>Số điện thoại *</label>
            <input type="text" name="sdt" placeholder="Ví dụ: 0912345xxx" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="email@example.com">

            <label>Địa chỉ giao hàng *</label>
            <input type="text" name="diachi" placeholder="Số nhà, tên đường, phường/xã..." required>

            <label>Phương thức thanh toán</label>
            <select name="thanhtoan">
                <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                <option value="ATM">Chuyển khoản ngân hàng</option>
            </select>
			<div class="checkout-total">
				Tổng thanh toán
				<span id="tong-tien">
					<?php echo number_format($tong_cong,0,",","."); ?> VNĐ
				</span>
			</div>
            <button type="submit" class="btn-pay">HOÀN TẤT ĐẶT HÀNG</button>
        </form>
    </div>
</div>
<script>

function tinhTien(){

let tong = 0;

document.querySelectorAll(".check-item:checked").forEach(item=>{
    tong += parseInt(item.dataset.price);
});

document.getElementById("tong-tien").innerText =
tong.toLocaleString("vi-VN") + " VNĐ";

}

document.querySelectorAll(".check-item").forEach(cb=>{
cb.addEventListener("change",tinhTien);
});

document.addEventListener("DOMContentLoaded",tinhTien);
const checkAll = document.getElementById("check-all");

checkAll.addEventListener("change",function(){

document.querySelectorAll(".check-item").forEach(cb=>{
cb.checked = this.checked;
});

tinhTien();

});
</script>
</body>
</html>