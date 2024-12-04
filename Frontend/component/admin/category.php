<style>
    #viewcap2 {
        display: none;
    }
</style>
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
                    <th>Chi Tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($category as $cap1): ?>
                    <tr class="parent-category" data-category-id="<?= $cap1['categoryId'] ?>">
                        <td><?= $cap1['categoryId'] ?></td>
                        <td><?= $cap1['name'] ?></td>
                        <td><?= $cap1['past'] ?></td>
                        <td>
                            <?php if (!empty($cap1['image'])): ?>
                                <img src="<?= $cap1['image'] ?>" alt="Hình ảnh" style="width: 50px; height: 50px;">
                            <?php endif; ?>
                        </td>
                        <td class="action-buttons">
                            <a href="<?= P ?>/admin?EditCategory=<?= $cap1['categoryId'] ?>"
                                class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                            <a href="<?= P ?>/admin?deleteCategory=<?= $cap1['categoryId'] ?>"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </a>
                        </td>
                        <td>
                            <?php if (!empty(array_filter($child, fn($cap2) => $cap2['categoryId'] == $cap1['categoryId']))): ?>
                                <button class="btn btn-info btn-sm toggle-details-btn">Chi Tiết</button>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <!-- Danh sách cấp 2 sẽ được ẩn và hiển thị khi nhấn vào nút Chi Tiết -->
                    <tr class="child-category" id="child-category-<?= $cap1['categoryId'] ?>" style="display: none;">
                        <td colspan="6">
                            <table class="table table-bordered table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Danh Mục Cấp 2</th>
                                        <th>Đường dẫn</th>
                                        <th>Hành Động</th>
                                        <th><a name="" id="" class="btn btn-primary" href="<?= P ?>/admin?addchild=<?= $cap1['categoryId'] ?>" role="button">Thêm</a>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($child as $cap2): ?>
                                        <?php if ($cap1['categoryId'] == $cap2['categoryId']): ?>
                                            <tr class="table-secondary">
                                                <td><?= $cap2['childId'] ?></td>
                                                <td><?= $cap2['name'] ?></td>
                                                <td><?= $cap2['past'] ?></td>
                                                <td>
                                                    <a href="<?= P ?>/admin?editChildCategory=<?= $cap2['childId'] ?>"
                                                        class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                                                    <a href="<?= P ?>/admin?deleteChildCategory=<?= $cap2['childId'] ?>"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if (!empty(array_filter($common, fn($cap3) => $cap3['childId'] == $cap2['childId']))): ?>
                                                        <button class="btn btn-info btn-sm toggle-child-details-btn">Chi Tiết</button>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                            <!-- Danh sách cấp 3 sẽ được ẩn và hiển thị khi nhấn vào nút Chi Tiết của cấp 2 -->
                                            <tr class="common-category" id="common-category-<?= $cap2['childId'] ?>" style="display: none;">
                                                <td colspan="5">
                                                    <table class="table table-bordered table-sm">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Tên Danh Mục Cấp 3</th>
                                                                <th>Đường dẫn</th>
                                                                <th>Hành Động</th>
                                                                <th><a name="" id="" class="btn btn-primary" href="<?= P ?>/admin?addCommont=<?= $cap2['childId'] ?>" role="button">Thêm</a>
                                                                    </a>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($common as $cap3): ?>
                                                                <?php if ($cap2['childId'] == $cap3['childId']): ?>
                                                                    <tr class="table-light">
                                                                        <td><?= $cap3['commonId'] ?></td>
                                                                        <td><?= $cap3['name'] ?></td>
                                                                        <td><?= $cap3['past'] ?></td>
                                                                        <td>
                                                                            <a href="<?= P ?>/admin?editCommoncategorys=<?= $cap3['commonId'] ?>"
                                                                                class="btn btn-primary btn-sm">Chỉnh Sửa</a>
                                                                            <a href="<?= P ?>/admin?deleteCommontCategory=<?= $cap3['commonId'] ?>"
                                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                                                                <button class="btn btn-danger btn-sm">Xóa</button>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script>
    // Xử lý sự kiện "Chi Tiết" cho cấp 1
    document.querySelectorAll('.toggle-details-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var categoryRow = button.closest('tr.parent-category');
            var categoryId = categoryRow.getAttribute('data-category-id');
            var childCategoryRow = document.getElementById('child-category-' + categoryId);

            if (childCategoryRow.style.display === 'none' || childCategoryRow.style.display === '') {
                childCategoryRow.style.display = 'table-row';
                button.textContent = 'Ẩn Chi Tiết';

            } else {
                childCategoryRow.style.display = 'none';
                button.textContent = 'Chi Tiết';

            }
        });
    });

    // Xử lý sự kiện "Chi Tiết" cho cấp 2
    document.querySelectorAll('.toggle-child-details-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var childCategoryItem = button.closest('tr');
            var commonCategoryRow = childCategoryItem.nextElementSibling;

            if (commonCategoryRow.style.display === 'none' || commonCategoryRow.style.display === '') {
                commonCategoryRow.style.display = 'table-row';
                button.textContent = 'Ẩn Chi Tiết';
            } else {
                commonCategoryRow.style.display = 'none';
                button.textContent = 'Chi Tiết';
            }
        });
    });


    // Xử lý nút "Hủy" để ẩn lại hàng nhập liệu
    document.querySelector('.btn-cancel-add').addEventListener('click', function() {
        const paths = document.querySelector('.paths').value = ''
        const names = document.querySelector('.names').value = ''
        alert('huye')

    });
</script>