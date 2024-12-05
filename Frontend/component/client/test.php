<main class="detail grid wide row justify-content-between mt-4" data-productId="<?= $OneVariations['productId'] ?>"
    data-variationId="<?= $OneVariations['variationId'] ?>">
    <div class="l-6-2 row">
        <div class="l-1 m-0 c-0"></div>
        <div class="detail__left l-11">
            <div class="detail__left--img l-1">
                <?php foreach ($AllImage as $variation_img): ?>
                    <div class="detail__left--item active--detail__left--item">
                        <img loading="lazy" src="<?= $variation_img['image'] ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="detail__right--img l-10-9">
                <img src="<?= $OneVariations['image'] ?>" alt="">
            </div>
        </div>
    </div>
    <div class="l-6-2 row">
        <div class="detail__right l-11">
            <div class="detail__right--name"><?= $OneVariations['name'] ?></div>
            <div class="detail__right-info">
                <span class="detail__right-code"><?= $OneVariations['productCode'] ?>- <span
                        class="value__color"><?= $OneVariations['variationCode'] ?></span> - <span
                        class="value__size"><?= $OneVariations['size'] ?></span> </span>
                <span class="stars">
                    <!-- Stars code -->
                </span>
                <span class="rating">4.8</span>
                <a href="#" class="rating-count">(120)</a>
                <span class="sold-count">Đã bán 964</span>
            </div>
            <div class="detail__right--price row align-items-center">
                <div class="detail__right--price--new">
                    <?php $sale = $OneVariations["price"] - ($OneVariations["price"] * ($OneVariations["sale"] / 100)); ?>
                    <?= $OneVariations['sale'] > 0 ? number_format($sale, 0, ',', '.') . "đ" : $OneVariations["price"] ?>
                    <span>đ</span>
                </div>
                <div class="detail__right--price--old">
                    <?= $OneVariations['sale'] > 0 ? number_format($OneVariations['price'], 0, ',', '.') . "đ" : "" ?>
                </div>
                <?= $OneVariations['sale'] > 0 ? "<div class=detail__right--price--sale><span> - $OneVariations[sale] </span></div>" : "" ?>
            </div>
            <div class="color__selector mt-4">
                <span class="color-label">Màu sắc: <?= $OneVariations['color'] ?></span>
                <div class="row align-items-center">
                    <?php foreach ($AllVariation as $color): ?>
                        <div style="background-color: <?= $color['anhColor'] ?>"
                            data-colorCode="<?= $color['variationCode'] ?>" data-variationId="<?= $color['variationId'] ?>"
                            class="color-option <?= $color['variationId'] == $OneVariations['variationId'] ? "selected" : "" ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="size__selector">
                <span class="size-label">Kích thước: <span
                        class="size__value"><?= $OneVariations['size'] ?></span></span>
                <div class="row align-items-center">
                    <?php foreach ($AllSize as $size): ?>
                        <div data-sizeId="<?= $size['sizeId'] ?>" data-size="<?= $size['size'] ?>"
                            class="size-option <?= $size['sizeId'] == $OneVariations['sizeId'] ? "active__size" : "" ?>">
                            <?= $size['size'] ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="detail__number">Số lượng</div>
            <!-- Other content here -->
        </div>
    </div>
</main>
<pre><?php var_dump($OneVariations) ?>


    <?php var_dump($OneVariations)    ?>
</pre>
<br>
<pre>

    <?php var_dump($AllSize)    ?>
</pre>
<br>
<pre>

    <?php var_dump($AllImage)    ?>
</pre>

<link rel="stylesheet" href="Frontend/Css/reset.css?ver=2">
<link rel="stylesheet" href="Frontend/Css/grid.css?ver=3">
<?php
session_start();

require_once("config.php");
require_once("./Backend/controller/client/client.php");
require_once("./Backend/controller/admin/admin.php");

// Get URI path and query parameters
$basePath = P;
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query = $_SERVER['QUERY_STRING'] ?? '';



// Initialize controllers
$Admin = new Controller__Admin;
$Client = new Controller_Client;

