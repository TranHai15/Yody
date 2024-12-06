// Lấy các phần tử cần thiết
const slidesContainer = document.querySelector(".banner__one ul");
const slides = document.querySelectorAll(".slide");
const prevButton = document.querySelector('[data-carousel-button="prev"]');
const nextButton = document.querySelector('[data-carousel-button="next"]');
let currentIndex = 1; // Chỉ số slide hiện tại (bắt đầu từ 1 vì thêm bản sao)
let autoSlideInterval; // Biến lưu interval
let isTransitioning = false; // Biến để kiểm tra trạng thái chuyển động

// Sao chép slide đầu tiên và cuối cùng, thêm vào đầu và cuối danh sách
const firstSlide = slides[0].cloneNode(true);
const lastSlide = slides[slides.length - 1].cloneNode(true);

slidesContainer.insertBefore(lastSlide, slides[0]); // Thêm bản sao của slide cuối vào đầu
slidesContainer.appendChild(firstSlide); // Thêm bản sao của slide đầu vào cuối

// Cập nhật tổng số slide sau khi thêm hai bản sao
const updatedSlides = document.querySelectorAll(".slide");

// Hàm cập nhật slide
function updateSlide() {
  const slideWidth = updatedSlides[0].offsetWidth; // Lấy chiều rộng của slide
  slidesContainer.style.transform = `translateX(-${
    currentIndex * slideWidth
  }px)`; // Di chuyển container theo chiều ngang
}

// Chuyển đến slide tiếp theo
function goToNextSlide() {
  if (isTransitioning) return; // Kiểm tra nếu đang chuyển động, không thực hiện gì

  isTransitioning = true; // Đặt trạng thái chuyển động
  currentIndex++;
  slidesContainer.style.transition = "transform 0.5s ease-in-out"; // Bật lại hiệu ứng chuyển động
  updateSlide();

  // Nếu đến slide cuối (bản sao của slide đầu), quay lại slide đầu
  if (currentIndex === updatedSlides.length - 1) {
    setTimeout(() => {
      slidesContainer.style.transition = "none"; // Tắt hiệu ứng chuyển động
      currentIndex = 1; // Quay lại slide đầu tiên
      updateSlide();
    }, 800);
  }

  // Đặt lại trạng thái sau khi hoàn tất chuyển động
  setTimeout(() => {
    isTransitioning = false;
  }, 800);
}

// Chuyển đến slide trước
function goToPrevSlide() {
  if (isTransitioning) return; // Kiểm tra nếu đang chuyển động, không thực hiện gì

  isTransitioning = true; // Đặt trạng thái chuyển động
  currentIndex--;
  slidesContainer.style.transition = "transform 0.5s ease-in-out"; // Bật lại hiệu ứng chuyển động
  updateSlide();

  // Nếu đến slide đầu tiên (bản sao của slide cuối), quay lại slide cuối
  if (currentIndex === 0) {
    setTimeout(() => {
      slidesContainer.style.transition = "none"; // Tắt hiệu ứng chuyển động
      currentIndex = updatedSlides.length - 2; // Quay lại slide cuối thật
      updateSlide();
    }, 800);
  }

  // Đặt lại trạng thái sau khi hoàn tất chuyển động
  setTimeout(() => {
    isTransitioning = false;
  }, 800);
}

// Hàm để thiết lập lại auto slide
function resetAutoSlide() {
  clearInterval(autoSlideInterval); // Xóa interval hiện tại
  autoSlideInterval = setInterval(goToNextSlide, 3000); // Thiết lập lại interval
}

nextButton.addEventListener("click", () => {
  goToNextSlide();
  resetAutoSlide(); // Thiết lập lại auto slide khi nhấn nút next
});

prevButton.addEventListener("click", () => {
  goToPrevSlide();
  resetAutoSlide(); // Thiết lập lại auto slide khi nhấn nút prev
});

// Tự động chuyển động sau mỗi 3 giây
autoSlideInterval = setInterval(goToNextSlide, 3000);

// Cập nhật slide ban đầu
updateSlide();

const lichsuluulia = localStorage.getItem("dangnhapmuahang");
console.log(lichsuluulia);

if (lichsuluulia !== null) {
  setTimeout(() => {
    window.location.href = lichsuluulia;
  }, 2000);
  localStorage.removeItem("dangnhapmuahang");
}
document.querySelectorAll(".product__variation-link").forEach((link) => {
  let lastHoveredImg = null; // Biến lưu trữ ảnh hover gần nhất
  let lastActiveItem = null; // Biến lưu trữ phần tử active trước đó

  link.addEventListener("mouseenter", (event) => {
    // Lấy ảnh từ thuộc tính data-images và thay đổi ảnh chính
    const imgSrc = event.target.closest("a").getAttribute("data-images");
    const mainImage = event.target
      .closest(".product")
      .querySelector(".product__image img");
    mainImage.setAttribute("src", imgSrc); // Thay đổi ảnh chính

    // Cập nhật ảnh hover
    lastHoveredImg = imgSrc; // Lưu lại ảnh vừa hover

    // Di chuyển trạng thái active lên phần tử mới
    const currentItem = event.target.closest(".product__variation--item");

    // Xóa bỏ trạng thái active từ phần tử trước đó
    if (lastActiveItem) {
      lastActiveItem.classList.remove("active__product--variation");
    }

    // Thêm trạng thái active vào phần tử mới
    currentItem.classList.add("active__product--variation");

    // Cập nhật phần tử active
    lastActiveItem = currentItem;
  });

  link.addEventListener("mouseleave", (event) => {
    // Giữ lại ảnh hover gần nhất khi chuột rời khỏi
    const mainImage = event.target
      .closest(".product")
      .querySelector(".product__image img");
    if (lastHoveredImg) {
      mainImage.setAttribute("src", lastHoveredImg); // Giữ lại ảnh đã hover
    }

    // Giữ trạng thái active ở phần tử cuối cùng khi chuột rời
    if (lastActiveItem) {
      lastActiveItem.classList.add("active__product--variation");
    }
  });
});
