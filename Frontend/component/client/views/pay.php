<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/pay.css">
    <title>Thanh toán</title>
</head>

<body>
    <?php require_once(HF . "header.php")  ?>
    <main>
        <div class="grid wide row ">
            <!-- section left -->
            <section class="section-left l-7 c-12 m-12 ">
                <div class="checkout">

                    <div class="checkout__receiver">
                        <form class="checkout__receiver-form">
                            <h2 class="checkout__receiver-title">Người nhận</h2>
                            <div>
                                <div class="ooooo">
                                    <span class="checkout__receiver-user"><svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                                        </svg></span>
                                    <input type="text" class="checkout__receiver-input ooooo"
                                        placeholder="Tên khách hàng">
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div>
                                <div class="ooooo">
                                    <span class="checkout__receiver-phone"><svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                        </svg></span>
                                    <input type="text" class="checkout__receiver-input ooooo"
                                        placeholder="Số điện thoại">
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="ooooo">
                                <span class="checkout__receiver-email"><svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                    </svg></span>
                                <input type="email" class="checkout__receiver-input ooooo"
                                    placeholder="Địa chỉ email (không bắt buộc)">
                            </div>


                        </form>
                    </div>


                    <div class="checkout__address">
                        <label for="address" class=" checkout__receiver-title">Địa chỉ của
                            bạn</label>
                        <label class="romm--title" for="">Tỉnh Thành Phố</label>
                        <select id="address" class="checkout__address-select">
                            <?php foreach ($dataAllProvince as $Pro):  ?>
                                <option value="<?= $Pro['province_id'] ?>"><?= $Pro['name'] ?></option>
                            <?php endforeach  ?>

                        </select>
                        <div class="form2">
                            <label class="romm--title" for="">Quận Huyện</label>

                        </div>
                        <div class="form3">
                            <label class="romm--title" for="">Xã</label>
                        </div>


                        <input type="text" class="checkout__address-home"
                            placeholder="Nhập địa chỉ (ví dụ 90 Nguyễn Tuân) ">
                        <span class="error-message"></span>
                        <input type="text" class="checkout__address-note"
                            placeholder="Nhập ghi chú (không bắt buộc)">
                    </div>
                    <div class="phuongthucthanhtoan">

                        <div class="checkout__paymentMethod">
                            <h2 class="checkout__paymentMethod-title">Phương thức thanh toán</h2>

                            <label class="checkout__paymentMethod-option">
                                <input type="radio" name="paymentMethod" value="cod"
                                    class="checkout__paymentMethod-input">
                                Tiền mặt
                            </label>
                            <label class="checkout__paymentMethod-option">
                                <input type="radio" name="paymentMethod" value="bank"
                                    class="checkout__paymentMethod-input">
                                Chuyển khoản
                            </label>
                        </div>

                    </div>
                    <div class="checkout__pay">
                        <button class="checkout__pay-cod">
                            <p>Thanh toán</p>
                        </button>
                    </div>
                    <div class="checkout__card">
                        <img src="https://yody.vn/images/trust-badge/zalopay.png" alt="">
                        <img src="https://yody.vn/images/trust-badge/visa.png" alt="">
                        <img src="https://yody.vn/images/trust-badge/master-card.png" alt="">
                        <img src="https://yody.vn/images/trust-badge/vnpay_qr.png" alt="">
                        <img src="https://yody.vn/images/trust-badge/momo.png" alt="">
                    </div>
                    <p class="title__bottom">Đảm bảo thanh toán an toàn và bảo mật</p>
                </div>




            </section>
            <!-- end section left -->

            <!-- section right -->
            <section class="section-right l-5 c-0 m-0">
                <div class="checkout">
                    <div class="checkout__product-info">
                        <h2 class="checkout__product-info-title">Thông tin sản phẩm</h2>
                        <?php foreach ($dulieu as $data) : ?>
                            <div class="checkout__product">
                                <img src="<?= $data['image'] ?>" alt="T-shirt Nữ" class="checkout__product-image">
                                <div class="checkout__product-details">
                                    <p class="checkout__product-name"><?= $data['product_name'] ?></p>
                                    <p class="checkout__product-color"><?= $data['color'] . ',' . ' ' . $data['size'] ?>
                                    </p>
                                    <div class="tongtien">
                                        <p class="checkout__product-price">
                                            <?= number_format($data['variation_price'] - ($data['variation_price'] * ($data['variation_sale'] / 100)), 0, ',', '.') . "đ" ?>
                                            <span
                                                class="checkout__product-price--original"><?= number_format($data['variation_price'], 0, ',', '.') . "đ" ?></span>
                                        </p>
                                        <hr>
                                        <p>
                                            <?= number_format($data['total_price'], 0, ',', '.') . "đ" ?>
                                        </p>
                                    </div>

                                </div>
                                <span class="checkout__product-quantity">x<?= $data['total_quantity'] ?></span>
                            </div>
                            <hr>

                        <?php endforeach ?>
                        <!-- Repeat similar structure for other products -->
                    </div>

                    <div class="thanhtoan">
                        <p>Tổng thanh toán</p>
                        <span><?= number_format($tongTienPhaiTra['total'], 0, ',', '.') . "đ" ?></span>

                    </div>
                </div>


            </section>
            <!-- end section right -->


        </div>
    </main>

</body>
<script src="Frontend/Js/pay.js"></script>

</html>