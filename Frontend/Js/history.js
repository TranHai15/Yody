// Hiển thị chi tiết đơn hàng
function showDetails(event) {
  const parent = event.target.closest(".order-item"); // Tìm phần tử cha chứa popup
  const popup = parent.querySelector(".popup"); // Tìm popup chi tiết trong phần tử cha
  const overlay = document.querySelector(".overlay"); // Lớp phủ

  if (popup) {
    popup.classList.remove("hidden");
    popup.style.display = "block";
    overlay.classList.add("active");
  } else {
    console.error("Không tìm thấy popup chi tiết");
  }
}

// Hiển thị popup form hủy đơn
function showCancelForm(event) {
  const parent = event.target.closest(".order-item"); // Tìm phần tử cha chứa popup
  const popupCancel = parent.querySelector(".popup-cancel"); // Tìm popup hủy đơn trong phần tử cha
  const overlay = document.querySelector(".overlay"); // Lớp phủ

  if (popupCancel) {
    popupCancel.classList.remove("hidden");
    popupCancel.style.display = "block";
    overlay.classList.add("active");
  } else {
    console.error("Không tìm thấy popup hủy đơn");
  }
}

// Đóng popup
function closePopup(event) {
  const popup = event.target.closest(".popup, .popup-cancel"); // Tìm popup gốc cần đóng
  const overlay = document.querySelector(".overlay");

  if (popup) {
    popup.classList.add("hidden");
    popup.style.display = "none";
    overlay.classList.remove("active");
  } else {
    console.error("Không tìm thấy popup để đóng");
  }
}

// Đóng popup khi click ra ngoài
function closePopupOutside() {
  const popup = document.querySelector(
    ".popup:not(.hidden), .popup-cancel:not(.hidden)"
  );
  const overlay = document.querySelector(".overlay");

  if (popup) {
    popup.classList.add("hidden");
    popup.style.display = "none";
  }

  overlay.classList.remove("active");
}
