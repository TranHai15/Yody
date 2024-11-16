<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center">Quản lý Tài khoản</h2>
        <p class="text-center text-muted">Danh sách các tài khoản hiện có trên hệ thống</p>
    </div>




    <!-- Bảng quản lý tài khoản -->
    <div class="container">
        <div class="text-right mb-3">
            <a href="<?= P ?>/admin?AddAccount" class="btn btn-success">Thêm Người dùng Mới</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-blue">
                    <tr>
                        <th>STT</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Avata</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tài khoản 1 -->
                    <?php foreach ($dataAllUser as $user):  ?>
                        <tr>
                            <td><?= $user['userId'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['password'] ?></td>
                            <td><img loading="lazy" src="<?= $user['avata'] ?>" alt=""
                                    class=" rounded-circle img-thumbnail avatar-img"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                            </td>
                            <td><?= $user['role'] === 0 ? "Thành Viên" : "Quản Tri Viên"  ?></td>
                            <td>
                                <a href="<?= P ?>/admin?EditAccount=<?= $user['userId'] ?>"><button
                                        class="btn btn-warning btn-sm">Sửa</button></a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')"
                                    href="<?= P ?>/admin?DeleteAccount=<?= $user['userId'] ?>">
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </a>


                            </td>
                        </tr>
                    <?php endforeach   ?>

                </tbody>
            </table>
        </div>
    </div>


</main><!-- End #main -->