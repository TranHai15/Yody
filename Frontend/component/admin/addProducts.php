<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="mb-4">Thêm Sản Phẩm Mới</h2>
        <form>
            <div class="mb-3">
                <label for="productName" class="form-label">Tên Sản Phẩm</label>
                <input type="text" class="form-control" id="productName" placeholder="Nhập tên sản phẩm" required>
            </div>

            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô Tả Sản Phẩm</label>
                <textarea class="form-control" id="productDescription" rows="4"
                    placeholder="Nhập mô tả sản phẩm"></textarea>
            </div>

            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá Sản Phẩm</label>
                <input type="number" class="form-control" id="productPrice" placeholder="Nhập giá sản phẩm" required>
            </div>

            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh Mục Sản Phẩm</label>
                <select class="form-select" id="productCategory" required>
                    <option selected>Chọn danh mục</option>
                    <option value="1">Điện Thoại</option>
                    <option value="2">Máy Tính</option>
                    <option value="3">Phụ Kiện</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="productImage" class="form-label">Hình Ảnh Sản Phẩm</label>
                <input class="form-control" type="file" id="productImage" required>
            </div>

            <div class="mb-3">
                <label for="productStock" class="form-label">Số Lượng Tồn Kho</label>
                <input type="number" class="form-control" id="productStock" placeholder="Nhập số lượng tồn kho"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </form>
    </div>


</main><!-- End #main -->