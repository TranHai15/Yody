<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh sách Order</h2>

        <!-- Bảng danh sách order -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Người mua</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt hàng</th>
                        <th>Ngày cập nhật trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataAllOrders as $order) : ?>
                        <tr>
                            <!-- ID Order -->
                            <td class="text-center"><?= $order['orderId'] ?></td>
                            <td class="text-center"><?= $order['name'] ?></td>

                            <!-- Dropdown cho Trạng thái đơn hàng -->
                            <td>
                                <select name="statusId<?= $order['orderId'] ?>" data-statusId=""
                                    class="form-select form-select-sm bg-transparent border-0 statusId"
                                    onchange="updateStatus(<?= $order['orderId'] ?>, this.value)">
                                    <?php foreach ($dataAllOrderStatus as $status) : ?>
                                        <option value="<?= $status['statusId'] ?>" class=""
                                            <?= $status['statusId'] == $order['statusId'] ? 'selected' : '' ?>>
                                            <?= $status['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <!-- Phương thức thanh toán -->
                            <td class="text-center">
                                <?php foreach ($dataAllPay as $pay) : ?>
                                    <?php if ($order['payId'] == $pay['payId']) : ?>
                                        <?= $pay['name'] ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <!-- Dropdown cho Trạng thái thanh toán -->
                            <td>
                                <select name="payStatusId<?= $order['orderId'] ?>"
                                    class="form-select form-select-sm bg-transparent border-0 payStatusId"
                                    onchange="updatePayStatus(<?= $order['orderId'] ?>, this.value)">
                                    <?php foreach ($dataAllPayStatus as $paystatus) : ?>
                                        <option value="<?= $paystatus['payStatusId'] ?>"
                                            <?= $paystatus['payStatusId'] == $order['payStatusId'] ? 'selected' : '' ?>>
                                            <?= $paystatus['paymentStatus'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <!-- Ngày đặt hàng -->
                            <td class="text-center"><?= number_format($order['sumPrice'], 0, ',', '.') . ' ₫'     ?></td>
                            <td class="text-center"><?= $order['createAt'] ?></td>

                            <!-- Ngày cập nhật trạng thái -->
                            <td class="text-center"><?= $order['updateAt'] ?></td>

                            <!-- Hành động -->
                            <td class="text-center">
                                <button class="btn btn-success btn-sm"
                                    onclick="toggleDetails(<?= $order['orderId'] ?>, event)">Chi tiết</button>

                                <button class="btn btn-primary btn-sm d-none" id="update-btn-<?= $order['orderId'] ?>"
                                    onclick="handleUpdate(<?= $order['orderId'] ?>)">Cập nhật</button>
                            </td>
                        </tr>

                        <!-- Hiển thị bảng sản phẩm trong đơn hàng -->
                        <tr id="order-details-<?= $order['orderId'] ?>" style="display: none;">
                            <td colspan="8">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <!-- <th>Người dùng</th> -->
                                            <!-- <th>ID</th> -->
                                            <th>Sản phẩm</th>
                                            <th>Kích thước</th>
                                            <th>Số lượng</th>
                                            <th>Tổng giá</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataAllOrderItem as $orderitems) : ?>
                                            <?php if ($orderitems['orderId'] == $order['orderId']) : ?>
                                                <tr>

                                                    <!-- <td class="text-center"><?= $order['userId'] ?></td> -->
                                                    <!-- <td class="text-center"><?= $orderitems['orderId'] ?></td> -->
                                                    <td class="text-center"><?= $orderitems['variationId'] ?></td>
                                                    <td class="text-center"><?= $orderitems['sizeId'] ?></td>
                                                    <td class="text-center"><?= $orderitems['quantity'] ?></td>
                                                    <td class="text-center">
                                                        <?= number_format($orderitems['price'], 0, ',', '.') . ' ₫'   ?></td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    var statusId = document.querySelector(".statusId").value
    var payStatusId = document.querySelector(".payStatusId").value

    // var cons
    // Hiển thị chi tiết đơn hàng
    function toggleDetails(orderId, e) {
        const detailsRow = document.getElementById('order-details-' + orderId);
        const button = e.target;

        if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
            detailsRow.style.display = 'table-row';
            button.innerText = 'Thu gọn';
        } else {
            detailsRow.style.display = 'none';
            button.innerText = 'Chi tiết';
        }
    }

    // Khi thay đổi trạng thái đơn hàng
    function updateStatus(orderId, statusValue) {
        // console.log("statusValue", statusValue)
        statusId = statusValue
        const updateButton = document.getElementById('update-btn-' + orderId);
        updateButton.classList.remove('d-none'); // Hiện nút "Cập nhật"
    }

    // Khi thay đổi trạng thái thanh toán
    function updatePayStatus(orderId, payStatusValue) {
        // console.log("statusValue", payStatusValue)
        payStatusId = payStatusValue
        const updateButton = document.getElementById('update-btn-' + orderId);
        updateButton.classList.remove('d-none'); // Hiện nút "Cập nhật"
    }

    // Khi nhấn "Cập nhật"
    function handleUpdate(orderId) {
        // Lấy dòng hiện tại của bảng
        if (confirm('ban xac nhận chưa')) {
            const row = document.querySelector(`#order-details-${orderId}`).closest('tr');
            if (!row) {
                alert('Không tìm thấy dòng dữ liệu!');
                return;
            }
            // Truy xuất giá trị từ các cột trong dòng, kiểm tra sự tồn tại của các phần tử
            const buyer = row.querySelector('td:nth-child(2)') ? row.querySelector('td:nth-child(2)').innerText.trim() : '';

            // Hiển thị thông tin dưới dạng alert (hoặc thay bằng logic cập nhật nếu cần)
            //         alert(`
            //     Thông tin đơn hàng:
            //     - ID: ${orderId}
            //     - Người mua: ${buyer}
            //     - Trạng thái đơn hàng: ${statusId}
            //     - Trạng thái thanh toán: ${payStatusId}

            // `);

            // const url =
            //     `http://localhost/duan1/Backend/controller/admin/adminAjax.php?product=${payStatusId}&color=${statusId}`;
            fetch(`Backend/controller/admin/adminAjax.php?payStatus=${payStatusId}&statusId=${statusId}&orderId=${orderId}`)
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(`Fetch error: ${res.status}`);
                    }
                    return res.json();
                })
                .then((data) => {
                    console.log("Updated data:", data);
                    // Hiển thị thông báo dựa trên phản hồi từ backend
                    if (data.status === 'success') {
                        alert(data.message); // Cập nhật thành công
                    } else {
                        alert(data.message); // Cập nhật thất bại
                    }
                })
                .catch((error) => {
                    console.error("Error connecting to server:", error);
                });

        }
        const updateButton = document.getElementById('update-btn-' + orderId);
        updateButton.classList.add('d-none'); // Hiện nút "Cập nhật"
    }
</script>