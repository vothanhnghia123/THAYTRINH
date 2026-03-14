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
                <div class="menu-search">
                    <button type="button" class="button-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    <input type="search" class="input-search" placeholder="Nhập để tìm...">
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

                        echo "<span id='cart-count' class='cart-count'>$dem</span>";
                        ?>
                    </a>
                </div>
                <div class="menu-login">
                    <button class="button-login" >
                        <i class="fa-solid fa-bars"></i>
                    </button>
                        <ul class="dropdown-menu-login">
                            <li><a class="link" href="">Đăng ký</a></li>
                            <li><a class="link" href="">Đăng nhập</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</header>