<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center">Thêm Tài khoản Mới</h2>
    </div>

    <form action="<?= P ?>/admin?themAccount" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?= getsession('name__addUser') ?? ""  ?>">
            <p class="text-danger"><?= getsession('addUserName') ?></p>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="<?= getsession('email__addUser') ?? ""  ?>">
            <p class="text-danger">
                <?= getsession('errorEmailAddUser') ?? "" ?>
            </p>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <p class="text-danger"><?= getsession('addUserPassword') ?></p>

        </div>

        <div class="mb-3">
            <label for="avata" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="avata" name="avata">
            <input type="hidden" class="form-control" id="avata" name="avata"
                value="https://i.pinimg.com/736x/e6/bc/04/e6bc0435c6f92265c1de8697b17a521f.jpg">
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Active</label>
            <select class="form-control" id="active" name="active">
                <option value="1">Active</option>
                <option value="0">No Active</option>
            </select>
        </div>

        <div class="mb-3">
            <input type="hidden" class="form-control" id="role" name="role" value="0">
        </div>

        <div class="mb-3">
            <input type="hidden" class="form-control" id="createAt" name="createAt">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        const nameInput = document.getElementById("name");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");

        form.addEventListener("submit", function(event) {
            let isValid = true;

            // Xóa thông báo lỗi cũ
            document.querySelectorAll(".text-danger").forEach((p) => (p.textContent = ""));

            // Kiểm tra tên
            if (nameInput.value.trim() === "") {
                const error = nameInput.nextElementSibling;
                error.textContent = "Tên không được để trống.";
                isValid = false;
            }

            // Kiểm tra email
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (emailInput.value.trim() === "") {
                const error = emailInput.nextElementSibling;
                error.textContent = "Email không được để trống.";
                isValid = false;
            } else if (!emailPattern.test(emailInput.value.trim())) {
                const error = emailInput.nextElementSibling;
                error.textContent = "Email không đúng định dạng.";
                isValid = false;
            }

            // Kiểm tra mật khẩu
            if (passwordInput.value.trim() === "") {
                const error = passwordInput.nextElementSibling;
                error.textContent = "Mật khẩu không được để trống.";
                isValid = false;
            } else if (passwordInput.value.length <= 6) {
                const error = passwordInput.nextElementSibling;
                error.textContent = "Mật khẩu phải lớn hơn 6 ký tự.";
                isValid = false;
            }

            // Ngăn gửi biểu mẫu nếu không hợp lệ
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>