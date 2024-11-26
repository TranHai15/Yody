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
                        <p>Chọn toàn bộ</p>
                    </div>
                    <<<<<<< HEAD <?php foreach ($dulieu as $data): ?> <article class="product__item row  ">
                        <div class="cart__product--item">
                            <input type="checkbox" class="check" name="" id="">
                            <div class="item">
                                <div class="cart__img">
                                    <img loading="lazy" src="<?= $data['image'] ?>" alt="">
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
                                    <p class="cart__price--old">
                                        <?= number_format($data['variation_price'], 0, ',', '.') . "đ" ?></p>
                                    =======
                                    <?php if (!empty($dulieu)) : ?>
                                    <?php foreach ($dulieu as $data): ?>
                                    <article class="product__item row">
                                        <div class="cart__product--item">
                                            <input type="checkbox" class="check product-checkbox" name="" id="">
                                            <div class="item">
                                                <div class="cart__img">
                                                    <img loading="lazy" src="<?= $data['image'] ?>" alt="">
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
                                                    <p class="cart__price--old">
                                                        <?= number_format($data['variation_price'], 0, ',', '.') . "đ" ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="">
                                                <select name="" id="cart__select">
                                                    <option value=""><?= $data['color'] ?>, <?= $data['size'] ?>
                                                    </option>
                                                </select>
                                                >>>>>>> ca9bf712b52fc3f7e5e1fb487ff9264d9b30de92
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
                                            <span><?= number_format($tongTienPhaiTra['total'], 0, ',', '.') . "đ" ?>
                                            </span>
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
                                        <p class="">Tổng thanh toán</p>
                                        <span><?= number_format($tongTienPhaiTra['total'], 0, ',', '.') . "đ" ?></span>

                                    </div>
                                    <a href="<?= P ?>/pay?id=<?= $_SESSION['userId'] ?? "" ?>"><button
                                            class="btn__confirm">Mua hàng</button></a>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy checkbox "Chọn toàn bộ"
        const checkAll = document.getElementById('check__sale');

        // Lấy tất cả checkbox của sản phẩm
        const productCheckboxes = document.querySelectorAll('.product-checkbox');

        // Đặt sự kiện 'change' cho checkbox "Chọn toàn bộ"
        checkAll.addEventListener('change', function() {
            const isChecked = checkAll.checked; // Kiểm tra trạng thái tick của checkbox chính
            productCheckboxes.forEach(checkbox => {
                checkbox.checked =
                isChecked; // Gán trạng thái tick của checkbox chính cho các checkbox sản phẩm
            });
        });

        // Đặt sự kiện 'change' cho từng checkbox sản phẩm
        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Kiểm tra nếu tất cả checkbox sản phẩm đều được tick
                const allChecked = Array.from(productCheckboxes).every(cb => cb.checked);
                checkAll.checked = allChecked; // Gán trạng thái cho checkbox "Chọn toàn bộ"
            });
        });

        // Đặt trạng thái mặc định khi vào trang (tích tất cả)
        checkAll.checked = true;
        productCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });
    </script>
</body>
<script src="Frontend/Js/cart.js"></script>

</html>