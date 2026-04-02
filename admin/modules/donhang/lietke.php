<?php
$connect = mysqli_connect("localhost", "root", "", "bansach");
mysqli_set_charset($connect, "utf8");

// XỬ LÝ AJAX NGAY TRONG FILE NÀY
if(isset($_POST['id']) && isset($_POST['trangthai'])){
    $id = $_POST['id'];
    $trangthai = $_POST['trangthai'];

    $sql_update = "UPDATE donhang SET TrangThai = '$trangthai' WHERE IDDonHang = '$id'";
    mysqli_query($connect, $sql_update);

    echo "ok";
    exit(); // QUAN TRỌNG: dừng luôn để không load HTML phía dưới
}

// Load dữ liệu
$sql = "SELECT donhang.*, nguoidung.HoTen, nguoidung.Email, nguoidung.DienThoai, nguoidung.DiaChi
        FROM donhang
        JOIN nguoidung ON donhang.IDNguoiDung = nguoidung.IDNguoiDung
        ORDER BY IDDonHang DESC";
$result = mysqli_query($connect, $sql);
?>

<header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</header>
<div class="hienthi">
    <table class="table-lietke">
        <tr>
            <th>ID Đơn</th>
            <th>ID Người dùng</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $row['IDDonHang']; ?></td>
                <td><?php echo $row['IDNguoiDung']; ?></td>
                <td><?php echo date("d/m/Y H:i", strtotime($row['NgayDat'])); ?></td>
                <td><b style="color:red;"><?php echo number_format($row['TongTien'], 0, ",", "."); ?> VNĐ</b></td>

                <td class="status-text">
                    <?php
                        $tt = $row['TrangThai'];
                        if($tt==0) echo "Chờ xác nhận";
                        else if($tt==1) echo "Đã xác nhận";
                        else if($tt==2) echo "Đang chuẩn bị hàng";
                        else if($tt==3) echo "Đang giao";
                        else if($tt==4) echo "Đã giao";
                        else echo "Đã hủy";
                    ?>
                </td>

                <td>
                    <button class="btn-update"
                        data-id="<?php echo $row['IDDonHang']; ?>"
                        data-trangthai="<?php echo $row['TrangThai']; ?>"
                        data-ten="<?php echo $row['HoTen']; ?>"
                        data-email="<?php echo $row['Email']; ?>"
                        data-sdt="<?php echo $row['DienThoai']; ?>"
                        data-diachi="<?php echo $row['DiaChi']; ?>"
                        data-ngaydat="<?php echo $row['NgayDat']; ?>"
                        data-tongtien="<?php echo number_format($row['TongTien'],0,',','.'); ?>">
                        Cập nhật
                    </button>
                </td>
            </tr>
        <?php } ?>
    </table>
        <div id="popup">
            <div class="popup-content">
                <h3><i class="fa fa-box"></i> Chi tiết đơn hàng</h3>

                <!-- THÔNG TIN ĐƠN -->
                <p><i class="fa fa-hashtag"></i> <b>Mã đơn:</b> <span id="madon"></span></p>
                <p><i class="fa fa-calendar"></i> <b>Ngày đặt:</b> <span id="ngaydat"></span></p>
                <p><i class="fa fa-money-bill"></i> <b>Tổng tiền:</b> <span id="tongtien"></span></p>

                <!-- NGƯỜI MUA -->
                <p><i class="fa fa-user"></i> <b>Tên:</b> <span id="ten"></span></p>
                <p><i class="fa fa-envelope"></i> <b>Email:</b> <span id="email"></span></p>
                <p><i class="fa fa-phone"></i> <b>SĐT:</b> <span id="sdt"></span></p>
                <p><i class="fa fa-location-dot"></i> <b>Địa chỉ:</b> <span id="diachi"></span></p>

                <!-- DANH SÁCH SẢN PHẨM -->
                <h4><i class="fa fa-list"></i> Sản phẩm</h4>
                <div id="danhsachsp"></div>

                <input type="hidden" id="idDonHang">

                <label><i class="fa fa-truck"></i> Trạng thái:</label>
                <select id="trangthai">
                    <option value="0">Chờ xác nhận</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đang chuẩn bị hàng</option>
                    <option value="3">Đang giao</option>
                    <option value="4">Đã giao</option>
                    <option value="5">Đã hủy</option>
                </select>

                <div class="popup-btn">
                    <button id="save"><i class="fa fa-save"></i> Lưu</button>
                    <button id="close"><i class="fa fa-xmark"></i> Đóng</button>
                </div>
            </div>
        </div>
</div>

<!-- AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // MỞ POPUP (FIX)
        $(document).on('click', '.btn-update', function(){

            var id = $(this).data('id');
            var trangthai = $(this).data('trangthai');

            $('#idDonHang').val(id);
            $('#trangthai').val(trangthai);

            // THÔNG TIN ĐƠN
            $('#madon').text(id);
            $('#ngaydat').text($(this).data('ngaydat'));
            $('#tongtien').text($(this).data('tongtien') + " VNĐ");

            // NGƯỜI MUA
            $('#ten').text($(this).data('ten'));
            $('#email').text($(this).data('email'));
            $('#sdt').text($(this).data('sdt'));
            $('#diachi').text($(this).data('diachi'));

            // LOAD SẢN PHẨM
            $.ajax({
                url: "modules/donhang/load_sanpham.php",
                method: "POST",
                data: {id: id},
                success: function(data){
                    $('#danhsachsp').html(data);
                }
            });

            $('#popup').show();
        });

    // LƯU
    $('#save').click(function(){
        var id = $('#idDonHang').val();
        var trangthai = $('#trangthai').val();

        $.ajax({
            url: "",
            method: "POST",
            data: {
                id: id,
                trangthai: trangthai
            },
            success: function(){

                var text = "";
                if(trangthai==0) text="Chờ xác nhận";
                else if(trangthai==1) text="Đã xác nhận";
                else if(trangthai==2) text="Đang chuẩn bị hàng";
                else if(trangthai==3) text="Đang giao";
                else if(trangthai==4) text="Đã giao";
                else text="Đã hủy";

                $('button[data-id="'+id+'"]').closest('tr')
                    .find('.status-text').html(text);

                $('button[data-id="'+id+'"]').data('trangthai', trangthai);

                $('#popup').hide();
            }
        });
    });

});



$('#close').click(function(){
    $('#popup').hide();
});


// luôn ẩn popup khi load lại trang
$(window).on('load', function(){
    $('#popup').hide();
});


$(document).mouseup(function(e){
    var popup = $(".popup-content");
    if (!popup.is(e.target) && popup.has(e.target).length === 0){
        $('#popup').hide();
    }
});
</script>
