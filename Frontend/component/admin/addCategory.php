<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm Mới Danh Mục</h2>

        <!-- Form thêm danh mục -->
        <div class="form-container">
            <form action="<?= P ?>/admin?themCategory" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="categoryName">Tên Danh Mục</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        placeholder="Nhập tên danh mục" required>
                </div>
                <div class="form-group mb-4">
                    <label for="categoryName">Pass</label>
                    <input type="text" class="form-control" id="categoryName" name="past"
                        placeholder="Nhập mô tả danh mục" required>
                </div>
                <div class="form-group mb-4">
                    <label for="categoryDescription"></label>
                    <input type="file" class="form-control" id="categoryName" name="image"
                    placeholder="Nhập tên danh mục" required>


                </div>

                <!-- Nút hành động -->
                <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                <a href="danh-sach-danh-muc.php" class="btn btn-secondary">Quay Lại</a>
            </form>
        </div>
    </div>

</main><!-- End #main -->