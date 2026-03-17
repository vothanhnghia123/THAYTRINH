<header class="header"> 
    <div class="container">
        <div class="nav">
            <div class="nav-link">
                <ul class="list-link">
                    <li><a class="link" href="/THAYTRINH/index.php">Trang chủ</a></li>
                    <li><a class="link" href="/THAYTRINH/gioithieu.php">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a class="link" href="">Thể loại</a>

                        <div class="mega-menu">

                            <?php
                            $sql_dm = "SELECT * FROM danhmuc";
                            $query_dm = mysqli_query($connect, $sql_dm);

                            while($dm = mysqli_fetch_assoc($query_dm)){
                            ?>

                            <div class="column">

                                <!-- danh mục -->
                                <a class="link" href="/THAYTRINH/modules/sanpham.php?danhmuc=<?php echo $dm['IDDanhMuc']; ?>">
                                    <?php echo $dm['TenDanhMuc']; ?>
                                </a>

                                <ul>
                                    <?php
                                    $id_dm = $dm['IDDanhMuc'];
                                    $sql_tl = "SELECT * FROM theloai WHERE IDDanhMuc='$id_dm'";
                                    $query_tl = mysqli_query($connect, $sql_tl);

                                    while($tl = mysqli_fetch_assoc($query_tl)){
                                    ?>

                                    <li>
                                        <a class="link" href="/THAYTRINH/modules/sanpham.php?theloai=<?php echo $tl['IDTheLoai']; ?>">
                                            <?php echo $tl['TenTheLoai']; ?>
                                        </a>
                                    </li>

                                    <?php } ?>
                                </ul>

                            </div>

                            <?php } ?>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="nav-logo">
                <a href="/THAYTRINH/index.php"><img width="200" height="60"  src="/THAYTRINH/image/bookstore_logo.png" alt=""></a>
            </div>
            <div class="search-login">
                <!-- tìm kiếm  -->
                <div class="menu-search">
                    <button type="button" class="button-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    <input type="search" id="search-input" class="input-search" placeholder="Nhập để tìm...">

                    <div id="search-result" class="search-result"></div>
                </div>
                <div class="menu-cart">
                    <a href="/THAYTRINH/modules/cart.php" class="button-cart link">
                        <i class="fa-solid fa-cart-shopping"></i>

                        <?php
                        $dem = 0;

                        if(isset($_SESSION['sl_them_vao_gio'])){
                            foreach($_SESSION['sl_them_vao_gio'] as $sl){
                                $dem += $sl;
                            }
                        }
                        ?>

                        <span id="cart-count" class="cart-count" 
                        style="<?php if($dem == 0) echo 'display:none'; ?>">
                        <?php echo $dem; ?>
                        </span>
                    </a>
                </div>
                <div class="menu-login">

                    <button class="button-login">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <ul class="dropdown-menu-login">

                        <?php if (!isset($_SESSION['IDNguoiDung'])) { ?>

                            <li><a class="link" href="/THAYTRINH/modules/login.php">Đăng nhập</a></li>
                            <li><a class="link" href="/THAYTRINH/modules/register.php">Đăng ký</a></li>

                        <?php } else { ?>

                            <li>
                                <a class="link" href="/THAYTRINH/modules/profile.php">
                                    <i class="fa-solid fa-user"></i> <?php echo $_SESSION['HoTen']; ?>
                                </a>
                            </li>

                            <li><a class="link" href="/THAYTRINH/modules/logout.php"> <i class="fa-solid fa-right-to-bracket"> </i> Đăng xuất</a></li>

                        <?php } ?>

                    </ul>

                </div>
            </div>
        </div>
    </div>
</header>