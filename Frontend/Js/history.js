// Hiển thị chi tiết đơn hàng
function showDetails(event) {
  const popup = event.target.nextElementSibling; // Popup gần nút Chi tiết
  const overlay = document.querySelector(".overlay"); // Lớp phủ

  // Hiển thị popup và lớp phủ
  popup.classList.remove("hidden");
  popup.style.display = "block";
  overlay.classList.add("active");
}

// Đóng popup khi nhấn nút "Đóng"
function closePopup(event) {
  const popup = event.target.parentElement; // Popup hiện tại
  const overlay = document.querySelector(".overlay"); // Lớp phủ

  // Ẩn popup và lớp phủ
  popup.classList.add("hidden");
  popup.style.display = "none";
  overlay.classList.remove("active");
}

// Đóng popup khi click ra ngoài popup
function closePopupOutside() {
  const popup = document.querySelector(".popup:not(.hidden)"); // Popup đang hiển thị
  const overlay = document.querySelector(".overlay"); // Lớp phủ

  if (popup) {
    popup.classList.add("hidden");
    popup.style.display = "none";
  }

  // Ẩn lớp phủ
  overlay.classList.remove("active");
}

// Ngăn sự kiện click bên trong popup lan ra lớp phủ
document.querySelectorAll(".popup").forEach((popup) => {
  popup.addEventListener("click", (event) => {
    event.stopPropagation(); // Ngăn sự kiện lan ra ngoài
  });
});
