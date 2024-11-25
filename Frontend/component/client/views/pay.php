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
                    <div class="checkout__promotion">
                        <p class="checkout__promotion-text">
                            🔥 Chỉ còn 2 phút 24 giây giá ưu đãi sẽ kết thúc! Đừng bỏ lỡ !!
                        </p>
                    </div>
                    <div class="checkout__receiver">
                        <h2 class="checkout__receiver-title">Người nhận</h2>
                        <form class="checkout__receiver-form">
                            <span class="checkout__receiver-user"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                                </svg></span>
                            <input type="text" class="checkout__receiver-input" placeholder="Tên khách hàng">
                            <span class="checkout__receiver-phone"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                </svg></span>
                            <input type="text" class="checkout__receiver-input" placeholder="Số điện thoại">
                            <span class="checkout__receiver-email"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg></span>
                            <input type="email" class="checkout__receiver-input"
                                placeholder="Địa chỉ email (không bắt buộc)">
                        </form>
                    </div>

                    <div class="checkout__delivery">
                        <h2 class="checkout__delivery-title">Hình thức nhận hàng</h2>
                        <div class="checkout__delivery-options">
                            <button class="checkout__delivery-option checkout__delivery-option--selected">Giao tới
                                nhà</button>
                            <button class="checkout__delivery-option checkout__delivery-option--select">Lấy tại cửa
                                hàng</button>
                        </div>
                    </div>
                    <div class="checkout__address">
                        <label for="address" class="checkout__address-label">Địa chỉ của bạn</label>
                        <select id="address" class="checkout__address-select">
                            <option>Chọn Tỉnh/Thành Phố, Quận/Huyện, Phường/Xã</option>
                        </select>
                        <input type="text" class="checkout__address-home"
                            placeholder="Nhập địa chỉ (ví dụ 90 Nguyễn Tuân) ">
                        <input type="text" class="checkout__address-note"
                            placeholder="Nhập ghi chú (không bắt buộc)">
                    </div>
                    <div class="phuongthucthanhtoan">
                        <h2 class="checkout__shippingmethod-title">Phương thức vận chuyển</h2>
                        <div class="checkout__shippingmethod">
                            <div class="box1">
                                <span class="checkout__shippingmethod-span"><input type="radio"
                                        class="checkout__shippingmethod-standard">Tiêu chuẩn <br></span>
                            </div>
                            <div class="box2"><span class="checkout__shippingmethod-ensure">Đảm bảo nhận hàng từ 3 - 5 ngày</span></div>
                        </div>
                        <div class="checkout__paymentMethod">
                            <h2 class="checkout__paymentMethod-title">Phương thức thanh toán</h2>
                            <span class="checkout__paymentMethod-fit">Lựa chọn phương thức thanh toán phù hợp nhất
                                cho bạn</span>
                            <input type="checkbox" class="checkout__paymentMethod-cod">Tiền mặt
                        </div>
                    </div>
                    <div class="checkout__pay">
                        <button class="checkout__pay-cod">
                            <p>Thanh toán bằng tiền mặt</p>
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
                        <div class="checkout__product">
                            <img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nu-yody-TSN7271-XAM-4.JPG"
                                alt="T-shirt Nữ" class="checkout__product-image">
                            <div class="checkout__product-details">
                                <p class="checkout__product-name">T-shirt Nữ Cổ Rộng Croptop</p>
                                <p class="checkout__product-color">Xám, S</p>
                                <p class="checkout__product-price">49.500 đ <span
                                        class="checkout__product-price--original">99.000 đ</span></p>
                            </div>
                            <span class="checkout__product-quantity">x1</span>
                        </div>
                        <div class="checkout__product">
                            <img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nam-yody-TSM7177-TRA,%20QSM7031-TIT%20,(7).JPG"
                                alt="T-shirt Nữ" class="checkout__product-image">
                            <div class="checkout__product-details">
                                <p class="checkout__product-name">T-shirt Nữ Cổ Rộng Croptop</p>
                                <p class="checkout__product-color">Xám, S</p>
                                <p class="checkout__product-price">49.500 đ <span
                                        class="checkout__product-price--original">99.000 đ</span></p>
                            </div>
                            <span class="checkout__product-quantity">x1</span>
                        </div>
                        <!-- Repeat similar structure for other products -->
                    </div>
                </div>


            </section>
            <!-- end section right -->


        </div>
    </main>

</body>


</html>