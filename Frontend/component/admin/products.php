<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh Sách Sản Phẩm</h2>

        <!-- Thêm mới sản phẩm -->
        <div class="mb-3">
            <a href="<?= P ?>/admin?AddProduct" class="btn btn-primary">Thêm Sản Phẩm Mới</a>
        </div>

        <!-- Bảng sản phẩm -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mẫu dữ liệu -->
                <tr>
                    <td>1</td>
                    <td>Sản phẩm A</td>
                    <td>500,000 VND</td>
                    <td>10</td>
                    <td><img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/AKM6017-NAU%20SKM7003-NAV%20QKM7007-NAU%20(5).jpg"
                            alt="Sản phẩm A" width="50" height="50"></td>
                    <td>
                        <a href="<?= P ?>/adminEditProduct" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sản phẩm A</td>
                    <td>500,000 VND</td>
                    <td>10</td>
                    <td><img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/AKM6017-NAU%20SKM7003-NAV%20QKM7007-NAU%20(5).jpg"
                            alt="Sản phẩm A" width="50" height="50"></td>
                    <td>
                        <a href="<?= P ?>/adminEditProduct" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sản phẩm A</td>
                    <td>500,000 VND</td>
                    <td>10</td>
                    <td><img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/AKM6017-NAU%20SKM7003-NAV%20QKM7007-NAU%20(5).jpg"
                            alt="Sản phẩm A" width="50" height="50"></td>
                    <td>
                        <a href="<?= P ?>/adminEditProduct" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sản phẩm A</td>
                    <td>500,000 VND</td>
                    <td>10</td>
                    <td><img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/AKM6017-NAU%20SKM7003-NAV%20QKM7007-NAU%20(5).jpg"
                            alt="Sản phẩm A" width="50" height="50"></td>
                    <td>
                        <a href="<?= P ?>/adminEditProduct" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sản phẩm A</td>
                    <td>500,000 VND</td>
                    <td>10</td>
                    <td><img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/AKM6017-NAU%20SKM7003-NAV%20QKM7007-NAU%20(5).jpg"
                            alt="Sản phẩm A" width="50" height="50"></td>
                    <td>
                        <a href="<?= P ?>/adminEditProduct" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sản phẩm A</td>
                    <td>500,000 VND</td>
                    <td>10</td>
                    <td><img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/AKM6017-NAU%20SKM7003-NAV%20QKM7007-NAU%20(5).jpg"
                            alt="Sản phẩm A" width="50" height="50"></td>
                    <td>
                        <a href="<?= P ?>/adminEditProduct" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>


                <!-- Thêm nhiều hàng dữ liệu sản phẩm tại đây -->
            </tbody>
        </table>
    </div>


</main><!-- End #main -->