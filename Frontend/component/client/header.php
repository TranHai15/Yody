<link rel="stylesheet" href="Frontend/Css/hf.css?ver=434">
<div class="header__kc">
    <!-- <a href="<?= P ?>/form?idUser=1&idProduct=26">form</a> -->
    <header>

        <div class="header grid wide">
            <nav class="header__left row align-items-center">
                <a href="<?= P ?>">
                    <div class="header__logo">
                        <img src="Frontend/public/svg/logo.svg" alt="Yody">
                    </div>
                </a>
                <div class="menu">
                    <?php foreach ($category as $cap1): ?>
                        <?php
                        // Kiểm tra xem mục cha này có mục con nào không
                        $hasSubmenu = false;
                        foreach ($child as $cap2) {
                            if ($cap1['categoryId'] == $cap2['categoryId']) {
                                $hasSubmenu = true;
                                break;
                            }
                        }
                        ?>
                        <!-- Thêm lớp 'has-submenu' nếu có mục con -->
                        <span class="menu-item menu-item-hover <?= $hasSubmenu ? 'has-submenu' : '' ?>">
                            <a href="<?= P ?>/category?id=<?= $cap1['categoryId'] ?>"
                                class="menu-item-a"><?= $cap1['name'] ?></a>
                            <?php if ($hasSubmenu): ?>
                                <div class="menu__list--cha">
                                    <div class="menu__list grid wide row">
                                        <?php foreach ($child as $cap2): ?>
                                            <?php if ($cap1['categoryId'] == $cap2['categoryId']): ?>
                                                <div class="item__list">
                                                    <div class="child__category"><a href="#"><?= $cap2['name'] ?></a></div>
                                                    <?php foreach ($common as $cap3): ?>
                                                        <?php if ($cap2['childId'] == $cap3['childId']): ?>
                                                            <div>
                                                                <div class="commont__category"><a href="#"><?= $cap3['name'] ?></a></div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <div class="item__list--img">
                                            <img src="<?= $cap1['image'] ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </span>
                    <?php endforeach ?>

                </div>

            </nav>
            <span class="header__right row align-items-center">
                <span class="header__search">
                    <button><img src="Frontend/public/svg/search.svg" alt="Yody-btn"></button>
                    <input type="text" id="header__search--input " class="header__search--input"
                        placeholder="Tìm kiếm ">
                </span>
                <a href="<?= P ?>/cart?id=<?= $_SESSION['userId'] ?? 'vodanh' ?>">
                    <span class="header__cart">
                        <img loading="lazy" src="Frontend/public/svg/cart.svg" alt="Yody-cart">
                        <div class="soluongCart">
                            <div class="numberCart"></div>
                        </div>
                    </span>
                </a>
                <div class="user">



                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] >= 0): ?>

                        <div class="header__user if_login_ok  " style=" display: flex; align-items: center;">
                            <span
                                style="width: 30px; padding:0 5px 0 5px ; margin-left: 10px; display:block; overflow: hidden; ">Welcome</span>
                            <img src="Frontend/public/svg/account.svg" alt="User Avatar" />
                        </div>
                    <?php else: ?>
                        <a href="<?= P ?>/auth?action=login">
                            <span class="header__user"> <img loading="lazy" src="Frontend/public/svg/account.svg"
                                    alt="Yody-user"></span>
                        </a>
                    <?php endif; ?>
                    <?php $name = $_SESSION["nameUser"] ?? "";
                    $avata = $_SESSION['avataUser']  ?? ''  ?>

                    <div class="user-info-dropdown ">
                        <div class="user-info">
                            <div class="avatar">
                                <img src="<?= $avata ?>" alt="User Avatar" />
                            </div>
                            <div class="username"><?= $name ?></div>
                        </div>

                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 1): ?>
                            <ul class="user-options">
                                <li><a href="<?= P ?>/admin">Vào trang quản trị</a></li>
                                <li><a href="/<?= P ?>/forgot">Thay đổi mật khẩu</a></li>
                                <li><a href="/settings">Cài đặt</a></li>
                                <li><a href="<?= P ?>/logout">Đăng xuất</a></li>
                            </ul>
                        <?php else: ?>
                            <ul class="user-options">
                                <li><a href="<?= P ?>/history">Lịch sử mua hàng</a></li>
                                <li><a href="<?= P ?>/forgot">Thay đổi mật khẩu</a></li>
                                <li><a href="/settings">Cài đặt</a></li>
                                <li><a href="<?= P ?>/logout">Đăng xuất</a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </span>
        </div>
    </header>
    <!-- tim kiem  -->
    <div class="fame__search">
        <div class="header grid wide row justify-content-between align-items-center  ">
            <a href="#">
                <div class="header__logo">
                    <img src="Frontend/public/svg/logo.svg" alt="Yody">
                </div>
            </a>
            <form action="<?= P ?>/search" method="get">
                <span class="header__search--fame row">
                    <input type="text" id="header__search--input--fame " name="sr" class="header__search--input--fame"
                        placeholder="Tìm kiếm ">
                    <button><img src="Frontend/public/svg/search.svg" alt="Yody-btn"></button>
                </span>
            </form>
            <span class="fame__close">Đóng</span>
        </div>
        <div class="panding_fame"></div>
    </div>
    <div class="overlay"></div>
</div>


<script src="Frontend/Js/hf.js"></script>