// document.addEventListener("DOMContentLoaded", () => {
//   const overlay = document.querySelector(".overlay");

//   // Hiển thị popup chi tiết đơn hàng
//   function showDetails(event) {
//     const parent = event.target.closest(".order-item");
//     const popup = parent.querySelector(".popup");

//     if (popup) {
//       popup.classList.remove("hidden");
//       popup.style.display = "block";
//       overlay.classList.add("active");
//     } else {
//       console.error("Không tìm thấy popup chi tiết");
//     }
//   }

//   // Hiển thị popup hủy đơn hàng
//   function showCancelForm(event) {
//     const parent = event.target.closest(".order-item");
//     const popupCancel = parent.querySelector(".popup-cancel");

//     if (popupCancel) {
//       popupCancel.classList.remove("hidden");
//       popupCancel.style.display = "block";
//       overlay.classList.add("active");
//     } else {
//       console.error("Không tìm thấy popup hủy đơn");
//     }
//   }

//   // Đóng popup
//   function closePopup(event) {
//     const popup = event.target.closest(".popup, .popup-cancel");

//     if (popup) {
//       popup.classList.add("hidden");
//       popup.style.display = "none";
//     }
//     overlay.classList.remove("active");
//   }

//   // Đóng popup khi click ra ngoài
//   function closePopupOutside() {
//     const popup = document.querySelector(
//       ".popup:not(.hidden), .popup-cancel:not(.hidden)"
//     );

//     if (popup) {
//       popup.classList.add("hidden");
//       popup.style.display = "none";
//     }
//     overlay.classList.remove("active");
//   }

//   // Xử lý gửi lý do hủy đơn
//   function handleCancelFormSubmit(event) {
//     event.preventDefault(); // Ngăn chặn gửi form ngay lập tức

//     const form = event.target;
//     const orderItem = form.closest(".order-item");
//     const orderId = orderItem.dataset.orderid;
//     const reasons = form.querySelectorAll("input[name='reason']:checked");
//     const cancelButton = form.querySelector(".cancel-btn");

//     // Kiểm tra lý do hủy đơn
//     if (reasons.length === 0) {
//       alert("Vui lòng chọn ít nhất một lý do hủy đơn!");
//       return;
//     }

//     // Hiển thị trạng thái xử lý
//     cancelButton.textContent = "Đang xử lý...";
//     cancelButton.disabled = true;

//     // Tạo dữ liệu gửi
//     const formData = new FormData(form);
//     formData.append("orderId", orderId);

//     // Gửi yêu cầu đến server
//     fetch("Backend/controller/client/orderAjax.php", {
//       method: "POST",
//       body: formData,
//     })
//       .then((response) => response.json())
//       .then((data) => {
//         if (data.success) {
//           alert(data.message);

//           // Cập nhật trạng thái giao diện
//           const status = orderItem.querySelector(".status");
//           status.textContent = "Đang chờ xử lý...";
//           status.style.color = "red";

//           cancelButton.textContent = "Đang chờ xử lý...";
//           cancelButton.disabled = true;

//           // Tải lại trang sau khi xử lý thành công
//           location.reload(); // Tải lại trang
//         } else {
//           alert(data.message || "Có lỗi xảy ra, vui lòng thử lại!");
//           cancelButton.textContent = "Gửi lý do";
//           cancelButton.disabled = false;
//         }
//       })
//       .catch((error) => {
//         console.error("Lỗi:", error);
//         alert("Không thể kết nối đến máy chủ. Vui lòng thử lại sau.");
//         cancelButton.textContent = "Gửi lý do";
//         cancelButton.disabled = false;
//       });
//   }

//   // Gán sự kiện cho các nút và form
//   document.querySelectorAll(".btn-detail").forEach((btn) => {
//     btn.addEventListener("click", showDetails);
//   });

//   document.querySelectorAll(".btn-cancel").forEach((btn) => {
//     btn.addEventListener("click", showCancelForm);
//   });

//   document.querySelectorAll(".close-btn").forEach((btn) => {
//     btn.addEventListener("click", closePopup);
//   });

//   overlay.addEventListener("click", closePopupOutside);

//   document.querySelectorAll(".cancel-form").forEach((form) => {
//     form.addEventListener("submit", handleCancelFormSubmit);
//   });
// });

