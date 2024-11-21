<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh Sách Sản Phẩm</h2>

        <!-- Thêm mới sản phẩm -->
        <div class="mb-3">
            <a href="<?= P ?>/admin?AddProduct" class="btn btn-primary">Thêm Sản Phẩm Mới</a>
        </div>

        <!-- Bảng sản phẩm -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>MÃ sản phẩm</th>
                    <th>Ngày tạo</th>
                    <th>Category</th>
                    <th>Child Category</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mẫu dữ liệu -->
                <?php foreach ($dataAllProduct as $product):  ?>
                <tr>
                    <td><?= $product['productId'] ?></td>
                    <td> <?= $product['name'] ?> </td>
                    <td> <?= $product['productCode'] ?> </td>
                    <td> <?= $product['createAt'] ?> </td>
                    <?php foreach ($category as $cap1):  ?>
                    <?php if ($product['categoryId'] == $cap1['categoryId']): ?>
                    <td> <?= $cap1['name'] ?> </td>
                    <?php endif ?>
                    <?php endforeach ?>
                    <?php foreach ($child as $cap2):  ?>
                    <?php if ($product['childId'] == $cap2['childId']): ?>
                    <td> <?= $product['name'] ?> </td>
                    <?php endif ?>
                    <?php endforeach ?>
                    <td>
                        <!-- <a href="<?= P ?>/adminEditProduct" class="btn btn-warning btn-sm">Sửa</a> -->
                        <a onclick="return confirm('Ban co muon khong')"
                            href="<?= P ?>/admin?DeleteProduct=<?= $product['productId'] ?>"
                            class="btn btn-danger btn-sm">Xóa</a>
                        <a href="<?= P ?>/admin?ViewProduct=<?= $product['productId'] ?>"
                            class="btn btn-success btn-sm">Chi tiết</a>
                    </td>
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>


</main><!-- End #main -->