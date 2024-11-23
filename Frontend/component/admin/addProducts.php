<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="mb-4">Thêm Sản Phẩm Mới</h2>
        <form method="post" action="<?= P ?>/admin?themproduct">
            <div class="mb-3">
                <label for="productName" class="form-label">Tên Sản Phẩm</label>
                <input type="text" name="name" class="form-control" id="productName" placeholder="Nhập tên sản phẩm"
                    required>
            </div>

            <div class="mb-3">
                <label for="productDescription" class="form-label">Mã Sản Phẩm</label>
                <input class="form-control" name="productCode" id="productDescription" rows="4"
                    placeholder="Nhập mã sản phẩm"></input>
            </div>



            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh Mục Cha Sản Phẩm</label>
                <select class="form-select" name="categoryId" id="productCategory" required>
                    <?php foreach ($category as $cap1):  ?>
                    <option value="<?= $cap1['categoryId'] ?>"><?= $cap1['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh Mục Con Sản Phẩm</label>
                <select class="form-select" name="childId" id="productCategory" required>
                    <?php foreach ($child as $cap2):  ?>
                    <option value="<?= $cap2['childId'] ?>"><?= $cap2['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </form>
    </div>


</main><!-- End #main -->