// function showDetails(event) {
//   const popup = event.target.closest(".order-item").querySelector(".popup");
//   popup.classList.remove("hidden");
//   document.querySelector(".overlay").classList.remove("hidden");
// }

// function showCancelForm(event) {
//   const popupCancel = event.target
//     .closest(".order-item")
//     .querySelector(".popup-cancel");
//   popupCancel.classList.remove("hidden");
//   document.querySelector(".overlay").classList.remove("hidden");
// }

// function closePopup(event) {
//   const popup = event.target.closest(".popup");
//   if (popup) {
//     popup.classList.add("hidden");
//   }
//   document.querySelector(".overlay").classList.add("hidden");
// }

// function closePopupOutside() {
//   const popups = document.querySelectorAll(".popup, .popup-cancel");
//   popups.forEach((popup) => popup.classList.add("hidden"));
//   document.querySelector(".overlay").classList.add("hidden");
// }
// ***********************************************************************************************************
//**************************************** */ Hiện popup hủy đơn*********************************************8
// ***********************************************************************************************************
// Lấy các phần tử cần dùng
document.addEventListener("DOMContentLoaded", () => {
  const popupCancelOrder = document.getElementById("popup-cancel-order");
  const overlayElement = document.getElementById("overlay");
  const cancelButtons = document.querySelectorAll(".btn-cancel");
  const closeFormButton = document.getElementById("close-form");
  const submitFormButton = document.getElementById("submit-form");

  let currentOrderId = null; // Biến lưu ID của đơn hàng đang thao tác

  // Hiển thị popup
  function showPopup(orderId) {
    currentOrderId = orderId; // Lưu orderId khi nhấn nút hủy
    popupCancelOrder.classList.remove("hidden");
    overlayElement.classList.remove("hidden");
  }

  // Ẩn popup
  function hidePopup() {
    popupCancelOrder.classList.add("hidden");
    overlayElement.classList.add("hidden");
  }

  // Gắn sự kiện cho các nút "Hủy Đơn"
  cancelButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const orderId = button.getAttribute("data-order-id"); // Lấy orderId từ nút
      showPopup(orderId);
    });
  });

  // Gửi dữ liệu lý do hủy đơn
  submitFormButton.addEventListener("click", async () => {
    const checkedReasons = Array.from(
      document.querySelectorAll("input[name='reason']:checked")
    ).map((input) => input.value); // Lấy danh sách lý do đã chọn

    const additionalReason = document
      .querySelector("input[name='additionalReason']")
      ?.value.trim(); // Lấy lý do bổ sung (nếu có)

    if (checkedReasons.length === 0 && !additionalReason) {
      alert("Vui lòng chọn ít nhất một lý do hoặc nhập lý do bổ sung.");
      return;
    }

    // Gửi yêu cầu POST đến orderAjax.php
    try {
      const response = await fetch("Backend/controller/client/orderAjax.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded", // Dữ liệu gửi dạng form-urlencoded
        },
        body: new URLSearchParams({
          orderId: currentOrderId,
          reason: checkedReasons,
          additionalReason: additionalReason,
        }),
      });

      const result = await response.json(); // Đọc phản hồi JSON từ server

      if (result.success) {
        // alert("thanhcong");
        showNotification("Hủy Thành Công");
        hidePopup(); // Ẩn popup sau khi xử lý thành công

        // Cập nhật trạng thái nút
        cancelButtons.forEach((button) => {
          if (button.getAttribute("data-order-id") === currentOrderId) {
            button.setAttribute("disabled", "true"); // Thêm thuộc tính disabled
            button.classList.add("disabled"); // Thêm class để thay đổi giao diện
            button.textContent = "Đã hủy"; // Thay đổi nội dung nút (nếu cần)
            setTimeout(() => {
              location.reload();
            }, 1500);
          }
        });

        // Option: location.reload(); Nếu cần làm mới trang
      } else {
        alert(result.message || "Đã xảy ra lỗi!");
        showNotification("Hủy Thất bại", "error");
      }
    } catch (error) {
      console.error("Lỗi khi gửi yêu cầu:", error);
      alert("Đã xảy ra lỗi. Vui lòng thử lại.");
    }
  });

  // Đóng popup khi nhấn "Đóng" hoặc bên ngoài
  closeFormButton.addEventListener("click", hidePopup);
  overlayElement.addEventListener("click", hidePopup);
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
