<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center">Edit Danh mục</h2>
    </div>
    <form action="<?= P ?>/admin?UpdateCategory" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $getOne['name'] ?>">
            <span class="error-message text-danger"
                id="nameError"><?= getsession('errorNameCategory') ?? "" ?></span>

        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Pass</label>
            <input type="text" class="form-control" id="name" name="past" value="<?= $getOne['past'] ?>">
            <span class="error-message text-danger"
                id="nameError"><?= getsession('errorPastCategory') ?? "" ?></span>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Images</label>
            <img src="<?= $getOne['image'] ?>" alt="" width="200px" height="200px">
            <input type="hidden" class="form-control" id="name" name="image" value="<?= $getOne['image'] ?>">
            <input type="file" name="image">
            <p class="text-danger"></p>

        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" id="categoryId" name="categoryId" value="<?= $getOne['categoryId'] ?>"
                readonly>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</main>