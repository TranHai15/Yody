<style>
    /* Hiệu ứng khi chọn trạng thái không hợp lệ */
    select.is-invalid {
        border: 1px solid red;
        background-color: #f8d7da;
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
                        <th>Ngày đặt hàng</th>
                        <th>Ngày cập nhật trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <?php foreach ($dataAllOrders as $order) : ?>
                        <tr data-status="<?= $order['statusId'] ?>">
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
                                <?= $order['statusId'] == 8 ? ($order['cancelReason'] ?? 'Không có lý do') : '-' ?></td>
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
                            <td class="text-center"><?= $order['createAt'] ?></td>
                            <td class="text-center"><?= $order['updateAt'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm d-none" id="update-btn-<?= $order['orderId'] ?>"
                                    onclick="handleUpdate(<?= $order['orderId'] ?>)">Cập nhật</button>
                                <a href="<?= P ?>/admin?orderItem=<?= $order['orderId'] ?>"> <button
                                        class="btn btn-success btn-sm ">Chi tiết</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    var statusID = '';
    var payStatusId = '';

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
    function updateStatus(orderId, dropdown) {
        const newValue = parseInt(dropdown.value);
        statusID = newValue;
        const currentValue = parseInt(dropdown.getAttribute('data-statusid'));
        const updateButton = document.getElementById(`update-btn-${orderId}`);

        // Kiểm tra logic: Trạng thái mới phải lớn hơn trạng thái cũ và không phải ID = 8
        if (newValue <= currentValue || newValue === 8) {
            dropdown.classList.add('is-invalid'); // Hiệu ứng màu đỏ
            setTimeout(() => dropdown.classList.remove('is-invalid'), 2000); // Xóa hiệu ứng sau 2s
            dropdown.value = currentValue; // Reset về trạng thái cũ
            return;
        }

        updateButton.classList.remove('d-none'); // Hiển thị nút "Cập nhật"
    }

    // Kiểm tra và cập nhật trạng thái thanh toán
    function updatePayStatus(orderId, dropdown) {
        const newValue = parseInt(dropdown.value);
        const currentValue = parseInt(dropdown.getAttribute('data-paystatusid'));
        const updateButton = document.getElementById(`update-btn-${orderId}`);
        payStatusId = newValue;

        // Kiểm tra logic: Trạng thái mới phải lớn hơn trạng thái cũ
        if (newValue <= currentValue) {
            dropdown.classList.add('is-invalid'); // Hiệu ứng màu đỏ
            setTimeout(() => dropdown.classList.remove('is-invalid'), 2000); // Xóa hiệu ứng sau 2s
            dropdown.value = currentValue; // Reset về trạng thái cũ
            return;
        }

        updateButton.classList.remove('d-none'); // Hiển thị nút "Cập nhật"
    }

    // Cập nhật đơn hàng
    function handleUpdate(orderId) {
        if (confirm('Bạn xác nhận muốn cập nhật?')) {
            // Lấy phần tử select tương ứng với statusId và payStatusId trong tr
            const statusDropdown = document.getElementById(`statusId-${orderId}`);
            const payStatusDropdown = document.getElementById(`payStatusId-${orderId}`);

            // Lấy giá trị hiện tại của statusId và payStatusId trong tr
            const currentStatusId = parseInt(statusDropdown.getAttribute('data-statusid'));
            const currentPayStatusId = parseInt(payStatusDropdown.getAttribute('data-paystatusid'));

            // Lấy giá trị mới từ các dropdown, nếu không thay đổi thì sử dụng giá trị cũ
            const statusId = statusDropdown ? parseInt(statusDropdown.value) : currentStatusId;
            const payStatusId = payStatusDropdown ? parseInt(payStatusDropdown.value) : currentPayStatusId;

            // Kiểm tra nếu không có giá trị thay đổi
            if (statusId === currentStatusId && payStatusId === currentPayStatusId) {
                alert('Không có thay đổi nào để cập nhật.');
                return;
            }

            // Gửi request cập nhật dữ liệu
            fetch(
                    `Backend/controller/admin/adminAjax.php?payStatus=${payStatusId}&statusId=${statusId}&orderId=${orderId}`
                )
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Cập nhật thành công!');
                        document.getElementById(`update-btn-${orderId}`).classList.add('d-none');
                    } else {
                        alert('Cập nhật thất bại: ' + data.message);
                    }
                })
                .catch(err => console.error('Error:', err));
        }
    }
</script>