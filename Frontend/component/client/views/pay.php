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
                <form class="checkout" method="POST" action="<?= P ?>/order">
                    <input type="hidden" name="userId" id="" value=" <?= $_SESSION['userId'] ?> ">
                    <input type="hidden" name="statusId" id="" value="2">
                    <input type="hidden" name="payStatusId" id="" value="12">
                    <div class="checkout__receiver">
                        <h2 class="checkout__receiver-title">Người nhận</h2>
                        <div>
                            <div class="ooooo">

                                <input type="text" class="checkout__receiver-input ooooo" name="customer_name"
                                    placeholder="Tên khách hàng">
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div>
                            <div class="ooooo">

                                <input type="text" class="checkout__receiver-input ooooo" name="phone_number"
                                    placeholder="Số điện thoại">
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="ooooo">

                            <input type="email" class="checkout__receiver-input ooooo" name="email"
                                placeholder="Địa chỉ email (không bắt buộc)">
                        </div>
                    </div>

                    <div class="checkout__address">
                        <label for="address" class="checkout__receiver-title">Địa chỉ của bạn</label>
                        <label class="romm--title" for="province">Tỉnh Thành Phố</label>
                        <select id="address" name="province_id" class="checkout__address-select">
                            <?php foreach ($dataAllProvince as $Pro): ?>
                                <option value="<?= $Pro['province_id'] ?>"><?= $Pro['name'] ?></option>
                            <?php endforeach ?>
                        </select>

                        <div class="form2">
                            <label class="romm--title" for="district">Quận Huyện</label>
                            <input type="hidden" id="district" name="district" placeholder="Nhập Quận Huyện">
                        </div>

                        <div class="form3">
                            <label class="romm--title" for="ward">Xã</label>
<input type="hidden" id="ward" name="ward" placeholder="Nhập Xã">
                        </div>

                        <input type="text" class="checkout__address-home" name="street_address"
                            placeholder="Nhập địa chỉ (ví dụ 90 Nguyễn Tuân)">
                        <span class="error-message"></span>
                        <input type="text" class="checkout__address-note" name="note"
                            placeholder="Nhập ghi chú (không bắt buộc)">
                    </div>

                    <div class="phuongthucthanhtoan">
                        <div class="checkout__paymentMethod">
                            <h2 class="checkout__paymentMethod-title">Phương thức thanh toán</h2>
                            <label class="checkout__paymentMethod-option">
                                <input type="radio" name="payment_method" value="1"
                                    class="checkout__paymentMethod-input" checked> Tiền mặt
                            </label>
                            <label class="checkout__paymentMethod-option">
                                <input type="radio" name="payment_method" value="2"
                                    class="checkout__paymentMethod-input-2"> Chuyển khoản
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="sumprice" value="" id="sumPrice">
                    <div class="checkout__pay">
                        <button type="submit" class="checkout__pay-cod">
                            <p>Thanh toán</p>
                        </button>
                    </div>
                    <div class="checkout__pay-onine">
                        <button type="submit" name="payUrl" class="checkout__pay-cod">
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
                </form>



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

                    <div class="thanhtoan" data-sumPrice="<?= $tongTienPhaiTra['total']  ?>">
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