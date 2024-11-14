<link rel="stylesheet" href="Frontend/Css/hf.css?ver=434">
<div class="header__kc">
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
                            <a href="<?= P ?>/category" class="menu-item-a"><?= $cap1['name'] ?></a>
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
                <a href="<?= P ?>/cart">
                    <span class="header__cart">
                        <img loading="lazy" src="Frontend/public/svg/cart.svg" alt="Yody-cart">
                    </span>
                </a>
                <div class="user">
                    <a href="<?= P ?>/auth?login">
                        <span class="header__user"> <img loading="lazy" src="Frontend/public/svg/account.svg"
                                alt="Yody-user"></span>
                    </a>

                    <!-- <div class="header__user if_login_ok ">
                        <img src="Frontend/public/svg/account.svg" alt="User Avatar" />
                    </div> -->

                    <div class="user-info-dropdown ">
                        <div class="user-info">
                            <div class="avatar">
                                <img src="https://i.pinimg.com/736x/e2/01/7e/e2017e0b5a4f89b98b8611a5e82c3fbb.jpg"
                                    alt="User Avatar" />
                            </div>
                            <div class="username">Ngoc Nho</div>
                        </div>
                        <ul class="user-options">
                            <li><a href="?clt=history">Lịch sử mua hàng</a></li>
                            <li><a href="/change-password">Thay đổi mật khẩu</a></li>
                            <li><a href="/settings">Cài đặt</a></li>
                            <li><a href="/logout">Đăng xuất</a></li>
                        </ul>
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
            <span class="header__search--fame row">
                <input type="text" id="header__search--input--fame " class="header__search--input--fame"
                    placeholder="Tìm kiếm ">
                <button><img src="Frontend/public/svg/search.svg" alt="Yody-btn"></button>
            </span>
            <span class="fame__close">Đóng</span>
        </div>
        <div class="panding_fame"></div>
    </div>
    <div class="overlay"></div>
</div>
<script src="Frontend/Js/hf.js"></script>