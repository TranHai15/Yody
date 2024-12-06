<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Quản Lý Bình Luận</h2>
        <?php showNotification('messageDeleteComment') ?>

        <!-- Bảng bình luận -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Người Bình Luận</th>
                    <th>Nội Dung</th>
                    <th>Sản Phẩm</th>
                    <th>Ngày Bình Luận</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mẫu bình luận -->
                <?php foreach ($dataAllComment as $comment) : ?>
                    <tr>
                        <td><?= $comment['commentId'] ?></td>
                        <td><?= $comment['userId'] ?></td>
                        <td> <?= $comment['content'] ?> </td>
                        <td> <?= $comment['productId'] ?></td>
                        <td> <?= $comment['createAt'] ?> </td>

                        <td>
                            <span class="<?= $comment['status'] > 0 ? "text-success" : " text-warning " ?>">
                                <?= $comment['status'] > 0 ? "Đã Duyệt" : " Chưa duyệt " ?>
                            </span>
                        </td>
                        <td class="action-buttons">

                            <?php if ($comment['status'] == 0): ?>
                                <a href="<?= P ?>/admin?DuyetComment=<?= $comment['commentId'] ?>">
                                    <button class="btn btn-success btn-sm">Duyệt</button>
                                </a>
                            <?php endif  ?>
                            <a onclick="return confirm('Bạn muốn xóa này không')"
                                href="<?= P ?>/admin?DeleteComment=<?= $comment['commentId'] ?>">
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach  ?>

            </tbody>
        </table>
    </div>

</main><!-- End #main -->