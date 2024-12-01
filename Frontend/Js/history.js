document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.querySelector(".overlay");

  // Hiển thị popup chi tiết đơn hàng
  function showDetails(event) {
    const parent = event.target.closest(".order-item");
    const popup = parent.querySelector(".popup");

    if (popup) {
      popup.classList.remove("hidden");
      popup.style.display = "block";
      overlay.classList.add("active");
    } else {
      console.error("Không tìm thấy popup chi tiết");
    }
  }

  // Hiển thị popup hủy đơn hàng
  function showCancelForm(event) {
    const parent = event.target.closest(".order-item");
    const popupCancel = parent.querySelector(".popup-cancel");

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
    const popup = event.target.closest(".popup, .popup-cancel");

    if (popup) {
      popup.classList.add("hidden");
      popup.style.display = "none";
    }
    overlay.classList.remove("active");
  }

  // Đóng popup khi click ra ngoài
  function closePopupOutside() {
    const popup = document.querySelector(
      ".popup:not(.hidden), .popup-cancel:not(.hidden)"
    );

    if (popup) {
      popup.classList.add("hidden");
      popup.style.display = "none";
    }
    overlay.classList.remove("active");
  }

  // Xử lý gửi lý do hủy đơn
  function handleCancelFormSubmit(event) {
    event.preventDefault(); // Ngăn chặn gửi form ngay lập tức

    const form = event.target;
    const orderItem = form.closest(".order-item");
    const orderId = orderItem.dataset.orderid;
    const reasons = form.querySelectorAll("input[name='reason']:checked");
    const cancelButton = form.querySelector(".cancel-btn");

    // Kiểm tra lý do hủy đơn
    if (reasons.length === 0) {
      alert("Vui lòng chọn ít nhất một lý do hủy đơn!");
      return;
    }

    // Hiển thị trạng thái xử lý
    cancelButton.textContent = "Đang xử lý...";
    cancelButton.disabled = true;

    // Tạo dữ liệu gửi
    const formData = new FormData(form);
    formData.append("orderId", orderId);

    // Gửi yêu cầu đến server
    fetch("Backend/controller/client/orderAjax.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(data.message);

          // Cập nhật trạng thái giao diện
          const status = orderItem.querySelector(".status");
          status.textContent = "Đang chờ xử lý...";
          status.style.color = "red";

          cancelButton.textContent = "Đang chờ xử lý...";
          cancelButton.disabled = true;

          // Tải lại trang sau khi xử lý thành công
          location.reload(); // Tải lại trang
        } else {
          alert(data.message || "Có lỗi xảy ra, vui lòng thử lại!");
          cancelButton.textContent = "Gửi lý do";
          cancelButton.disabled = false;
        }
      })
      .catch((error) => {
        console.error("Lỗi:", error);
        alert("Không thể kết nối đến máy chủ. Vui lòng thử lại sau.");
        cancelButton.textContent = "Gửi lý do";
        cancelButton.disabled = false;
      });
  }

  // Gán sự kiện cho các nút và form
  document.querySelectorAll(".btn-detail").forEach((btn) => {
    btn.addEventListener("click", showDetails);
  });

  document.querySelectorAll(".btn-cancel").forEach((btn) => {
    btn.addEventListener("click", showCancelForm);
  });

  document.querySelectorAll(".close-btn").forEach((btn) => {
    btn.addEventListener("click", closePopup);
  });

  overlay.addEventListener("click", closePopupOutside);

  document.querySelectorAll(".cancel-form").forEach((form) => {
    form.addEventListener("submit", handleCancelFormSubmit);
  });
});
