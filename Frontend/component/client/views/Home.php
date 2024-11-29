<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Frontend/Css/home.css?ver=4" />
    <title>Trang chu</title>
</head>

<body>
    <?php showNotification('loginaccoun')  ?>
    <?php require_once(HF . "header.php")  ?>
    <div>


        <section class="banner banner__one grid wide" data-carousel>
            <ul data-slides>
                <?php foreach ($slides as $slide) : ?>
                    <li class="slide">
                        <a href="<?= P ?>/<?= 'event?name=' . $slide['past'] ?> " title="<?= $slide['title']  ?>">
                            <img loading="lazy" src="<?= $slide['url'] ?>" alt="<?= $slide['title'] ?>" />
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
            <button class="slide__show pre " data-carousel-button="prev"><img src="Frontend/public/svg/pre.svg"
                    alt="Pre"></button>
            <button class="slide__show next" data-carousel-button="next"><img src="Frontend/public/svg/next.svg"
                    alt="Next"></button>
        </section>
        <main>
            <div class="grid wide ">
                <h2 class="title text-align-center">Sản phẩm ưa chuộng</h2>

                <section class="row justify-content-center">
                    <ul class="list__select  row align-items-center">
                        <li class="select-item active__select--item"><a href="#">Áo Gió</a></li>
                        <li class="select-item"><a href="#">Jeans Flex</a></li>
                        <li class="select-item"><a href="#">Áo Polo</a></li>
                        <li class="select-item"><a href="#">Quần Âu</a></li>
                        <li class="select-item"><a href="#">Sơ Mi</a></li>
                    </ul>
                </section>

                <section class="products row  justify-content-between grid wide">
                    <?php foreach ($TopProduct as $Product): ?>
                        <?php $name = replaceSpacesWithHyphen($Product['name']); ?>
                        <article class="product l-3 m-4 c-12">
                            <a href="<?= P ?>/product?<?= $name ?>&color=<?= $Product['colorId'] ?>">
                                <div class="product__image">
                                    <img loading="lazy" src="<?= $Product['ImageMain'] ?>" alt="" />
                                </div>
                                <span class="product__name"><?= $Product['name'] ?></span>
                                <div class="product__price row align-items-center">
                                    <?php
                                    $sale = $Product['new_price'] - ($Product['new_price'] * ($Product['old_price'] / 100));
                                    ?>
                                    <span class='price__new'>
                                        <?= $Product['old_price'] > 0 ? number_format($sale, 0, ',', '.') . "đ" : number_format($Product['new_price'], 0, ',', '.') . "đ"; ?>
                                    </span>
                                    <?= $Product['old_price'] > 0 ? "<span class='price__old'>" . number_format($Product['new_price'], 0, ',', '.') . "đ</span>" : ""; ?>
                                </div>
                                <div class="product__variation row align-items-center">
                                    <?php
                                    $variations = json_decode($Product['variations'], true);
                                    foreach ($variations as $key => $variation): ?>
                                        <a href="<?= P ?>/product?<?= $name ?>&color=<?= $variation['variationId'] ?>"
                                            data-images="<?= $variation['image'] ?>" class="product__variation-link">
                                            <span
                                                class="product__variation--item <?= $variation['variationId'] == $Product['colorId'] ? 'active__product--variation' : '' ?>"
                                                style="background-color: <?= $variation['anhColor'] ?>">
                                            </span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <?= $Product['old_price'] > 0 ? "<div class='product__logo--sale row align-items-center justify-content-center'><span>-$Product[old_price]%</span></div>" : "" ?>
                            </a>
                        </article>
                    <?php endforeach; ?>

                </section>
                <button class="row btn__view">Xem thêm</button>
            </div>
            <section class="banner banner__two grid wide">
                <img src="https://m.yodycdn.com/fit-in/filters:format(webp)//products/Collection%20List%20Banner_Website_1800x600.jpg"
                    alt="" />
            </section>
            <div class="grid wide ">
                <div class="row align-items-center title justify-content-center">
                    <h2 class="text-align-center">Gợi ý sản phẩm </h2>
                    <div>
                        <select name="" id="select__category__event">
                            <option value="top">Nữ</option>
                            <option value="banchay">Nam</option>
                            <option value="banchay">Bán Chạy</option>
                        </select>
                    </div>
                </div>

                <section class="products row mt-2 justify-content-between">
                    <?php foreach ($getAllSp as $index => $data): ?>
                        <?php if ($index % 5 === 0 && $index !== 0): ?>
                </section>
                <section class="products row mt-2 justify-content-between">
                <?php endif; ?>
                <article class="product l-2-4 m-3 c-12">
                    <a href="<?= P ?>/product?<?= $name ?>&color=<?= $data['colorId'] ?>">
                        <div class="product__image">
                            <img loading="lazy" src="<?= $data['ImageMain'] ?>" alt="" />
                        </div>
                        <span class="product__name"><?= $data['name'] ?></span>
                        <div class="product__price row align-items-center">
                            <span class="price__new"><?= number_format($data['new_price'] - ($data['new_price'] * ($data['old_price'] / 100)), 0, ',', '.') ?>đ</span>
                            <span class="price__old"><?= $data['old_price'] > 0 ? number_format($data['new_price'], 0, ',', '.') . "đ" : ""; ?></span>
                        </div>
                        <div class="product__variation row align-items-center">
                            <?php $variations = json_decode($data['variations'], true);
                            foreach ($variations as $bt): ?>
                                <a href="<?= P ?>/product?<?= $name ?>&color=<?= $bt['variationId'] ?>"
                                    data-images="<?= $bt['image'] ?>" class="product__variation-link">
                                    <span
                                        class="product__variation--item <?= $bt['variationId'] == $data['colorId'] ? 'active__product--variation' : '' ?>"
                                        style="background-color: <?= $bt['anhColor'] ?>">
                                    </span>
                                </a>
                            <?php endforeach ?>
                        </div>
                        <?php if (!empty($data['price__old'])): ?>
                            <div class="product__logo--sale row align-items-center justify-content-center">
                                <span>-</span><?= $data['price__old'] ?>%
                            </div>
                        <?php endif; ?>

                    </a>
                </article>
            <?php endforeach ?>
                </section>

                <button class="row btn__view">Xem thêm</button>

            </div>
            <section class="events__banner  grid wide">
                <a href="#">
                    <img src="https://m.yodycdn.com/fit-in/filters:format(webp)//products/YODY%20x%20Wintel_893x598.jpg"
                        alt="" /></a>
                <a href="#">
                    <img src="https://m.yodycdn.com/fit-in/filters:format(webp)//products/YODY_XANH%20SM_893x598.jpg"
                        alt="" />
                </a>
                <a href="#">
                    <img src="https://m.yodycdn.com/fit-in/filters:format(webp)//products/Frame%2032%201.jpg"
                        alt="" /></a>
                <a href="#">
                    <img src="https://m.yodycdn.com/fit-in/filters:format(webp)//products/Frame%2031%201.jpg"
                        alt="" /></a>
            </section>
            <section class="heading__one">
                <h1>#Yody tự hào thương hiệu Việt</h1>
            </section>
            <section class="banner__posts events__banner  grid wide">
                <div class="banner__post">
                    <a href="#">
                        <img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/media/articles/yody-top-10-thuong-hieu-thoi-trang.jpg"
                            alt="" />
                        <p class="post__title">YODY lọt Top 10 thương hiệu thời trang lớn nhất tại Đông</p>
                        <p class="post__detail">
                            YODY được website Campaign Asia-Pacific vinh danh là Thương Hiệu
                            Thời Trang thuộc Top 7 Đông Nam Á & Top 10 Việt Nam.
                        </p>
                    </a>
                </div>
                <div class="banner__post">
                    <a href="#">
                        <img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/media/articles/280.jpeg"
                            alt="" />
                        <p class="post__title">Cán Mốc 280 Cửa Hàng - YODY Chinh Phục Mọi Miền</p>
                        <p class="post__detail">
                            Thương hiệu thời trang Việt Nam YODY vừa ghi dấu ấn mới trong hành
                            trình phát triển của mình khi chính thức cán mốc 280 cửa hàng trên
                            toàn quốc.
                        </p>
                    </a>
                </div>
            </section>
        </main>

    </div>

    <?php require_once(HF . "footer.php")  ?>
</body>
<script src="Frontend/Js/home.js"></script>
<!-- <script src="Frontend/Js/detail.js"></script> -->

</html>