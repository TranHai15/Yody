<body>
    <?php require_once(HF . "header.php") ?>
    <div class="baoboc">
        <div class="content">
            <p class="text-align-center">Chào mừng bạn đến với Yody</p>
            <h1 class="text-align-center"><span>ĐĂNG</span><span>NHẬP</span></h1>
            <form action="<?= P ?>/auth?dangnhap" method="POST" onsubmit="return validate__login()" class="form__login">
                <div class="input-container">
                    <div class="form">
                        <input type="text" name="email" id="email" class="form_input" autocomplete="off" placeholder=" "
                            onchange="validateInput('email')" onfocus="clearError('email')"
                            onblur="validateInput('email')">
                        <label for="email" class="form_label">Email</label>
                        <div class="error__con" id="error__email"></div>
                    </div>
                </div>
                <div class="input-container">
                    <div class="form">
                        <input type="password" name="password" id="password" class="form_input" autocomplete="off"
                            placeholder=" " onchange="validateInput('password')" onfocus="clearError('password')"
                            onblur="validateInput('password')">
                        <label for="password" class="form_label">Password</label>
                        <div class="error__con" id="error__password"></div>
                    </div>
                </div>
                <button class="btn__summit" type="submit">Đăng Nhập</button>
            </form>
            <div class="layout ">
                <hr>
                <p>Hoặc đăng nhập bằng</p>
                <hr>
            </div>
            <div class="face__gg">
                <div class="google">
                    <img src="https://bizweb.dktcdn.net/100/438/408/themes/949050/assets/ic_btn_google.svg?1714530454667"
                        alt="Google">
                </div>
                <div class="face">
                    <img src="https://bizweb.dktcdn.net/100/438/408/themes/949050/assets/ic_btn_facebook.svg?1714530454667"
                        alt="Facebook">
                </div>
            </div>
            <div class="location">
                <h1>Bạn chưa có tài khoản? <a href="<?= P ?>/auth?register">Đăng Ký Ngay!</a></h1>
            </div>
        </div>
    </div>
    <?php require_once(HF . "footer.php") ?>
    <script src="Frontend/Js/form.js">

    </script>
</body>