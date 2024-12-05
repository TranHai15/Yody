<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Quản Lý Phản Hồi</h2>

        <!-- Bảng bình luận -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Người Bình Luận</th>
                    <th>Nội Dung</th>
                    <th>Sản Phẩm</th>
                    <th>Đánh Giá</th>
                    <th>Ảnh</th>
                    <th>Ngày Bình Luận</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mẫu bình luận -->
                <?php foreach ($kq as $ph) : ?>
                    <tr>
                        <td><?= $ph['reviewsId'] ?></td>
                        <td> <?= $ph['nameUser'] ?> </td>
                        <td> <?= $ph['reviewText'] ?> </td>
                        <td><?= $ph['nameProduct'] ?></td>
                        <td> <?= $ph['rating'] ?><strong style="margin: 0 3px;">/5</strong></td>
                        <td> <img style="width: 100px; height: 50px; object-fit: contain; " src="<?= $ph['image'] ?>"
                                alt=""> </td>
                        <td> <?= $ph['createAt'] ?> </td>
                        <td class="action-buttons">
                            <a onclick="return confirm('Bạn muốn xóa này không')"
                                href="<?= P ?>/admin?Deletefeedback=<?= $ph['reviewsId'] ?>">
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach  ?>

            </tbody>
        </table>
    </div>

</main><!-- End #main -->