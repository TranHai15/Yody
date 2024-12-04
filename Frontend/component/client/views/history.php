<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/history.css">
    <title>Danh sách Đơn Hàng</title>




</head>

<body>

    <div class="container">
        <h1>Danh sách Đơn Hàng</h1>

        <div class="orders-container">
            <?php foreach ($dulieulayra as $order): ?>
            <div class="order-card">
                <h3>Đơn Hàng <?php echo $order['orderId']; ?></h3>

                <div class="info">
                    <span>Trạng Thái Đơn Hàng:</span>
                    <span class="status <?php echo ($order['statusId'] == 1) ? 'pending' : 'completed'; ?>">
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
                    <button class="btn btn-cancel">Hủy Đơn</button>
                    <a href="<?= P ?>/itemOrder?id=<?= $order['orderId'] ?>"> <button class="btn btn-details">Chi
                            Tiết</button></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>