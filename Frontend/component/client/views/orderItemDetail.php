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

            <?php if (!empty($dulieulayra)) : ?>
                <?php foreach ($dulieulayra as $data): ?>
                    <div class="item-card">

                        <img src="<?= $data['anhsp'] ?>" alt="Tên sản phẩm">
                        <div class="item-info">
                            <h3><?= $data['tensanpham'] ?></h3>
                            <p>Số Lượng: <?= $data['quantity'] ?></p>
                            <p>Đơn Giá: <?= $data['price'] > 0 ? "" . number_format($data['price'], 0, ',', '.') . "đ" : ""; ?></p>
                            <p>
                                <select name="" id="" disabled>
                                    <option value="">
                                        <?= $data['size'] ?>,
                                        <?= $data['mausp'] ?>
                                    </option>
                                </select>
                            </p>
                            <p class="<?= $data['idtrangthaidonhang'] == 8 ? 'do' : 'xanh' ?>">
                                Đơn hàng: <?= htmlspecialchars($data['trangthaidonhang']) ?>
                            </p>

                            <p>Tình trạng: <?= $data['trangthaithanhtoan'] ?></p>
                        </div>

                        <!-- Nút hủy mặt hàng -->
                        <button
                            class="btn btn-cancel"
                            data-item-id="<?= $data['orderitemId'] ?>"
                            <?= $data['idtrangthaidonhang'] == 8 ? 'disabled' : '' ?>>
                            Hủy Mặt Hàng
                        </button>

                    </div>
                <?php endforeach ?>

            <?php else : ?>

            <?php endif  ?>


            <!-- Thêm các sản phẩm khác tại đây -->
        </div>
        <div id="popup-cancel-item" class="popup hidden">
            <div class="popup-content">
                <h2>Xác Nhận Hủy Mặt Hàng</h2>
                <p id="cancel-message">Bạn có chắc chắn muốn hủy mặt hàng này không?</p>
                <form id="cancel-item-form">
                    <input type="hidden" id="item-id" name="orderItemId" value="">
                    <label for="cancel-reason">Lý do hủy:</label>
                    <textarea id="cancel-reason" name="reason" placeholder="Nhập lý do hủy..." required></textarea>
                    <div class="popup-buttons">
                        <button type="button" id="confirm-cancel" class="btn btn-danger">Xác Nhận</button>
                        <button type="button" id="close-popup" class="btn btn-secondary">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="overlay" class="hidden"></div>


    </div>

</body>
<script src="Frontend/Js/orderItemDetail.js"></script>

</html>