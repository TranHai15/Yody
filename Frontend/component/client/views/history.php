<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/history.css?ver=2">


    <title>Danh sách Đơn Hàng</title>




</head>

<body>

    <div class="container">
        <h1>Danh sách Đơn Hàng</h1>

        <div class="orders-container">
            <?php if (!empty($dulieulayra)) : ?>
                <?php foreach ($dulieulayra as $order): ?>
                    <div class="order-card">
                        <h3>Đơn Hàng <?php echo $order['orderId']; ?></h3>

                        <div class="info">
                            <span>Trạng Thái Đơn Hàng:</span>

                            <span class="status 
                                <?php
                                if ($order['statusId'] == 1) {
                                    echo 'pending';
                                } elseif ($order['statusId'] == 2) {
                                    echo 'processing';
                                } else {
                                    echo 'completed';
                                }
                                ?>">
                                <?= $order['statusDonhang'] ?>
                            </span>

                        </div>

                        <div class="info">
                            <span>Trạng Thái Thanh Toán:</span>
                            <span class="payment-status">
                                <?= $order['phuongthucTT']   ?>
                            </span>
                        </div>

                        <div class="info">
                            <span>Địa Chỉ:</span> <?php echo $order['address']; ?>
                        </div>

                        <div class="info">
                            <span>Phương Thức Thanh Toán:</span> <?php echo $order['paymethod']; ?>
                        </div>

                        <div class="info">
                            <span>Ngày Đặt:</span> <?php echo $order['createAt']; ?>
                        </div>

                        <div class="info">
                            <span>Ngày Cập Nhật:</span> <?php echo $order['updateAt']; ?>
                        </div>

                        <div class="price">
                            <span>Tổng Tiền:</span> <?php echo number_format($order['sumPrice'], 0, ',', '.'); ?> VND
                        </div>

                        <div class="buttons">

                            <div class="buttons">
                                <?php if ($order['statusId'] == 8): ?>
                                    <button
                                        class="btn btn-cancel"
                                        disabled>
                                        Đã Hủy
                                    </button>
                                <?php else: ?>
                                    <button
                                        class="btn btn-cancel"
                                        data-order-id="<?= $order['orderId'] ?>">
                                        Hủy Đơn
                                    </button>
                                <?php endif; ?>
                                <a href="<?= P ?>/itemOrder?id=<?= $order['orderId'] ?>">
                                    <button class="btn btn-details">Chi Tiết</button>
                                </a>
                            </div>


                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="df"><a href="<?= P ?>">
                        <Button class="btn btn-siu">Mua ngay nào!</Button>
                    </a>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div id="popup-cancel-order" class="popup hidden">
        <div class="popup-content">
            <h2>Xác Nhận Hủy Đơn</h2>
            <p>Vui lòng chọn lý do hủy đơn:</p>
            <form id="cancel-form">
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason" value="Đổi ý"> Đổi ý</label><br>
                    <label><input type="checkbox" name="reason" value="Sản phẩm không đúng mô tả"> Sản phẩm không đúng mô tả</label><br>
                    <label><input type="checkbox" name="reason" value="Thời gian giao hàng lâu"> Thời gian giao hàng lâu</label><br>
                    <label><input type="checkbox" name="reason" value="Lý do khác"> Lý do khác</label>
                </div>
                <div class="popup-buttons">
                    <input type="text" name="additionalReason" placeholder="Nhập lý do khác (nếu có)">
                    <button type="button" id="submit-form" class="btn btn-info">Gửi</button>
                    <button type="button" id="close-form" class="btn btn-danger">Đóng</button>
                </div>
            </form>

        </div>
    </div>
    <div id="overlay" class="hidden"></div>

</body>
<script src="Frontend/Js/history.js"></script>



</html>