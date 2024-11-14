<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Sửa Sản Phẩm</h2>

        <!-- Form sửa sản phẩm -->
        <div class="form-container">
            <form action="your_update_action_url_here" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Tên Sản Phẩm</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                        value="Tên sản phẩm hiện tại" required>
                </div>

                <div class="form-group">
                    <label for="productDescription">Mô Tả</label>
                    <textarea class="form-control" id="productDescription" name="productDescription" rows="4"
                        required>Mô tả hiện tại của sản phẩm</textarea>
                </div>

                <div class="form-group">
                    <label for="productPrice">Giá</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" value="500000"
                        required>
                </div>

                <div class="form-group">
                    <label for="productCategory">Danh Mục</label>
                    <select class="form-control" id="productCategory" name="productCategory" required>
                        <option value="1">Điện Thoại</option>
                        <option value="2" selected>Máy Tính Bảng</option>
                        <option value="3">Phụ Kiện</option>
                        <!-- Thêm các danh mục khác -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="productImage">Hình Ảnh</label>
                    <input type="file" class="form-control-file" id="productImage" name="productImage">
                    <small class="form-text text-muted">Hình ảnh hiện tại:</small>
                    <img src="https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nu-TSN7301-DEN%20(10).JPG"
                        alt="Hình ảnh sản phẩm" style="width: 150px; height: auto; margin-top: 10px;">
                </div>

                <!-- Nút hành động -->
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                <a href="danh-sach-san-pham.php" class="btn btn-secondary">Quay Lại</a>
            </form>
        </div>
    </div>

</main><!-- End #main -->