<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center">Edit Tài khoản</h2>
    </div>

    <form action="<?= P ?>/admin?UpdateUser" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="hidden" class="form-control" id="userId" name="userId" value="<?= $dataOneUser['userId'] ?>"
                readonly>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $dataOneUser['name'] ?>">
            <p class="text-danger"><?= getsession('editUserName') ?></p>

        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $dataOneUser['email'] ?>">
            <p class="text-danger"><?= getsession('editUserEmail') ?></p>

        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password"
                value="<?= $dataOneUser['password'] ?>">
            <p class="text-danger"><?= getsession('editUserPassword') ?></p>

        </div>

        <div class="mb-3">
            <label for="avata" class="form-label">Avatar</label>
            <img class="rounded-circle img-thumbnail avatar-img" style="width: 40px; height: 40px; object-fit: cover;"
                src="<?= $dataOneUser['avata'] ?>" alt="">
            <br>
            <input type="file" class="form-control" id="avata" name="avata">
            <input type="hidden" class="form-control" id="avata-hidden" name="avata"
                value="<?= $dataOneUser['avata'] ?>">
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Active</label>
            <select class="form-control" id="active" name="active">
                <option value="1" <?= ($dataOneUser['active'] == 1) ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?= ($dataOneUser['active'] == 0) ? 'selected' : ''; ?>>No Active</option>
            </select>
        </div>

        <div class="mb-3">
            <input type="hidden" class="form-control" id="role" name="role" value="<?= $dataOneUser['role'] ?>">
        </div>

        <div class="mb-3">
            <input type="hidden" class="form-control" id="createAt" name="createAt"
                value="<?= $dataOneUser['createAt'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</main>