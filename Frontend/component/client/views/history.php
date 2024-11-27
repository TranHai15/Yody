<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/history.css">
    <title>Lịch sử mua hàng</title>
</head>

<body>
    <div class="history-container">
        <?php require_once(HF . "header.php") ?>

        <!-- Đơn hàng -->
        <main class="order-section grid wide">
            <div class="section-title">
                <p>Đơn hàng</p>
            </div>
            <div class="order-list">
                <div class="order-item">
                    <input type="checkbox" checked disabled>
                    <img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-polo-nam-apm3519-tit-8-yodyvn-37aff9b7-3131-4177-9d37-85ff05249575.jpg"
                        alt="T-shirt">
                    <div class="order-detail">
                        <p>T-shirt Kid Bé In Khủng Long</p>
                        <div class="order-price">
                            125.000 đ <span><del>169.000 đ</del></span>
                        </div>
                        <p>Màu: Vàng</p>

                        <p>Trạng thái: <span class="status">Đang chờ duyệt</span></p>
                    </div>
                    <button class="btn-detail" onclick="showDetails(event)">Chi tiết</button>
                    <div class="popup hidden">
                        <p><strong>Trạng thái:</strong> Đang chờ xác nhận</p>
                        <p><strong>Ngày đặt hàng:</strong> 27/11/2024</p>
                        <p><strong>Tên sản phẩm:</strong> T-shirt Kid Bé In Khủng Long</p>
                        <p><strong>Màu:</strong> Vàng</p>
                        <p><strong>Size:</strong> XL</p>
                        <p><strong>Số lượng:</strong> 3</p>
                        <p><strong>Số tiền phải trả:</strong> 300.000đ</p>
                        <button class="close-btn" onclick="closePopup(event)">Đóng</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Lịch sử mua hàng -->
        <main class="history-section grid wide">
            <div class="section-title">
                <p>Lịch sử mua hàng</p>
            </div>
            <div class="history-list">
                <div class="history-item">
                    <input type="checkbox" checked disabled>
                    <img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-polo-nam-apm3519-tit-8-yodyvn-37aff9b7-3131-4177-9d37-85ff05249575.jpg"
                        alt="T-shirt">
                    <div class="history-detail">
                        <p>T-shirt Kid Bé In Khủng Long</p>
                        <div class="history-price">
                            125.000 đ <span><del>169.000 đ</del></span>
                        </div>
                        <p>Số lượng: 3</p>
                        <p>Ngày mua: 20/11/2024</p>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once(HF . "footer.php") ?>
    </div>
    <div class="overlay hidden" onclick="closePopupOutside()"></div>


    <script src="Frontend/Js/history.js"></script>
</body>

</html>