<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center">Edit Danh mục cấp 2</h2>
    </div>
    <form action="<?= P ?>/admin?updateChildCategory" method="POST" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $getOne['name'] ?>">
            <p class="text-danger"></p>

        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Pass</label>
            <input type="text" class="form-control" id="name" name="past" value="<?= $getOne['past'] ?>">
            <p class="text-danger"></p>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" id="childId" name="childId" value="<?= $getOne['childId'] ?>"
                readonly>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</main>