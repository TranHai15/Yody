<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <link rel="stylesheet" href="Frontend/Css/home.css?ver=4" />
    <link rel="stylesheet" href="Frontend/Css/event.css?ver=4" />
    <title>Trang chu</title>
</head>


<body>
    <?php require_once(HF . "header.php")  ?>
    <div>
        <section class="banner banner__one grid wide">
            <img src="<?= $dulieulayra['url'] ?>"
                alt="" />
        </section>
        <main>
            <div class="grid wide ">
                <h2 class="title text-align-center">Săn Voucher 11/11</h2>

                <section class="row justify-content-center">
                    <ul class="list__select  row align-items-center">
                        <li class="select-item active__select--item"><a href="#">Voucher 50K - 100K - 200K</a></li>
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
        </main>

    </div>
    <div>
        <section class="banner banner__one grid wide">
            <img src="https://m.yodycdn.com/fit-in/filters:format(webp)//products/1800x600%20(1)%20LDP%2011.11%20chi%20tu%2014k.png"
                alt="" />
        </section>
        <main>
            <div class="grid wide ">
                <h2 class="title text-align-center">Săn ngay</h2>

                <section class="row justify-content-center">
                    <ul class="list__select  row align-items-center">
                        <li class="select-item active__select--item"><a href="#">Chỉ từ 14K</a></li>
                        <li class="select-item"><a href="#">Giá trải nghiệm từ 99K</a></li>
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
        </main>

    </div>
    <div>
        <section class="banner banner__one grid wide">
            <img src="https://m.yodycdn.com/fit-in/filters:format(webp)//products/1800x600.png" alt="" />
        </section>
        <main>
            <div class="grid wide ">
                <h2 class="title text-align-center">Sale upto 50%</h2>

                <section class="row justify-content-center">
                    <ul class="list__select  row align-items-center">
                        <li class="select-item active__select--item"><a href="#">Nam</a></li>
                        <li class="select-item"><a href="#">Nữ</a></li>
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
        </main>

    </div>

    <?php require_once(HF . "footer.php")  ?>
</body>

</html>