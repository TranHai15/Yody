const updateTotalPrice = (totalPrice) => {
  document.querySelectorAll(".sumPricess").forEach((element) => {
    element.textContent = new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND",
    }).format(totalPrice);
  });
};

document.addEventListener("DOMContentLoaded", function () {
  const checkAll = document.getElementById("check__sale");
  const productCheckboxes = document.querySelectorAll(".product-checkbox");
  const incrementButtons = document.querySelectorAll(".tang");
  const decrementButtons = document.querySelectorAll(".giam");
  const quantityElements = document.querySelectorAll(".hienthi");
  const numberCartElement = document.querySelector(".numberCart");

  // Cập nhật giá tiền tổng

  // Gọi API kiểm tra số lượng
  const checkStock = async (data) => {
    try {
      const response = await fetch("Backend/controller/client/cartAjax.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });
      return await response.json();
    } catch (error) {
      console.error("Lỗi khi kiểm tra số lượng:", error);
      return { status: false, message: "Không thể kiểm tra số lượng." };
    }
  };

  // Cập nhật số lượng trong LocalStorage
  const updateCartNumber = (change) => {
    let cartLoca = parseInt(localStorage.getItem("cartNumber")) || 0;
    cartLoca += change;
    localStorage.setItem("cartNumber", cartLoca);
    numberCartElement.innerText = cartLoca;
  };

  let idCartItemsss = "";
  // Xử lý sự kiện tăng/giảm số lượng
  const updateQuantity = async (button, change) => {
    const cartQuantityElement = button.closest(".cart__quantity");
    const quantityElement = cartQuantityElement.querySelector("span");
    let currentQuantity = parseInt(quantityElement.textContent);
    const product__item = document
      .querySelector(".product__item")
      .getAttribute("data-cartId");
    idCartItemsss = cartQuantityElement.dataset.cartitem;
    const data = {
      productId: cartQuantityElement.dataset.cartitem,
      variationId: cartQuantityElement.dataset.variationid,
      sizeId: cartQuantityElement.dataset.sizeid,
      currentQuantity: currentQuantity + change,
      product__item,
    };

    if (data.currentQuantity > 0) {
      const result = await checkStock(data);
      if (result.status === "success") {
        quantityElement.textContent = currentQuantity + change;
        updateCartNumber(change);
        updateTotalPrice(result.data.total);
      } else {
        alert(result.message);
      }
    } else {
      if (confirm("ban co muon xoa no ko")) {
        deleteCartItem(idCartItemsss);
        // const idC = checkbox.closest(".product__item").dataset.cartitem;
        // console.log(idCartItemsss);
      } else {
        alert("df");
      }
    }
  };

  // Đặt sự kiện cho nút tăng/giảm số lượng
  incrementButtons.forEach((button) =>
    button.addEventListener("click", () => updateQuantity(button, 1))
  );
  decrementButtons.forEach((button) =>
    button.addEventListener("click", () => updateQuantity(button, -1))
  );

  // checkAll.addEventListener("change", function () {
  //   const isChecked = checkAll.checked;
  //   productCheckboxes.forEach((checkbox) => (checkbox.checked = isChecked));
  // });

  // // Đặt sự kiện cho các checkbox sản phẩm
  // productCheckboxes.forEach((checkbox) =>
  //   checkbox.addEventListener("change", function () {
  //     checkAll.checked = Array.from(productCheckboxes).every(
  //       (cb) => cb.checked
  //     );
  //   })
  // );

  // Thiết lập trạng thái mặc định
  // const initializeDefaultState = () => {
  //   checkAll.checked = true;
  //   productCheckboxes.forEach((checkbox) => (checkbox.checked = true));
  //   const cartLoca = parseInt(localStorage.getItem("cartNumber")) || 0;
  //   numberCartElement.innerText = cartLoca;
  // };

  // initializeDefaultState();
});
document.addEventListener("DOMContentLoaded", function () {
  const checkAll = document.getElementById("check__sale"); // checkbox "Chọn toàn bộ"
  const productCheckboxes = document.querySelectorAll(".product-checkbox"); // tất cả checkbox sản phẩm
  const productItems = document.querySelectorAll(".product__item"); // tất cả sản phẩm trong giỏ hàng

  // Khi chọn hoặc bỏ chọn "Chọn toàn bộ"
  checkAll.addEventListener("change", function () {
    const isChecked = checkAll.checked; // Kiểm tra trạng thái của "Chọn toàn bộ"

    // Cập nhật tất cả các checkbox sản phẩm
    productCheckboxes.forEach(function (checkbox) {
      checkbox.checked = isChecked;
    });
    const cartId = document
      .querySelector(".product__item")
      .getAttribute("data-cartId");
    // console.log(cartId);
    // Gửi yêu cầu cập nhật lên backend nếu cần (cập nhật trạng thái của tất cả sản phẩm)
    updateCartSelection(isChecked, cartId, "all", cartId);
  });

  // Khi chọn hoặc bỏ chọn một sản phẩm cụ thể
  productCheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
      const productId = checkbox.closest(".product__item").dataset.cartitem;

      const isChecked = checkbox.checked;
      const cartId = document
        .querySelector(".product__item")
        .getAttribute("data-cartId");
      // Cập nhật trạng thái của sản phẩm trong cơ sở dữ liệu
      updateCartSelection(isChecked, productId, "one", cartId);

      // Cập nhật trạng thái của "Chọn toàn bộ" nếu cần
      updateSelectAllCheckbox();
    });
  });

  // Hàm cập nhật trạng thái chọn sản phẩm trong cơ sở dữ liệu
  async function updateCartSelection(isSelected, id, status, productId) {
    // Chuẩn bị dữ liệu gửi đi
    const data = [];
    data.push({ cartitem: id });
    data.push({ status: status });
    data.push({ selected: isSelected ? 1 : 0 });
    data.push({ cartId: productId });

    // Gửi yêu cầu tới backend (ví dụ qua fetch)
    try {
      const response = await fetch("Backend/controller/client/cartAjax.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      // Kiểm tra phản hồi từ backend
      if (!response.ok) {
        throw new Error("Yêu cầu không thành công");
      }

      const result = await response.json();
      console.log(result.data.total);
      const price = result.data.total;
      console.log(price);
      updateTotalPrice(price);
      return result; // Trả về kết quả JSON nhận được từ backend
    } catch (error) {
      console.error("Lỗi khi cập nhật giỏ hàng:", error);
      return { status: false, message: "Không thể cập nhật giỏ hàng." };
    }
  }

  // Hàm kiểm tra và cập nhật trạng thái của "Chọn toàn bộ"
  function updateSelectAllCheckbox() {
    const allChecked = Array.from(productCheckboxes).every(
      (checkbox) => checkbox.checked
    );
    checkAll.checked = allChecked;
  }
});

document.querySelector("#btn__confirm").addEventListener("click", (e) => {
  e.preventDefault();
  const check = document.querySelector(".sumPricess").innerText;
  console.log(check.length > 3);
  if (check.length > 3) {
    return (window.location.href = e.target.closest("a").href);
  } else {
    alert("vui long chon 1 san pham");
  }
});

async function deleteCartItem(id) {
  try {
    const response = await fetch(
      `Backend/controller/client/cartAjax.php?deleteCartItemr=${id}`
    );

    // Kiểm tra phản hồi từ backend
    if (!response.ok) {
      showNotification("Xóa không thành công", "error");
      throw new Error("Yêu cầu không thành công");
    }
    showNotification("Xóa thành công");

    // console.log(response);
  } catch (error) {
    console.error("Lỗi khi cập nhật giỏ hàng:", error);
    return { status: false, message: "Không thể cập nhật giỏ hàng." };
  }
}
function showNotification(message, type = "success") {
  const notification = document.createElement("section");
  notification.className = `notification ${type}`;
  notification.innerHTML = `<div><p>${message}</p></div>`;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.opacity = "0";
    window.location.href = window.location.href;
    setTimeout(() => notification.remove(), 300);
  }, 5000);
}
