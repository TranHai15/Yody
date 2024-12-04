<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/orderItemDetail.css?ver=4" />
    <title>Chi Tiết Đơn Hàng</title>
</head>

<body>
    <div class="container">
        <h1>Chi Tiết Đơn Hàng</h1>
        <div class="order-details">
            <div class="item-card">
                <img src="path-to-image.jpg" alt="Tên sản phẩm">
                <div class="item-info">
                    <h3>Tên Sản Phẩm</h3>
                    <p>Số Lượng: 2</p>
                    <p>Đơn Giá: 100,000 VND</p>
                    <p>Tổng: 200,000 VND</p>
                </div>
                <button class="btn btn-cancel" data-item-id="1">Hủy Mặt Hàng</button>
            </div>

            <div class="item-card">
                <img src="path-to-image.jpg" alt="Tên sản phẩm">
                <div class="item-info">
                    <h3>Tên Sản Phẩm 2</h3>
                    <p>Số Lượng: 1</p>
                    <p>Đơn Giá: 300,000 VND</p>
                    <p>Tổng: 300,000 VND</p>
                </div>
                <button class="btn btn-cancel" data-item-id="2">Hủy Mặt Hàng</button>
            </div>

            <!-- Thêm các sản phẩm khác tại đây -->
        </div>
    </div>
</body>

</html>