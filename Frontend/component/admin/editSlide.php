<main id="main" class="main">


    <!-- Tiêu đề -->
    <div class="container my-5">
        <h2 class="text-center"> Thay Đổi Slide</h2>
    </div>

    <form action="<?= P ?>/admin?UpdateSlide" method="POST" enctype="multipart/form-data">



        <div class="mb-3">
            <label for="url" class="form-label">Image</label>
            <input type="file" class="form-control" id="url" name="url">
            <hr>
            <img src="<?= $getOne['url'] ?>" width="100%" height="50%" alt="">
            <hr>
            <input type="hidden" name="url" value="<?= $getOne['url'] ?>" id="">
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" value="<?= $getOne['title'] ?>" class="form-control" id="title" name="title">

        </div>
        <div class="mb-3">
            <label for="past" class="form-label">Past</label>
            <input type="text" value="<?= $getOne['past'] ?>" class="form-control" id="past" name="past">
        </div>
        <div>
            <input type="hidden" name="sildeId" value="<?= $getOne['sildeId'] ?>" id="sildeId">
        </div>

        <a href="<?= P ?>/admin?Slides" class="btn btn-info">Quay lại</a>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</main>