<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm Mới Danh Mục</h2>

        <!-- Form thêm danh mục -->
        <div class="form-container">
            <form action="your_action_url_here" method="POST">
                <div class="form-group mb-4">
                    <label for="categoryName">Tên Danh Mục</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName"
                        placeholder="Nhập tên danh mục" required>
                </div>
                <div class="form-group mb-4">
                    <label for="categoryDescription">Mô Tả</label>
                    <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3"
                        placeholder="Nhập mô tả cho danh mục" required></textarea>
                </div>

                <!-- Nút hành động -->
                <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                <a href="danh-sach-danh-muc.php" class="btn btn-secondary">Quay Lại</a>
            </form>
        </div>
    </div>

</main><!-- End #main -->