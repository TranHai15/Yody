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
        <span><a class="past__product" href="<?= P ?>/">Trang Chủ </a></span>
        <span class="past__icon--next"><img src="Frontend/public/svg/next.svg" alt=""></span>
        <span class="past__product--category">

            <?php foreach ($category as $cap1):    ?>
                <?php if ($cap1['categoryId'] === $OneVariations['categoryId']):   ?>
                    <a style="cursor: pointer;" href="<?= P ?>/category?id=<?= $cap1['categoryId'] ?>"><?= $cap1['name'] ?></a>
                <?php endif  ?>
            <?php endforeach   ?>

        </span> <span class="past__icon--next"><img src="Frontend/public/svg/next.svg" alt=""></span>
        <span class="past__product--category">
            <?php foreach ($child as $cap2):    ?>
                <?php if ($cap2['childId'] === $OneVariations['childId']):   ?>
                    <?= $cap2['name'] ?>
                <?php endif  ?>
            <?php endforeach   ?>
        </span> <span class="past__icon--next"><img src="Frontend/public/svg/next.svg" alt=""></span>
        <span class="past__product--category"> <?= $OneVariations['name'] ?></span>
    </div>
    <!-- main -->
    <div>
        <main class="detail grid wide row justify-content-between mt-4"
            data-productId="<?= $OneVariations['productId'] ?>" data-variationId="<?= $OneVariations['variationId'] ?>"
            data-name="<?= htmlspecialchars($OneVariations['name']) ?>"
            data-productCode="<?= $OneVariations['productCode'] ?>"
            data-variationCode="<?= $OneVariations['variationCode'] ?>"
            data-userId="<?= $_SESSION['userId'] ?? null ?>">

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
                        <?php
                        // Tính giá sau khi giảm
                        $hasSale = $OneVariations['sale'] > 0;
                        $salePrice = $hasSale
                            ? $OneVariations['price'] - ($OneVariations['price'] * ($OneVariations['sale'] / 100))
                            : $OneVariations['price'];
                        ?>

                        <!-- Hiển thị giá mới -->
                        <div class="detail__right--price--new" data-price="<?= $salePrice ?>">
                            <?= number_format($salePrice, 0, ',', '.') . "đ" ?>
                            <span></span><br>
                        </div>

                        <!-- Hiển thị giá cũ nếu có giảm giá -->
                        <?php if ($hasSale): ?>
                            <div class="detail__right--price--old" data-price="<?= $salePrice ?>">
                                <?= number_format($OneVariations['price'], 0, ',', '.') . "đ" ?>
                            </div>

                            <!-- Hiển thị phần trăm giảm giá -->
                            <div class="detail__right--price--sale">
                                <span>-<?= $OneVariations['sale'] ?>%</span>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="color__selector mt-4">
                        <span class="color-label">Màu sắc: <?= $OneVariations['color'] ?></span>
                        <div class="row align-items-center">
                            <?php $name = replaceSpacesWithHyphen($OneVariations['name']); ?>
                            <?php foreach ($AllVariation as $color): ?>
                                <a href="<?= P ?>/product?<?= $name ?>&color=<?= $color['variationId'] ?>">
                                    <div style="background-color: <?= $color['anhColor'] ?>"
                                        data-colorCode="<?= $color['variationCode'] ?>"
                                        data-variationId="<?= $color['variationId'] ?>"
                                        class="color-option <?= $color['variationId'] == $OneVariations['variationId'] ? "selected" : "" ?>">
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="size__selector">
                        <span class="size-label">Kích thước: <span
                                class="size__value"><?= $OneVariations['size'] ?></span></span>
                        <div class="row align-items-center">
                            <?php foreach ($AllSize as $size): ?>
                                <div data-sizeId="<?= $size['sizeId'] ?>" data-size="<?= $size['size'] ?>"
                                    class="size-option <?= $size['sizeId'] == $OneVariations['sizeId'] ? "active__size" : "" ?>"
                                    data-quantity="<?= $size['sizeId'] == $OneVariations['sizeId'] ? $size['quantity'] : 0 ?>">
                                    <?= $size['size'] ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div>
                        <h3 class="detail__number">Số lượng</h3>
                        <div class="row justify-content-between align-items-center">
                            <div class="number row align-items-center">
                                <button id="decrease " class="btn giam" onclick="updateSoLuongChon(-1)">-</button>
                                <span id="soluongchon" class="hienthi">1</span>
                                <button id="increase " class="btn tang" onclick="updateSoLuongChon(1)">+</button>
                            </div>
                            <div class="add__cart l-9 ">
                                Thêm giỏ hàng
                            </div>
                        </div>
                        <div class="cate__new">
                            Mua Ngay
                        </div>
                        <div class="payment-methods">
                            <div class="">
                                <div><img src="https://yody.vn/icons/zalopay.png" alt="ZaloPay"></div>
                                <div><img src="https://yody.vn/icons/visa-card.png" alt="Visa"></div>
                                <div><img src="https://yody.vn/icons/master-card.png" alt="MasterCard"></div>
                                <div><img src="https://yody.vn/icons/vnpay-qr.png" alt="VNPay"></div>
                                <div><img src="https://yody.vn/icons/momo.png" alt="MoMo"></div>
                            </div>
                            <p class="text-align-center">Đảm bảo thanh toán an toàn và bảo mật</p>
                        </div>
                        <div class="info__ship">
                            <div>
                                <span><img loading="lazy" src="Frontend/public/svg/car.svg" alt=""></span>
                                <span> Miễn phí vận chuyển: Đơn hàng từ 498k</span>
                            </div>
                            <div>
                                <span><img loading="lazy" src="Frontend/public/svg/times.svg" alt=""></span>
                                <span> Giao hàng: Từ 3 - 5 ngày trên cả nước</span>
                            </div>
                            <div>
                                <span><img loading="lazy" src="Frontend/public/svg/traodoi.svg" alt=""></span>
                                <span> Miễn phí đổi trả: Tại 267+ cửa hàng trong 15 ngày</span>
                            </div>
                            <div>
                                <span><img loading="lazy" src="Frontend/public/svg/mac.svg" alt=""></span>
                                <span> Sử dụng mã giảm giá ở bước thanh toán</span>
                            </div>
                            <div>
                                <span><img loading="lazy" src="Frontend/public/svg/baove.svg" alt=""></span>
                                <span> Thông tin bảo mật và mã hóa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="l-1"></div>
            </div>
        </main>

        <!-- comment -->

        <section class="comment grid wide">
            <h2 class="comment__detail">Đánh giá sản phẩm</h2>
            <?php if (!empty($comment)): ?>
                <?php foreach ($comment as $data): ?>
                    <article class="comment__item">
                        <div class="comment__profile">
                            <img src="<?= $data['userAvatar'] ?>" alt="User Profile">
                            <p class="comment__profile-username" style="  overflow:hidden; width: 90px; ">
                                <?= $data['userName'] ?></p>
                        </div>
                        <div class="comment__body">
                            <div class="comment__header">
                                <p class="comment__profile-date"><?= $data['commentCreatedAt'] ?></p>
                            </div>
                            <div class="comment__rating">
                                <?php
                                $sosao = $data['rating'];
                                $tongso_sao = 5;

                                for ($i = 1; $i <= $tongso_sao; $i++):
                                    if ($i <= $sosao): ?>
                                        <span class="star">&#9733;</span> <!-- Sao đầy -->
                                    <?php else: ?>
                                        <span class="star">&#9734;</span> <!-- Sao rỗng -->
                                <?php endif;
                                endfor;
                                ?>
                            </div>

                            <div class="comment__content">
                                <p><?= $data['content'] ?></p>
                            </div>
                            <div class="comment__image">
                                <img src="<?= $data['variationImage'] ?>" alt="">
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: green;" class="no-comment">Sản phẩm chưa có đánh giá nào!</p>
            <?php endif; ?>
        </section>


        <!-- Cos theer ban se thich -->
        <section class="canyoulikeit     grid wide">
            <h2>
                Có thể bạn sẽ thích
            </h2>
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

        </section>
    </div>
    <?php require_once(HF . "footer.php")  ?>
    <script src="Frontend/Js/detail.js"></script>


</body>



</html>