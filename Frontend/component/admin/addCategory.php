<style>
    .error-message {
        font-size: 0.875em;
        margin-top: 5px;
        display: block;
    }
</style>

<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm Mới Danh Mục</h2>

        <!-- Form thêm danh mục -->
        <div class="form-container">
            <form action="<?= P ?>/admin?themCategory" id="addCategory" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="categoryName">Tên Danh Mục</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        placeholder="Nhập tên danh mục">
                    <span class="error-message text-danger"
                        id="nameError"><?= getsession('errorNameCategory') ?? "" ?></span>
                </div>
                <div class="form-group mb-4">
                    <label for="categoryPass">Pass</label>
                    <input type="text" class="form-control" id="categoryPass" name="past"
                        placeholder="Nhập mô tả danh mục">
                    <span class="error-message text-danger"
                        id="passError"><?= getsession('errorPassCategory') ?? "" ?></span>
                </div>
                <div class="form-group mb-4">
                    <label for="categoryImage">Ảnh (không bắt buộc)</label>
                    <input type="file" class="form-control" id="categoryImage" name="image">
                </div>

                <!-- Nút hành động -->
                <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                <a href="<?= P ?>/admin?Category" class="btn btn-secondary">Quay Lại</a>
            </form>
        </div>
    </div>
</main><!-- End #main -->


<script>
    document.querySelector('#addCategory').addEventListener('submit', (e) => {
        e.preventDefault();

        // Lấy giá trị các trường
        const name = document.querySelector('#categoryName').value.trim();
        const past = document.querySelector('#categoryPass').value.trim();

        // Lấy phần tử để hiển thị lỗi
        const nameError = document.querySelector('#nameError');
        const passError = document.querySelector('#passError');

        // Reset thông báo lỗi
        nameError.textContent = '';
        passError.textContent = '';

        // Cờ kiểm tra tính hợp lệ
        let isValid = true;

        // Kiểm tra Tên Danh Mục
        if (!name) {
            nameError.textContent = "Tên danh mục không được để trống.";
            isValid = false;
        }

        // Kiểm tra Pass
        if (!past) {
            passError.textContent = "Pass không được để trống.";
            isValid = false;
        }

        // Nếu không có lỗi, gửi form
        if (isValid) {
            e.target.submit();
        }
    });
</script>