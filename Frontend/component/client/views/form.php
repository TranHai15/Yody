<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/home.css">
    <link rel="stylesheet" href="Frontend/Css/form.css">
    <title>Đánh giá sản phẩm</title>
</head>

<body>
    <?php 
        $userId = $_GET['idUser'] ?? ''; 
        $productId = $_GET['idProduct'] ?? ''; 
    ?>
    <section class="review-section grid wide">
        <h2 class="review-title">Đánh giá sản phẩm</h2>
        <div class="review-form-container">
            <form id="reviewForm" class="review-form" action="<?= P ?>/formProductView" method="post" enctype="multipart/form-data">
                <!-- Input hidden cho userId và productId -->
                <input type="hidden" name="userId" value="<?= htmlspecialchars($userId) ?>">
                <input type="hidden" name="productId" value="<?= htmlspecialchars($productId) ?>">
                
                <!-- Nhập đánh giá (rating) -->
                <div class="review-form-group">
                    <label for="reviewRating" class="review-label">Đánh giá:</label>
                    <div id="reviewRating" class="review-rating">
                        <span class="star" data-value="1">&#9734;</span>
                        <span class="star" data-value="2">&#9734;</span>
                        <span class="star" data-value="3">&#9734;</span>
                        <span class="star" data-value="4">&#9734;</span>
                        <span class="star" data-value="5">&#9734;</span>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="">
                </div>

                <!-- Nhập nội dung đánh giá -->
                <div class="review-form-group">
                    <label for="reviewComment" class="review-label">Nhận xét:</label>
                    <textarea name="content" id="reviewComment" class="review-textarea" placeholder="Viết nhận xét của bạn..."></textarea>
                </div>

                <!-- Upload ảnh -->
                <div class="review-form-group">
                    <label for="reviewImage" class="review-label">Chọn ảnh:</label>
                    <input type="file" id="reviewImage" name="image" class="review-input" accept="image/*">
                    <div id="imagePreview" class="image-preview"></div>
                </div>

                <button type="submit" class="review-submit-btn">Gửi đánh giá</button>
            </form>
            <div id="reviewMessage" class="review-message"></div>
        </div>
    </section>

</body>

<script>
    let selectedRating = 0;

    // Xử lý click vào các sao
    document.querySelectorAll('.review-rating .star').forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.getAttribute('data-value'));
            document.querySelectorAll('.review-rating .star').forEach(s => {
                s.innerHTML = '&#9734;';
                s.classList.remove('selected');
            });
            for (let i = 0; i < selectedRating; i++) {
                document.querySelectorAll('.review-rating .star')[i].innerHTML = '&#9733;';
                document.querySelectorAll('.review-rating .star')[i].classList.add('selected');
            }
            // Gán giá trị rating vào input ẩn
            document.getElementById('rating').value = selectedRating;
        });
    });

    // Xử lý submit form
    document.getElementById('reviewForm').addEventListener('submit', function(event) {
        const comment = document.getElementById('reviewComment').value.trim();
        if (comment === '' || selectedRating === 0) {
            event.preventDefault(); // Dừng submit nếu không hợp lệ
            document.getElementById('reviewMessage').style.backgroundColor = '#FF6B6B';
            document.getElementById('reviewMessage').innerText = 'Vui lòng điền đầy đủ thông tin và chọn sao!';
            document.getElementById('reviewMessage').style.display = 'block';
        }
    });
</script>

</html>
