<?php var_dump($OneVariations)    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/detail.css">
    <title>detail</title>

</head>

<body>
    <?php require_once(HF . "header.php")  ?>
    <!-- past -->
    <div class="grid wide row align-items-center">
        <span><a class="past__product" href="?clt=/">Trang Chủ </a></span>
        <span class="past__icon--next"><img src="Frontend/public/svg/next.svg" alt=""></span>
        <span class="past__product--category"> Nam</span> <span class="past__icon--next"><img
                src="Frontend/public/svg/next.svg" alt=""></span>
        <span class="past__product--category"> Quần nam </span> <span class="past__icon--next"><img
                src="Frontend/public/svg/next.svg" alt=""></span>
        <span class="past__product--category"> Quần Jeans Nam Tapered Lycra Thêu Túi</span>
    </div>
    <!-- main -->
    <div>
        <?php foreach ($OneVariations as $product): ?>
            <main class="detail grid wide row justify-content-between mt-4" data-productId="<?= $product['productId'] ?>"
                data-variationId="<?= $product['variationId'] ?>">
                <div class="l-6-2 row">
                    <div class="l-1 m-0 c-0"></div>
                    <div class="detail__left l-11">
                        <div class="detail__left--img l-1">
                            <?php foreach ($AllVariationsImage as $variation_img): ?>
                                <div class="detail__left--item active--detail__left--item">
                                    <img loading="lazy" src="<?= $variation_img['variation_image'] ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="detail__right--img l-10-9">
                            <img src="<?= $product['image'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="l-6-2 row">
                    <div class="detail__right l-11">
                        <div class="detail__right--name"><?= $product['name'] ?></div>
                        <div class="detail__right-info">
                            <span class="detail__right-code"><?= $product['productCode'] ?>- <span
                                    class="value__color"><?= $product['variationCode'] ?></span> - <span
                                    class="value__size"><?= $product['size'] ?></span> </span>
                            <span class="stars">
                                <!-- Stars code -->
                            </span>
                            <span class="rating">4.8</span>
                            <a href="#" class="rating-count">(120)</a>
                            <span class="sold-count">Đã bán 964</span>
                        </div>
                        <div class="detail__right--price row align-items-center">
                            <div class="detail__right--price--new">
                                <?php $sale = $product["price"] - ($product["price"] * ($product["sale"] / 100)); ?>
                                <?= $product['sale'] > 0 ? number_format($sale, 0, ',', '.') . "đ" : $product["price"] ?>
                                <span>đ</span>
                            </div>
                            <div class="detail__right--price--old">
                                <?= $product['sale'] > 0 ? number_format($product['price'], 0, ',', '.') . "đ" : "" ?>
                            </div>
                            <?= $product['sale'] > 0 ? "<div class=detail__right--price--sale><span> - $product[sale] </span></div>" : "" ?>
                        </div>
                        <div class="color__selector mt-4">
                            <span class="color-label">Màu sắc: <?= $product['color'] ?></span>
                            <div class="row align-items-center">
                                <?php foreach ($AllVariationsColor as $color): ?>
                                    <div style="background-color: <?= $color['anhColor'] ?>"
                                        data-colorCode="<?= $color['variationCode'] ?>"
                                        data-variationId="<?= $color['variationId'] ?>"
                                        class="color-option <?= $color['variationId'] == $product['variationId'] ? "selected" : "" ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="size__selector">
                            <span class="size-label">Kích thước: <span
                                    class="size__value"><?= $product['size'] ?></span></span>
                            <div class="row align-items-center">
                                <?php foreach ($AllVariationsSize as $size): ?>
                                    <div data-sizeId="<?= $size['sizeId'] ?>" data-size="<?= $size['size'] ?>"
                                        class="size-option <?= $size['sizeId'] == $product['sizeId'] ? "active__size" : "" ?>">
                                        <?= $size['size'] ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="detail__number">Số lượng</div>
                        <!-- Other content here -->
                    </div>
                </div>
            </main>
        <?php endforeach; ?>


        <!-- Cos theer ban se thich -->
        <section class="canyoulikeit     grid wide">
            <h2>
                Có thể bạn sẽ thích
            </h2>
            <section class="products row  justify-content-between ">

                <article class="product l-3 m-4 c-12">
                    <a href="?clt=detail">
                        <div class="product__image">
                            <img loading="lazy"
                                src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                                alt="" />
                            <div class="overlay__image">
                                <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png"
                                    alt="">
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
                    </a>
                </article>

                <article class="product l-3 m-4 c-12">
                    <div class="product__image">
                        <img loading="lazy"
                            src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-khoac-the-thao-nu-SKN7007-GNH%20(10).JPG"
                            alt="" />
                        <div class="overlay__image">
                            <img loading="lazy" src="https://m.yodycdn.com/products/donggia_m1yi17yavizhqdvliui.png"
                                alt="">
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

        </section>
    </div>
    <?php require_once(HF . "footer.php")  ?>
    <script src="Frontend/Js/detail.js"></script>
</body>



</html>