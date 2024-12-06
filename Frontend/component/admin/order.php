<style>
    /* Hiệu ứng khi chọn trạng thái không hợp lệ */
    select.is-invalid {
        border: 1px solid red;
        background-color: #f8d7da;
    }

    /* Hiển thị màu đỏ cho các đơn hàng bị hủy */
    .low-stock {
        color: red !important;
        background-color: red;
    }
</style>

<main id="main" class="main">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh sách Order</h2>

        <!-- Bộ lọc trạng thái -->
        <div class="filter-container mb-3">
            <label for="orderStatusFilter" class="form-label">Lọc theo trạng thái:</label>
            <select id="orderStatusFilter" class="form-select form-select-sm" onchange="filterOrders()">
                <option value="all">Tất cả</option>
                <?php foreach ($dataAllOrderStatus as $status) : ?>
                    <option value="<?= $status['statusId'] ?>"><?= $status['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Bảng danh sách order -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Người mua</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Lý do hủy (nếu có)</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Ngày cập nhật trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <?php foreach ($dataAllOrders as $order) : ?>
                        <tr data-status="<?= $order['statusId'] ?> "
                            class="<?= $order['statusId'] == 8 ? 'low-stock' : "low-stock"  ?>">
                            <td class="text-center"><?= $order['orderId'] ?></td>
                            <td class="text-center"><?= $order['name'] ?></td>
                            <td>
                                <select id="statusId-<?= $order['orderId'] ?>" name="statusId"
                                    class="form-select form-select-sm statusId" data-statusid="<?= $order['statusId'] ?>"
                                    onchange="updateStatus(<?= $order['orderId'] ?>, this)">
                                    <?php foreach ($dataAllOrderStatus as $status) : ?>
                                        <option value="<?= $status['statusId'] ?>"
                                            <?= $status['statusId'] == $order['statusId'] ? 'selected' : '' ?>>
                                            <?= $status['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="text-center">
                                <?= $order['statusId'] == 8 ? ($order['lydomuonhuydon'] ?? 'Không có lý do') : '-' ?></td>
                            <td class="text-center">
                                <?php foreach ($dataAllPay as $pay) : ?>
                                    <?php if ($order['payId'] == $pay['payId']) : ?>
                                        <?= $pay['name'] ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <select id="payStatusId-<?= $order['orderId'] ?>" name="payStatusId"
                                    class="form-select form-select-sm payStatusId"
                                    data-paystatusid="<?= $order['payStatusId'] ?>"
                                    onchange="updatePayStatus(<?= $order['orderId'] ?>, this)">
                                    <?php foreach ($dataAllPayStatus as $paystatus) : ?>
                                        <option value="<?= $paystatus['payStatusId'] ?>"
                                            <?= $paystatus['payStatusId'] == $order['payStatusId'] ? 'selected' : '' ?>>
                                            <?= $paystatus['paymentStatus'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="text-center"><?= number_format($order['sumPrice'], 0, ',', '.') . ' ₫' ?></td>

                            <td class="text-center"><?= $order['updateAt'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm d-none" id="update-btn-<?= $order['orderId'] ?>"
                                    onclick="handleUpdate(<?= $order['orderId'] ?>)">Cập nhật</button>
                                <button class="btn btn-secondary btn-sm d-none" id="cancel-btn-<?= $order['orderId'] ?>"
                                    onclick="cancelEdit(<?= $order['orderId'] ?>)">Hủy</button>
                                <a href="<?= P ?>/admin?orderItem=<?= $order['orderId'] ?>">
                                    <button class="btn btn-success btn-sm">Chi tiết</button>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    function filterOrders() {
        const filterValue = document.getElementById('orderStatusFilter').value;
        console.log("Selected filter value:", filterValue); // Kiểm tra giá trị lọc

        const rows = document.querySelectorAll('#orderTableBody tr[data-status]'); // Chọn tất cả các dòng có data-status
        rows.forEach(row => {
            const status = row.getAttribute('data-status').trim(); // Tránh các ký tự thừa
            console.log("🚀 ~ filterOrders ~ status:", status);

            // Kiểm tra nếu filterValue là 'all' hoặc status khớp với filterValue
            if (filterValue === 'all' || status === filterValue.toString()) { // Ép kiểu filterValue thành chuỗi
                row.style.display = ''; // Hiển thị dòng
                console.log("Row status:", status); // Kiểm tra giá trị data-status của dòng
            } else {
                row.style.display = 'none'; // Ẩn dòng
                // console.log("Row statussssss:", status); // Kiểm tra giá trị data-status của dòng
            }
        });
    }


    // Kiểm tra và cập nhật trạng thái đơn hàng
    function updateStatus(orderId, dropdown) {
        const newValue = parseInt(dropdown.value);
        const currentValue = parseInt(dropdown.getAttribute('data-statusid'));
        const updateButton = document.getElementById(`update-btn-${orderId}`);
        const cancelButton = document.getElementById(`cancel-btn-${orderId}`);

        if (newValue <= currentValue) {
            dropdown.classList.add('is-invalid');
            setTimeout(() => dropdown.classList.remove('is-invalid'), 2000);
            dropdown.value = currentValue;
            return;
        }

        // Hiển thị nút "Cập nhật" và "Hủy"
        updateButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none');
    }

    function updatePayStatus(orderId, dropdown) {
        const newValue = parseInt(dropdown.value);
        const currentValue = parseInt(dropdown.getAttribute('data-paystatusid'));
        const updateButton = document.getElementById(`update-btn-${orderId}`);
        const cancelButton = document.getElementById(`cancel-btn-${orderId}`);

        if (newValue <= currentValue) {
            dropdown.classList.add('is-invalid');
            setTimeout(() => dropdown.classList.remove('is-invalid'), 2000);
            dropdown.value = currentValue;
            return;
        }

        // Hiển thị nút "Cập nhật" và "Hủy"
        updateButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none');
    }

    // Cập nhật đơn hàng
    function handleUpdate(orderId) {
        if (confirm('Bạn xác nhận muốn cập nhật?')) {
            const statusDropdown = document.getElementById(`statusId-${orderId}`);
            const payStatusDropdown = document.getElementById(`payStatusId-${orderId}`);

            const statusId = parseInt(statusDropdown.value);
            const payStatusId = parseInt(payStatusDropdown.value);

            fetch(`Backend/controller/admin/adminAjax.php?payStatus=${payStatusId}&statusId=${statusId}&orderId=${orderId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        // alert('Cập nhật thành công!');
                        showNotification('Cập nHật Thành Công')
                        document.getElementById(`update-btn-${orderId}`).classList.add('d-none');
                        document.getElementById(`cancel-btn-${orderId}`).classList.add('d-none');

                        // Cập nhật trạng thái hiện tại
                        statusDropdown.setAttribute('data-statusid', statusId);
                        payStatusDropdown.setAttribute('data-paystatusid', payStatusId);
                    } else {
                        alert('Cập nhật thất bại: ' + data.message);
                    }
                })
                .catch(err => console.error('Error:', err));
        }
    }

    // Hủy chỉnh sửa
    function cancelEdit(orderId) {
        const statusDropdown = document.getElementById(`statusId-${orderId}`);
        const payStatusDropdown = document.getElementById(`payStatusId-${orderId}`);
        const updateButton = document.getElementById(`update-btn-${orderId}`);
        const cancelButton = document.getElementById(`cancel-btn-${orderId}`);

        // Khôi phục giá trị ban đầu
        statusDropdown.value = statusDropdown.getAttribute('data-statusid');
        payStatusDropdown.value = payStatusDropdown.getAttribute('data-paystatusid');

        // Ẩn nút "Cập nhật" và "Hủy"
        updateButton.classList.add('d-none');
        cancelButton.classList.add('d-none');
    }
</script>

<script>
    function showNotification(message, type = "success") {
        const notification = document.createElement("section");
        notification.className = `notification ${type}`;
        notification.innerHTML = `<div><p>${message}</p></div>`;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = "0";
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
</script>