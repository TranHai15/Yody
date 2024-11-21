<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="mb-4">Thêm Sản Phẩm Mới</h2>
        <form>
            <div class="mb-3">
                <label for="productName" class="form-label">Tên Sản Phẩm</label>
                <input type="text" class="form-control" id="productName" placeholder="Nhập tên sản phẩm" required>
            </div>

            <div class="mb-3">
                <label for="productDescription" class="form-label">Mã Sản Phẩm</label>
                <input class="form-control" id="productDescription" rows="4" placeholder="Nhập mã sản phẩm"></input>
            </div>



            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh Mục Cha Sản Phẩm</label>
                <select class="form-select" id="productCategory" required>
                    <option selected>Chọn danh mục</option>
                    <option value="1">Điện Thoại</option>
                    <option value="2">Máy Tính</option>
                    <option value="3">Phụ Kiện</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh Mục Con Sản Phẩm</label>
                <select class="form-select" id="productCategory" required>
                    <option selected>Chọn danh mục</option>
                    <option value="1">Điện Thoại</option>
                    <option value="2">Máy Tính</option>
                    <option value="3">Phụ Kiện</option>
                </select>
            </div>



            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </form>
    </div>


</main><!-- End #main -->