// Check if the path is for admin or client
if (strpos($urlPath, "{$basePath}/admin") === 0) {
    // Admin routes using match
    $page = match (true) {
        $urlPath === "{$basePath}/admin" => fn() => $Admin->List("role"),
        default => fn() => print("Admin page not found! sssss"),
    };
} else {
    // Client routes using match
    $Client->Header("header");
    $page = match (true) {
        $urlPath === "{$basePath}/" => fn() => $Client->List("Home"),
        $urlPath === "{$basePath}/category" => fn() => require_once FRONTEND__CLIENT . "category.php",
        $urlPath === "{$basePath}/product" => fn() => $Client->detail("detail"),
        $urlPath === "{$basePath}/cart" => fn() => require_once FRONTEND__CLIENT . "cart.php",
        $urlPath === "{$basePath}/event" => fn() => require_once FRONTEND__CLIENT . "event.php",
        $urlPath === "{$basePath}/history" => fn() => require_once FRONTEND__CLIENT . "history.php",
        $urlPath === "{$basePath}/pay" => fn() => require_once FRONTEND__CLIENT . "pay.php",
        $urlPath === "{$basePath}/auth" && $query === "login" => fn() => require_once FRONTEND__CLIENT . "login.php",
        $urlPath === "{$basePath}/auth" && $query === "register" => fn() => require_once FRONTEND__CLIENT . "register.php",
        $urlPath === "{$basePath}/auth" && $query === "dangki" => fn() => $Client->register(),
        $urlPath === "{$basePath}/auth" && $query === "dangnhap" => fn() => $Client->login(),
        $urlPath === "{$basePath}/logout" => fn() => $Client->logout(),
        default => fn() => print("Client page not found!"),
    };
}


?>
<section class="products row mt-4  justify-content-between grid">
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>


</section>
<section class="products row mt-4  justify-content-between grid">
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>


</section>
<section class="products row mt-4  justify-content-between grid">
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>


</section>
<section class="products row mt-4  justify-content-between grid">
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
            <div class="overlay__image">
                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png" alt="">
            </div>
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>
    <article class="product l-3 m-4 c-12">
        <div class="product__image">
            <img loading="lazy"
                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                alt="" />
        </div>
        <span class="product__name">Áo Khoác Thể Thao Nữ Siêu Nhẹ Chống Tia UV</span>
        <div class="product__price row align-items-center  ">
            <span class="price__new">599.000 đ</span>
            <span class="price__old">3333</span>
        </div>
        <div class="product__variation row align-items-center">
            <span class="product__variation--item active__product--variation "></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
            <span class="product__variation--item"></span>
        </div>
        <div class="product__logo--sale row align-items-center justify-content-center">
            <span>-</span>5%
        </div>
    </article>


</section>
<!--  -->



<section class="review grid wide">
    <h2 class="review__detail">Đánh giá sản phẩm</h2>

    <!-- Đánh giá 1 -->
    <article class="review__item">
        <div class="review__profile">
            <img src="https://via.placeholder.com/50" alt="User Profile">
            <p class="review__profile-username">Người dùng 1</p>
        </div>
        <div class="review__body">
            <div class="review__header">
                <p class="review__profile-date">12/12/2024</p>
            </div>
            <div class="review__rating">
                <span class="star">&#9733;</span> <!-- Sao đầy -->
                <span class="star">&#9733;</span> <!-- Sao đầy -->
                <span class="star">&#9733;</span> <!-- Sao đầy -->
                <span class="star">&#9734;</span> <!-- Sao rỗng -->
                <span class="star">&#9734;</span> <!-- Sao rỗng -->
            </div>
            <div class="review__content">
                <p>Sản phẩm rất tốt, tôi thích chất lượng và thiết kế!</p>
            </div>
            <div class="review__image">
                <img src="https://via.placeholder.com/150" alt="Product Image">
            </div>
        </div>
    </article>

    <!-- Đánh giá 2 -->
    <article class="review__item">
        <div class="review__profile">
            <img src="https://via.placeholder.com/50" alt="User Profile">
            <p class="review__profile-username">Người dùng 2</p>
        </div>
        <div class="review__body">
            <div class="review__header">
                <p class="review__profile-date">13/12/2024</p>
            </div>
            <div class="review__rating">
                <span class="star">&#9733;</span> <!-- Sao đầy -->
                <span class="star">&#9733;</span> <!-- Sao đầy -->
                <span class="star">&#9734;</span> <!-- Sao rỗng -->
                <span class="star">&#9734;</span> <!-- Sao rỗng -->
                <span class="star">&#9734;</span> <!-- Sao rỗng -->
            </div>
            <div class="review__content">
                <p>Sản phẩm đẹp nhưng có chút vấn đề về kích thước.</p>
            </div>
            <div class="review__image">
                <img src="https://via.placeholder.com/150" alt="Product Image">
            </div>
        </div>
    </article>

</section>