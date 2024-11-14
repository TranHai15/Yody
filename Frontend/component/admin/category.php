<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh Sách Danh Mục Sản Phẩm</h2>

        <!-- Nút thêm danh mục mới -->
        <div class="text-right mb-3">
            <a href="<?= P ?>/adminAddCategory" class="btn btn-success">Thêm Danh Mục Mới</a>
        </div>

        <!-- Bảng danh sách danh mục -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Mô Tả</th>
                    <th>Số Lượng Sản Phẩm</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mẫu danh mục -->
                <tr>
                    <td>1</td>
                    <td>Điện Thoại</td>
                    <td>Danh mục các sản phẩm điện thoại thông minh</td>
                    <td>120</td>
                    <td class="action-buttons">
                        <a href="" class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Máy Tính Bảng</td>
                    <td>Danh mục các sản phẩm máy tính bảng</td>
                    <td>75</td>
                    <td class="action-buttons">
                        <a href="" class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>
                <!-- Thêm nhiều danh mục tại đây -->
            </tbody>
        </table>
    </div>


</main><!-- End #main -->