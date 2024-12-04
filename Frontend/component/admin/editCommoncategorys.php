<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center">Edit Danh mục cấp 3</h2>
    </div>
    <form action="<?= P ?>/admin?updateCommontCategory" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $getOne['name'] ?>">
            <p class="text-danger"></p>

        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Pass</label>
            <input type="text" class="form-control" id="past" name="past" value="<?= $getOne['past'] ?>">
            <p class="text-danger"></p>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" id="childId" name="commonId" value="<?= $getOne['commonId'] ?>"
                readonly>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</main>