<style>
    body {
        font-family: Arial, sans-serif;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-text {
        font-size: 30px;
        font-weight: bold;
        color: #333;
    }

    .table th {
        text-align: center;
    }

    .table td {
        text-align: center;
    }
</style>
<main id="main" class="main">
    <div class="container mt-5">


        <!-- Dòng thông tin tổng quan -->
        <div class="row">
            <!-- Tổng số sản phẩm trong kho -->
            <div class="col-12 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số sản phẩm trong kho</h5>
                        <p id="total-products" class="card-text display-4">0</p>
                    </div>
                </div>
            </div>

            <!-- Tổng số đơn hàng -->
            <div class="col-12 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số đơn hàng</h5>
                        <p id="total-orders" class="card-text display-4">0</p>
                    </div>
                </div>
            </div>

            <!-- Số lượt bán sản phẩm -->
            <div class="col-12 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Số lượt bán sản phẩm</h5>
                        <p id="total-sales" class="card-text display-4">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dòng thông tin tiếp theo -->
        <div class="row mt-4">
            <!-- Số người dùng đang truy cập -->
            <div class="col-12 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Số người dùng đang truy cập</h5>
                        <p id="active-users" class="card-text display-4">0</p>
                    </div>
                </div>
            </div>

            <!-- Số lượng đánh giá -->
            <div class="col-12 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Số lượng đánh giá</h5>
                        <p id="reviews" class="card-text display-4">0</p>
                    </div>
                </div>
            </div>

            <!-- Số người dùng đăng ký trong tuần -->
            <div class="col-12 col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Số người dùng đăng ký trong tuần</h5>
                        <p id="weekly-signups" class="card-text display-4">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu đồ doanh thu -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Biểu đồ Doanh thu (tháng này)</h5>
                        <canvas id="sales-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê chi tiết đơn hàng -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thống kê chi tiết đơn hàng</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tình trạng</th>
                                    <th>Số đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Đơn hàng hoàn thành</td>
                                    <td id="completed-orders">0</td>
                                </tr>
                                <tr>
                                    <td>Đơn hàng đang chờ xử lý</td>
                                    <td id="pending-orders">0</td>
                                </tr>
                                <tr>
                                    <td>Đơn hàng đang vận chuyển</td>
                                    <td id="shipping-orders">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Giả lập dữ liệu từ API hoặc cơ sở dữ liệu
        const data = {
            totalProducts: 1200, // Tổng sản phẩm trong kho
            totalOrders: 350, // Tổng số đơn hàng
            totalSales: 1500, // Tổng số lượt bán
            activeUsers: 120, // Số người dùng đang truy cập
            reviews: 45, // Số lượng đánh giá
            weeklySignups: 25, // Số người dùng đăng ký trong tuần
            completedOrders: 150, // Số đơn hàng đã hoàn thành
            pendingOrders: 50, // Số đơn hàng đang chờ xử lý
            shippingOrders: 80, // Số đơn hàng đang vận chuyển
            monthlySales: [100, 120, 150, 130, 200, 250, 300, 350, 400, 450, 500, 550] // Doanh thu tháng này
        };

        // Hiển thị dữ liệu trên dashboard
        document.getElementById("total-products").textContent = data.totalProducts;
        document.getElementById("total-orders").textContent = data.totalOrders;
        document.getElementById("total-sales").textContent = data.totalSales;
        document.getElementById("active-users").textContent = data.activeUsers;
        document.getElementById("reviews").textContent = data.reviews;
        document.getElementById("weekly-signups").textContent = data.weeklySignups;

        document.getElementById("completed-orders").textContent = data.completedOrders;
        document.getElementById("pending-orders").textContent = data.pendingOrders;
        document.getElementById("shipping-orders").textContent = data.shippingOrders;

        // Tạo biểu đồ doanh thu
        const ctx = document.getElementById("sales-chart").getContext("2d");
        new Chart(ctx, {
            type: "line",
            data: {
                labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"], // Tháng
                datasets: [{
                    label: "Doanh thu",
                    data: data.monthlySales,
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 2,
                    fill: false
                }]
            }
        });
    });
</script>