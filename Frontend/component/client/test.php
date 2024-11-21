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
<pre>

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