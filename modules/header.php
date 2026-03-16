<header class="header"> 
    <div class="container">
        <div class="nav">
            <div class="nav-link">
                <ul class="list-link">
                    <li><a class="link" href="/THAYTRINH/index.php">Trang chủ</a></li>
                    <li><a class="link" href="">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a class="link" href="">Thể loại</a>
                        <div class="mega-menu">
                            <!-- cột 1 -->
                            <div class="column">
                                
                                <a class="column-link" href="">Tiểu thuyết</a>
                                <ul>
                                    <li><a href="">Ngôn tình</a></li>
                                    <li><a href="">Kiếm hiệp</a></li>
                                    <li><a href="">Trinh thám</a></li>
                                </ul>
                            </div>

                            <!-- cột 2 -->
                            <div class="column">
                                
                                <a class="column-link" href="">Khoa học</a>
                                <ul>
                                    <li><a href="">Vũ trụ</a></li>
                                    <li><a href="">Sinh học</a></li>
                                </ul>
                            </div>

                            <!-- cột 3 -->
                            <div class="column">
                                <a class="column-link" href="">Truyện tranh</a>
                                <ul>
                                    <li><a href="">Manga</a></li>
                                    <li><a href="">Manhwa</a></li>
                                </ul>
                            </div>

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