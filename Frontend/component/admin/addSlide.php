<main id="main" class="main">
    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center"> Thêm Slide</h2>
    </div>

    <form action="<?= P ?>/admin?themSlide" method="POST" enctype="multipart/form-data">



        <div class="mb-3">
            <label for="url" class="form-label">Image</label>
            <input type="file" class="form-control" id="url" name="url">

        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" value="<?= $data['title'] ?? '' ?>" name="title">
            <span style="color: red;"><?= $error['title'] ?? "" ?></span>
        </div>
        <div class="mb-3">
            <label for="past" class="form-label">Past</label>
            <input type="text" class="form-control" value="<?= $data['past'] ?? '' ?>" id="past" name="past">
            <span style="color: red;"><?= $error['past']  ?? "" ?></span>
        </div>

        <a href="<?= P ?>/admin?Slides" class="btn btn-info">Quay lại</a>
        <button type="submit" class="btn btn-primary">Add Slide</button>
    </form>
</main>