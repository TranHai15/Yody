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
                    <div class="products__check--all row align-items-center">
                        <input type="checkbox" class="check" name="" id="check__sale">
                        <p>Sản phẩm nguyên giá</p>
                    </div>
                    <?php foreach ($dulieu as $data): ?>
                        <article class="product__item row  ">
                            <div class="cart__product--item">
                                <input type="checkbox" class="check" name="" id="">
                                <div class="item">
                                    <div class="cart__img">
                                        <img loading="lazy"
                                            src="<?= $data['image'] ?>"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="cart__information">
                                <div>
                                    <p class="cart__name"><?= $data['product_name'] ?></p>
                                    <div class="cart__price row">
                                        <p class="cart__price--new">


                                            <?= number_format($data['variation_price'] - ($data['variation_price'] * ($data['variation_sale'] / 100)), 0, ',', '.') . "đ" ?>
                                        </p>
                                        <p class="cart__price--old"> <?= number_format($data['variation_price'], 0, ',', '.') . "đ" ?></p>
                                    </div>
                                </div>
                                <div class="">
                                    <select name="" id="cart__select">
                                        <option value=""><?= $data['color'] ?>, <?= $data['size'] ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="item__quantity">
                                <div class="cart__quantity">
                                    <button>-</button>
                                    <span><?= $data['total_quantity'] ?> </span>
                                    <button>+</button>
                                </div>
                            </div>

                        </article>
                        <hr>
                    <?php endforeach ?>

                </div>

            </div>
            <div class=" cart__information--cate background">
                <div class="cart__detail">
                    <div class="cart-information-detail">
                        <p class="cart__title">Chi tiết đơn hàng</p>
                        <div class="cart__ship row justify-content-between align-items-center ">
                            <p>Tổng giá trị sản phẩm </p><span><?= number_format($tongTienPhaiTra['total'], 0, ',', '.') . "đ" ?> </span>
                        </div>
                        <div class="cart__ship  row justify-content-between align-items-center">
                            <p>Vận chuyển </p><span>20.000 đ</span>
                        </div>
                        <div class="cart__ship row justify-content-between align-items-center">
                            <p>Giảm giá vận chuyển</p><span class="sale__cart">- 20.000 đ</span>
                        </div>
                    </div>
                    <hr>
                    <div class="cart__title row justify-content-between align-items-center  ">
                        <p class="">Tổng thanh toán</p> <span><?= number_format($tongTienPhaiTra['total'], 0, ',', '.') . "đ" ?></span>

                    </div>
                    <a href="<?= P ?>/pay"><button class="btn__confirm">Mua hàng</button></a>

                </div>
                <div class="payment-methods">
                    <div class="cart__voucher">Chọn Voucher giảm giá ở bước tiếp theo</div>
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

</body>

</html>