<main id="main" class="main">
    <div class="container mt-5">

        <h2 class="text-center mb-4">Danh Sách Slide</h2>
        <div class="text-right mb-3">
            <a href="<?= P ?>/admin?AddSlide" class="btn btn-success">Thêm Slide </a>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>IMG</th>
                    <th>Title</th>
                    <th>Past</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mẫu danh mục -->
                <?php foreach ($slide as $sl) : ?>
                    <tr>
                        <td><?= $sl['sildeId'] ?></td>
                        <td><img src="<?= $sl['url'] ?>" alt="" width="50%"></td>
                        <td><?= $sl['title'] ?></td>
                        <td><?= $sl['past'] ?></td>
                        <td class="action-buttons">
                            <a class="btn btn-primary btn-sm" href="<?= P ?>/admin?EditSlide=<?= $sl['sildeId'] ?>">Chỉnh Sửa</a>
                            <a class="btn btn-danger btn-sm" href="<?= P ?>/admin?DeleteSlide=<?= $sl['sildeId'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa không?')">Xoa</a>

                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</main>