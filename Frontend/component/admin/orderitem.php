<style>
    select.is-invalid {
        border: 1px solid red;
        background-color: #f8d7da;
    }

    .low-stock td {
        color: red;
        /* Chữ màu đỏ cho các sản phẩm gần hết hàng */
    }
</style>
<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh sách Chi Tiết Đơn Hàng</h2>

        <a style="margin-bottom: 20px; display: block;" href="<?= P ?>/admin?Order"> <button class="btn btn-secondary btn-sm 
   ">Quay lại</button></a>
        <!-- Bộ lọc trạng thái đơn hàng -->
        <div class="filter-container mb-3">

            <select id="orderStatusFilter" class="form-select form-select-sm" onchange="filterOrders()">
                <option value="all">Tất cả</option>
                <?php foreach ($dataAllOrderStatus as $status) : ?>
                    <option value="<?= $status['statusId'] ?>"><?= $status['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Bảng danh sách chi tiết đơn hàng -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Lý do hủy đơn (nếu có)</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <?php foreach ($kq as $item) : ?>
                        <?php
                        $lowStockClass = $item['soluongton'] <= 10 ? 'low-stock' : '';
                        ?>
                        <tr class="<?= $lowStockClass ?>" data-status="<?= $item['statusId'] ?>">
                            <td class="text-center"><?= $item['orderitemId'] ?></td>
                            <td class="text-center">
                                <img src="<?= $item['anhsp'] ?>" alt="Hình sản phẩm" style="width: 50px; height: auto;">
                            </td>
                            <td><?= $item['tensanpham'] ?></td>
                            <td class="text-center"><?= $item['mausp'] ?></td>
                            <td class="text-center"><?= $item['size'] ?></td>
                            <td class="text-center"><?= $item['quantity'] ?>/ <?= $item['soluongton'] ?></td>
                            <td class="text-center"><?= number_format($item['price'], 0, ',', '.') ?> ₫</td>
                            <td>
                                <select id="statusId-<?= $item['orderitemId'] ?>"
                                    class="form-select form-select-sm statusId" data-statusid="<?= $item['statusId'] ?>"
                                    onchange="updateStatus(<?= $item['orderitemId'] ?>, this)">
                                    <?php foreach ($dataAllOrderStatus as $status) : ?>
                                        <option value="<?= $status['statusId'] ?>"
                                            <?= $status['statusId'] == $item['statusId'] ? 'selected' : '' ?>>
                                            <?= $status['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select id="payStatusId-<?= $item['orderitemId'] ?>"
                                    class="form-select form-select-sm payStatusId"
                                    data-paystatusid="<?= $item['payStatusId'] ?>"
                                    onchange="updatePayStatus(<?= $item['orderitemId'] ?>, this)">
                                    <?php foreach ($dataAllPayStatus as $payStatus) : ?>
                                        <option value="<?= $payStatus['payStatusId'] ?>"
                                            <?= $payStatus['payStatusId'] == $item['payStatusId'] ? 'selected' : '' ?>>
                                            <?= $payStatus['paymentStatus'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><?= $item['lydo'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm d-none" id="update-btn-<?= $item['orderitemId'] ?>"
                                    onclick="handleUpdate(<?= $item['orderitemId'] ?>)">Cập nhật</button>
                                <button class="btn btn-secondary btn-sm d-none" id="cancel-btn-<?= $item['orderitemId'] ?>"
                                    onclick="cancelEdit(<?= $item['orderitemId'] ?>)">Hủy</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</main>

<script>
    // Lọc trạng thái đơn hàng
    function filterOrders() {
        const filterValue = document.getElementById('orderStatusFilter').value;
        const rows = document.querySelectorAll('#orderTableBody tr[data-status]');

        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            row.style.display = filterValue === 'all' || filterValue === status ? '' : 'none';
        });
    }

    // Kiểm tra và cập nhật trạng thái đơn hàng
    function updateStatus(orderitemId, dropdown) {
        const newValue = parseInt(dropdown.value);
        const currentValue = parseInt(dropdown.getAttribute('data-statusid'));
        const updateButton = document.getElementById(`update-btn-${orderitemId}`);
        const cancelButton = document.getElementById(`cancel-btn-${orderitemId}`);

        if (newValue <= currentValue) {
            dropdown.classList.add('is-invalid');
            setTimeout(() => dropdown.classList.remove('is-invalid'), 2000);
            dropdown.value = currentValue;
            return;
        }

        // Hiển thị nút "Cập nhật" và "Hủy" khi có thay đổi
        updateButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none');
    }

    function updatePayStatus(orderitemId, dropdown) {
        const newValue = parseInt(dropdown.value);
        const currentValue = parseInt(dropdown.getAttribute('data-paystatusid'));
        const updateButton = document.getElementById(`update-btn-${orderitemId}`);
        const cancelButton = document.getElementById(`cancel-btn-${orderitemId}`);

        if (newValue <= currentValue) {
            dropdown.classList.add('is-invalid');
            setTimeout(() => dropdown.classList.remove('is-invalid'), 2000);
            dropdown.value = currentValue;
            return;
        }

        // Hiển thị nút "Cập nhật" và "Hủy" khi có thay đổi
        updateButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none');
    }

    // Xử lý cập nhật
    function handleUpdate(orderitemId) {
        if (confirm('Bạn có chắc muốn cập nhật?')) {
            const statusDropdown = document.getElementById(`statusId-${orderitemId}`);
            const payStatusDropdown = document.getElementById(`payStatusId-${orderitemId}`);

            const statusId = parseInt(statusDropdown.value);
            const payStatusId = parseInt(payStatusDropdown.value);

            fetch(
                    `Backend/controller/admin/adminAjax.php?orderitemId=${orderitemId}&statusId=${statusId}&payStatus=${payStatusId}`
                )
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // alert('Cập nhật thành công!');
                        showNotification("Cập Nhật Thành Công")
                        document.getElementById(`update-btn-${orderitemId}`).classList.add('d-none');
                        document.getElementById(`cancel-btn-${orderitemId}`).classList.add('d-none');

                        // Cập nhật giá trị hiện tại cho dropdown
                        statusDropdown.setAttribute('data-statusid', statusId);
                        payStatusDropdown.setAttribute('data-paystatusid', payStatusId);
                    } else {
                        alert('Cập nhật thất bại: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // Xử lý hủy sửa
    function cancelEdit(orderitemId) {
        const statusDropdown = document.getElementById(`statusId-${orderitemId}`);
        const payStatusDropdown = document.getElementById(`payStatusId-${orderitemId}`);
        const updateButton = document.getElementById(`update-btn-${orderitemId}`);
        const cancelButton = document.getElementById(`cancel-btn-${orderitemId}`);

        // Khôi phục giá trị ban đầu
        statusDropdown.value = statusDropdown.getAttribute('data-statusid');
        payStatusDropdown.value = payStatusDropdown.getAttribute('data-paystatusid');

        // Ẩn nút "Cập nhật" và "Hủy"
        updateButton.classList.add('d-none');
        cancelButton.classList.add('d-none');
    }

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