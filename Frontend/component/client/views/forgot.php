<body>
    <?php showNotification('acount')  ?>
    <?php require_once(HF . "header.php") ?>
    <div class="baoboc">

        <?php if (getsession('hienthi') > 5):  ?>
            <div class="content">
                <p class="text-align-center">Chào mừng bạn đến với Yody</p>
                <p class="text-align-center" style="color: green;"> <?= getsession("chaggePassword") ?? "" ?></p>
                <h1 class="text-align-center"><span>Quển mật khẩu</span></h1>
                <form action="<?= P ?>/auth?action=change" method="POST" onsubmit="return validate__login()"
                    class="form__login">
                    <div class="input-container">
                        <input type="hidden" name="userId" id="userid" value="<?= $idUser ?? $_SESSION['forgotuserId'] ?>">
                        <div class="form">
                            <input type="text" name="CODE" id="text" class="form_input" autocomplete="off" placeholder=" ">
                            <label for="email" class="form_label">MÃ Code</label>
                            <div class="error__con" id="error__email"><?= getsession('change') ?? "" ?></div>
                        </div>
                    </div>

                    <button class="btn__summit" type="submit">Gửi</button>

                </form>
            </div>
        <?php else: ?>
            <div class="content">
                <p class="text-align-center">Chào mừng bạn đến với Yody</p>
                <h1 class="text-align-center"><span>Quển mật khẩu</span></h1>
                <form action="<?= P ?>/auth?action=forgot" method="POST" onsubmit="return validate__login()"
                    class="form__login">
                    <div class="input-container">
                        <div class="form">
                            <input type="text" name="email" id="email" class="form_input" autocomplete="off" placeholder=" "
                                onchange="validateInput('email')" onfocus="clearError('email')"
                                onblur="validateInput('email')" value="<?= getsession('login__email') ?? ""  ?>">
                            <label for="email" class="form_label">Email</label>
                            <div class="error__con" id="error__email"><?= getsession("forgot") ?? "" ?></div>
                        </div>
                    </div>

                    <button class="btn__summit" type="submit">Gửi</button>

                </form>
                <a style="margin-top: 20px; display: block;" href="<?= P ?>/auth?action=login"><button
                        class="btn__summit">Đăng
                        nhập</button></a>


            </div>
        <?php endif ?>
    </div>
    <?php require_once(HF . "footer.php") ?>
    <script src="Frontend/Js/form.js">

    </script>
</body>