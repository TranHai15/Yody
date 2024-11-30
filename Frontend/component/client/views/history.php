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
                <p>Đơn hàng đã đặt</p>
            </div>
            <div class="order-list">
                <?php if (!empty($dulieulayra)) : ?>
                    <?php foreach ($dulieulayra as $dd) : ?>
                        <div class="order-item">
                            <input type="checkbox" checked disabled>
                            <img src="<?= $dd['variationImage'] ?>" alt="T-shirt">
                            <div class="order-detail">
                                <p><?= $dd['productName'] ?></p>
                                <div class="order-price">
                                    <?= $dd['variationPrice'] - ($dd['variationPrice'] * $dd['variationSale'] / 100) ?>
                                    <?php if ($dd['variationSale'] > 0): ?>
                                        <span><del><?= $dd['variationPrice'] ?></del></span>
                                    <?php endif; ?>
                                </div>
                                <p>Màu: <?= $dd['variationColor'] ?></p>
                                <p>Trạng thái: <span class="status" style="color:green;"><?= $dd['orderStatusDescription'] ?></span></p>
                            </div>
                            <button class="btn-detail" onclick="showDetails(event)">Chi tiết</button>
                            <button class="btn-cancel" onclick="showCancelForm(event)">Hủy đơn</button>

                            <!-- Popup Chi tiết -->
                            <div class="popup hidden">
                                <p style="color:green;"><strong>Trạng thái:</strong> <?= $dd['orderStatusDescription'] ?></p>
                                <p><strong>Ngày đặt hàng:</strong> <?= $dd['orderCreateAt'] ?></p>
                                <p><strong>Tên sản phẩm:</strong> <?= $dd['productName'] ?></p>
                                <p><strong>Màu:</strong> <?= $dd['variationColor'] ?></p>
                                <p><strong>Size:</strong> <?= $dd['sizeName'] ?></p>
                                <p><strong>Số lượng:</strong> <?= $dd['quantity'] ?></p>
                                <p><strong>Số tiền phải trả:</strong> <?= $dd['sumPrice'] ?></p>
                                <button class="close-btn" onclick="closePopup(event)">Đóng</button>
                            </div>

                            <!-- Popup Hủy đơn -->
                            <div class="popup-cancel hidden">
                                <p><strong>Hủy đơn hàng</strong></p>
                                <p>Vui lòng chọn lý do hủy:</p>
                                <form>
                                    <label><input type="checkbox" name="reason" value="Đổi ý"> Tôi đổi ý không muốn mua</label><br>
                                    <label><input type="checkbox" name="reason" value="Sản phẩm không phù hợp"> Sản phẩm không phù hợp</label><br>
                                    <label><input type="checkbox" name="reason" value="Thời gian giao hàng lâu"> Thời gian giao hàng lâu</label><br>
                                    <label><input type="checkbox" name="reason" value="Khác"> Lý do khác</label><br>
                                    <textarea name="additionalReason" placeholder="Lý do khác..."></textarea>
                                    <div class="popup-buttons">
                                        <button type="button" class="close-btn" onclick="closePopup(event)">Đóng</button>
                                        <button type="submit" class="submit-btn">Gửi lý do</button>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
        <?php endforeach ?>
    <?php else: ?>
        <!-- Hiển thị nút nếu không có dữ liệu -->
        <div class="no-order" style="margin-bottom: 50px;">
            <p>Bạn chưa có đơn hàng nào!</p>
            <a href="<?= P ?>" class="btn-order-now">Hãy đặt hàng ngay</a>
        </div>
    <?php endif; ?>
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