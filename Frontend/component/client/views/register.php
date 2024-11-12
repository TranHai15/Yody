<body>
    <?php require_once(HF . "header.php") ?>
    <div class="baoboc">
        <div class="content">
            <p class="text-align-center">Chào mừng bạn đến với Yody</p>
            <h1 class="text-align-center"><span>ĐĂNG</span><span>KÍ</span></h1>
            <form action="?clt=user&active=dangki" method="post" onsubmit="return validate__register()"
                class="form__login">
                <div class="input-container">
                    <div class="form">
                        <input type="text" name="userName" id="userName" class="form_input" autocomplete="off"
                            placeholder=" " onchange="validateInput('userName')" onfocus="clearError('userName')"
                            onblur="validateInput('userName')">
                        <label for="userName" class="form_label">Name</label>
                        <div class="error__con" id="error__userName"></div>
                    </div>
                </div>
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
                <button class="btn__summit" type="submit">Đăng Kí</button>
            </form>


            <div class="layout ">
                <hr>
                <p>Hoặc đăng kí bằng</p>
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
                <h1>Bạn đã có tài khoản? <a href="<?= P ?>/auth/login">Đăng Nhập Ngay!</a></h1>
            </div>
        </div>
    </div>
    <?php require_once(HF . "footer.php") ?>
    <script src="Frontend/Js/form.js">

    </script>
</body>