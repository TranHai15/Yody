<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Frontend/Css/cart.css?var=5" />
    <title>Giỏ hàng</title>
</head>

<body>
    <?php require_once(HF . "header.php")   ?>
    <main class="grid wide carts">
        <div class="title__cart background l-11">Giỏ hàng</div>
        <div class="products__carts l-11  ">
            <div class="cart__products-lists ">
                <div class="cart__product--items">
                    <?php if (!empty($dulieu)) : ?>
                    <div class="products__check--all row align-items-center">
                        <input type="checkbox" class="check" name="" id="check__sale" checked>
                        <p>Chọn toàn bộ</p>
                    </div>
                    <?php endif ?>
                    <?php if (!empty($dulieu)) : ?>
                    <?php foreach ($dulieu as $data): ?>
                    <article class="product__item row" data-cartId="<?= $data['cartId'] ?> "
                        data-cartItem="<?= $data['cartitemId'] ?>">
                        <div class="cart__product--item">
                            <input type="checkbox" class="check product-checkbox" name="" id=""
                                <?= $data['selects'] == 1 ? 'checked' : ""  ?>>
                            <div class="item">
                                <div class="cart__img">
                                    <img loading="lazy" src="<?= $data['image'] ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="cart__information">
                            <div>
                                <p class="cart__name"><?= $data['product_name'] ?></p>
                                <div class="cart__price row" data-gia="<?= $data['variation_sale'] > 0
                                                                                    ? $data['variation_price'] - ($data['variation_price'] * ($data['variation_sale'] / 100))
                                                                                    : $data['variation_price'] ?>">
                                    <?php if ($data['variation_sale'] > 0): ?>
                                    <p class="cart__price--new">
                                        <?= number_format($data['variation_price'] - ($data['variation_price'] * ($data['variation_sale'] / 100)), 0, ',', '.') . "đ" ?>
                                    </p>
                                    <p class="cart__price--old">
                                        <?= number_format($data['variation_price'], 0, ',', '.') . "đ" ?>
                                    </p>
                                    <?php else: ?>
                                    <p class="cart__price--new">
                                        <?= number_format($data['variation_price'], 0, ',', '.') . "đ" ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="">
                                <select name="" id="cart__select">
                                    <option value=""><?= $data['color'] ?>, <?= $data['size'] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="item__quantity">
                            <div class="cart__quantity" data-cartItem="<?= $data['cartitemId'] ?>"
                                data-variationId="<?= $data['variationId'] ?>" data-sizeId="<?= $data['sizeId'] ?>">
                                <button class="giam">-</button>
                                <span class="hienthi"><?= $data['total_quantity'] ?> </span>
                                <button class="tang">+</button>
                            </div>
                        </div>
                    </article>
                    <hr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="themgioHang">
                        <p>Không có sản phẩm nào trong giỏ hàng</p>
                        <a href="/Yody" class="btn-add">Thêm ngay !</a>
                    </div>

                    <?php endif; ?>

                </div>

            </div>
            <div class=" cart__information--cate background">

                <?php if (!($tongTienPhaiTra['total'] == null)) : ?>
                <div class="cart__detail">
                    <div class="cart-information-detail">
                        <p class="cart__title">Chi tiết đơn hàng</p>
                        <div class="cart__ship row justify-content-between align-items-center ">
                            <p>Tổng giá trị sản phẩm </p>
                            <span class="sumPricess"><?= number_format($tongTienPhaiTra['total'], 0, ',', '.') . "đ" ?>
                            </span>
                        </div>
                        <!-- <div class="cart__ship  row justify-content-between align-items-center">
                                <p>Vận chuyển </p><span>20.000 đ</span>
                            </div>
                            <div class="cart__ship row justify-content-between align-items-center">
                                <p>Giảm giá vận chuyển</p><span class="sale__cart">- 20.000 đ</span>
                            </div> -->
                    </div>
                    <hr>
                    <div class="cart__title row justify-content-between align-items-center  ">
                        <p class="">Tổng thanh toán</p>
                        <span
                            class="sumPricess"><?= number_format($tongTienPhaiTra['total'], 0, ',', '.') . "đ" ?></span>

                    </div>
                    <a href="<?= P ?>/pay?id=<?= $_SESSION['userId'] ?? "" ?>" id="btn__confirm"><button
                            class="btn__confirm">Mua
                            hàng</button></a>
                    <div class="cart__voucher">Chọn Voucher giảm giá ở bước tiếp theo</div>
                </div>
                <?php else : ?>
                <p class="cart__title"> Hãy thêm giỏ hàng</p>
                <!-- <p>Hãy thêm vào giỏ hàng</p> -->

                <?php endif ?>
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
            </div>
        </div>
    </main>
    <?php require_once(HF . "footer.php")   ?>
    <script src="Frontend/Js/cart.js">
    // Lấy checkbox "Chọn toàn bộ"
    </script>
</body>

</html>