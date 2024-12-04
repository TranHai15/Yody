<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center">Thêm Danh mục cấp 2</h2>
    </div>
    <form action="<?= P ?>/admin?addChilds" method="POST" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
            <p class="text-danger"></p>

        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Pass</label>
            <input type="text" class="form-control" id="name" name="past">
            <p class="text-danger"></p>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" id="categoryId" name="categoryId" value="<?= $id?>"
                readonly>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</main>

