<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/Css/home.css">
    <link rel="stylesheet" href="Frontend/Css/form.css">
    <title>category</title>

</head>

<body>
<section class="review-section grid wide">
    <h2 class="review-title">Đánh giá sản phẩm</h2>
    <div class="review-form-container">
        <form id="reviewForm" class="review-form">
            <div class="review-form-group">
                <label for="reviewName" class="review-label">Họ và tên:</label>
                <input type="text" id="reviewName" class="review-input" placeholder="Nhập tên của bạn...">
            </div>
            <div class="review-form-group">
                <label for="reviewRating" class="review-label">Đánh giá:</label>
                <div id="reviewRating" class="review-rating">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9734;</span>
                </div>
            </div>
            <div class="review-form-group">
                <label for="reviewComment" class="review-label">Nhận xét:</label>
                <textarea id="reviewComment" class="review-textarea" placeholder="Viết nhận xét của bạn..."></textarea>
            </div>
            <!-- Thêm phần upload ảnh -->
            <div class="review-form-group">
                <label for="reviewImage" class="review-label">Chọn ảnh (Tối đa 3 ảnh):</label>
                <input type="file" id="reviewImage" class="review-input" accept="image/*" multiple>
                <div id="imagePreview" class="image-preview"></div>
            </div>
            <button type="submit" class="review-submit-btn">Gửi đánh giá</button>
        </form>
        <div id="reviewMessage" class="review-message"></div>
    </div>
</section>


</body>


<script>
    document.getElementById('reviewForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn submit form mặc định

        const name = document.getElementById('reviewName').value.trim();
        const rating = document.querySelector('.review-rating .star.selected').length; // Số sao đã được chọn
        const comment = document.getElementById('reviewComment').value.trim();

        if (name === '' || comment === '' || rating === 0) {
            document.getElementById('reviewMessage').style.backgroundColor = '#FF6B6B';
            document.getElementById('reviewMessage').innerText = 'Vui lòng điền đầy đủ thông tin!';
            document.getElementById('reviewMessage').style.display = 'block';
        } else {
            document.getElementById('reviewMessage').style.backgroundColor = '#28a745';
            document.getElementById('reviewMessage').innerText = 'Đánh giá của bạn đã được gửi thành công!';
            document.getElementById('reviewMessage').style.display = 'block';
        }

        // Reset form
        setTimeout(function() {
            document.getElementById('reviewMessage').style.display = 'none';
            document.getElementById('reviewForm').reset();
        }, 2000);
    });

    // Xử lý sự kiện click sao
    document.querySelectorAll('.review-rating .star').forEach(star => {
        star.addEventListener('click', function() {
            document.querySelectorAll('.review-rating .star').forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
</script>


</html>