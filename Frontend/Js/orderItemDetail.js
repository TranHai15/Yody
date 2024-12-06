document.addEventListener("DOMContentLoaded", function () {
  const cancelButtons = document.querySelectorAll(".btn-cancel");
  const popup = document.getElementById("popup-cancel-item");
  const overlay = document.getElementById("overlay");
  const confirmCancel = document.getElementById("confirm-cancel");
  const closePopup = document.getElementById("close-popup");
  const itemIdInput = document.getElementById("item-id");
  const cancelReasonInput = document.getElementById("cancel-reason");
  const cancelMessage = document.getElementById("cancel-message");

  cancelButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const itemId = this.getAttribute("data-item-id"); // Lấy orderItemId từ data-item-id
      const itemName =
        this.closest(".item-card").querySelector("h3").textContent;

      // Cập nhật thông báo và ID
      cancelMessage.textContent = `Bạn có chắc chắn muốn hủy mặt hàng "${itemName}" không?`;
      itemIdInput.value = itemId; // Gán orderItemId vào input ẩn

      // Reset lý do hủy
      cancelReasonInput.value = "";

      // Hiển thị popup và overlay
      popup.classList.add("show");
      overlay.classList.add("show");
    });
  });

  // Đóng popup
  closePopup.addEventListener("click", function () {
    popup.classList.remove("show");
    overlay.classList.remove("show");
  });

  // Xác nhận hủy
  confirmCancel.addEventListener("click", function () {
    const itemId = itemIdInput.value;
    const reason = cancelReasonInput.value.trim();

    if (!reason) {
      alert("Vui lòng nhập lý do hủy!");
      return;
    }

    // Gửi yêu cầu hủy mặt hàng đến server
    fetch("Backend/controller/client/orderItemAjax.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        orderItemId: itemId, // Lấy orderItemId từ input ẩn
        reason: reason, // Lấy lý do hủy từ textarea
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Ẩn popup và cập nhật UI nếu cần
          showNotification("Gửi lý do thành công! Vui lòng đợi phản hồi!");
          popup.classList.remove("show");
          overlay.classList.remove("show");

          setTimeout(() => {
            location.reload();
          }, 1500);
          // Reload danh sách mặt hàng hoặc xóa trực tiếp mặt hàng trong giao diện
        } else {
          // alert("Hủy mặt hàng thất bại. Vui lòng thử lại!");
          showNotification("Gửi lý do thất bại", "error");
        }
      })
      .catch((error) => {
        console.error("Lỗi khi gửi yêu cầu hủy:", error);
        alert("Có lỗi xảy ra. Vui lòng thử lại!");
      });
  });
});
function showNotification(message, type = "success") {
  const notification = document.createElement("section");
  notification.className = `notification ${type}`;
  notification.innerHTML = `<div><p>${message}</p></div>`;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.opacity = "0";
    setTimeout(() => notification.remove(), 300);
  }, 5000);
}
