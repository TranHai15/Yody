<body>

    <?php require_once(HF . "header.php") ?>
    <?= getsession('chaggePassword') ?? "" ?>
    <div class="baoboc">
        <div class="content">
            <p class="text-align-center">Chào mừng bạn đến với Yody</p>
            <h1 class="text-align-center"><span>Đặt lại mật khẩu</span></h1>
            <form action="<?= P ?>/auth?action=reset_password" method="POST" onsubmit="return validatePassword()"
                class="form__login">
                <div class="input-container">
                    <div class="form">
                        <input type="password" name="password" id="password" class="form_input" autocomplete="off"
                            placeholder=" " onfocus="clearError('password')" onblur="validateInput('password')">
                        <label for="password" class="form_label">Mật khẩu mới</label>
                        <div class="error__con" id="error__password"></div>
                    </div>
                </div>

                <div class="input-container">
                    <div class="form">
                        <input type="password" name="confirm_password" id="confirm_password" class="form_input"
                            autocomplete="off" placeholder=" " onfocus="clearError('confirm_password')"
                            onblur="validateInput('confirm_password')">
                        <label for="confirm_password" class="form_label">Nhập lại mật khẩu</label>
                        <div class="error__con" id="error__confirm_password"></div>
                    </div>
                </div>

                <button class="btn__summit" type="submit">Đặt lại mật khẩu</button>
            </form>
            <a style="margin-top: 20px; display: block;" href="<?= P ?>/auth?action=login">
                <button class="btn__summit">Đăng nhập</button>
            </a>
        </div>
    </div>
    <?php require_once(HF . "footer.php") ?>
    <script>
        function clearError(id) {
            document.getElementById("error__" + id).innerText = "";
        }

        function validateInput(id) {
            const input = document.getElementById(id);
            const errorContainer = document.getElementById("error__" + id);

            if (input.value.trim() === "") {
                errorContainer.innerText = id === "password" ? "Vui lòng nhập mật khẩu mới." :
                    "Vui lòng nhập lại mật khẩu.";
                return false;
            }
            return true;
        }

        function validatePassword() {
            const password = document.getElementById("password").value.trim();
            const confirmPassword = document.getElementById("confirm_password").value.trim();

            let isValid = true;

            if (!validateInput("password")) {
                isValid = false;
            }

            if (!validateInput("confirm_password")) {
                isValid = false;
            }

            if (password !== confirmPassword) {
                document.getElementById("error__confirm_password").innerText = "Mật khẩu không khớp.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>