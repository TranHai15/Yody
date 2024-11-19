<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh Sách Danh Mục Sản Phẩm</h2>

        <!-- Nút thêm danh mục mới -->
        <div class="text-right mb-3">
            <a href="<?= P ?>/admin?AddCategory" class="btn btn-success">Thêm Danh Mục Mới</a>
        </div>

        <!-- Bảng danh sách danh mục cấp 1 -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Đường dẫn</th>
                    <th>Hình ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($category as $cap1): ?>
                    <tr>
                        <td><?= $cap1['categoryId'] ?></td>
                        <td><?= $cap1['name'] ?></td>
                        <td><?= $cap1['past'] ?></td>
                        <td><img src="<?= $cap1['image'] ?>" alt="Hình ảnh" style="width: 50px; height: 50px;"></td>
                        <td class="action-buttons">
                            <a href="<?= P ?>/admin?EditCategory=<?= $cap1['categoryId'] ?>" class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                            <a href="<?= P ?>/admin?deleteCategory=<?= $cap1['categoryId'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </a>

                        </td>
                    </tr>

                    <!-- Danh sách cấp 2 -->
                    <?php foreach ($child as $cap2): ?>
                        <?php if ($cap1['categoryId'] == $cap2['categoryId']): ?>
                            <tr class="table-secondary">
                                <td>&nbsp;&nbsp;— <?= $cap2['childId'] ?></td>
                                <td>&nbsp;&nbsp;— <?= $cap2['name'] ?></td>
                                <td><?= $cap2['past'] ?></td>
                                <td></td>
                                <td class="action-buttons">
                                    <a href="#" class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                                    <a href="<?= P ?>/admin?deleteChildCategory=<?= $cap2['childId'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </a>

                                </td>
                            </tr>

                            <!-- Danh sách cấp 3 -->
                            <?php foreach ($common as $cap3): ?>
                                <?php if ($cap2['childId'] == $cap3['childId']): ?>
                                    <tr class="table-light">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;— <?= $cap3['commonId'] ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;— <?= $cap3['name'] ?></td>
                                        <td><?= $cap3['past'] ?></td>
                                        <td></td>
                                        <td class="action-buttons">
                                            <a href="#" class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                                            <a href="<?= P ?>/admin?deleteCommontCategory=<?= $cap3['commonId'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                                <button class="btn btn-danger btn-sm">Xóa</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>