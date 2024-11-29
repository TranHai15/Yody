// *** Xử lý ảnh sản phẩm ***

document.querySelectorAll(".detail__left--item img").forEach((thumbnail) => {
  thumbnail.addEventListener("click", (event) => {
    const bigImage = document.querySelector(".detail__right--img img");
    const thumbnailSrc = event.target.getAttribute("src");

    // Cập nhật ảnh lớn
    bigImage.setAttribute("src", thumbnailSrc);

    // Cập nhật trạng thái active
    document
      .querySelectorAll(".detail__left--item")
      .forEach((item) => item.classList.remove("active--detail__left--item"));
    event.target.parentElement.classList.add("active--detail__left--item");
  });
});

// *** Xử lý số lượng sản phẩm ***
let soluongchon = 1;
const getNumberSanpham = parseInt(
  document.querySelector(".size-option").getAttribute("data-quantity"),
  10
);

// Cập nhật số lượng
function updateSoLuongChon(change) {
  const soluongchonElement = document.getElementById("soluongchon");
  const decreaseButton = document.getElementById("decrease");

  soluongchon = Math.min(getNumberSanpham, Math.max(1, soluongchon + change));
  soluongchonElement.textContent = soluongchon;

  decreaseButton.classList.toggle("disabled", soluongchon === 1);
}

// *** Xử lý chọn kích thước sản phẩm ***
let getSizeValue = document
  .querySelector(".size-option")
  .getAttribute("data-sizeId");

document.addEventListener("DOMContentLoaded", () => {
  const sizeOptions = document.querySelectorAll(".size-option");

  sizeOptions.forEach((option) => {
    option.addEventListener("click", () => {
      const sizeId = option.getAttribute("data-sizeId");
      const size = option.getAttribute("data-size");

      document
        .querySelectorAll(".size-option")
        .forEach((opt) => opt.classList.remove("active__size"));
      option.classList.add("active__size");

      document.querySelector(".value__size").innerText = size;
      document.querySelector(".detail__right-code .value__size").innerText =
        size;
      document.querySelector(".size-label .size__value").innerText = size;

      getSizeValue = sizeId;
    });
  });
});

// *** Hiển thị thông báo ***
function showNotification(message, type = "success") {
  const notification = document.createElement("section");
  notification.className = `notification ${type}`;
  notification.innerHTML = `<div><p>${message}</p></div>`;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.opacity = "0";
    setTimeout(() => notification.remove(), 500);
  }, 5000);
}

// *** Xử lý thêm sản phẩm vào giỏ hàng ***
const detail = document.querySelector(".detail");
const userId = detail.getAttribute("data-userId");
getnumber(userId);
document.querySelector(".add__cart").addEventListener("click", () => {
  const variationId = detail.getAttribute("data-variationId");
  const salePrice = detail
    .querySelector(".detail__right--price--new")
    .getAttribute("data-price");
  const tonggia = parseInt(salePrice, 10);

  if (soluongchon > getNumberSanpham) {
    alert("Số lượng không đủ!");
    return;
  }

  if (!userId) {
    alert("Vui lòng đăng nhập!");
    localStorage.setItem("dangnhapmuahang", window.location.href);
    window.location.href = "/Yody/auth?action=login";
    return;
  }

  fetch(
    `Backend/controller/client/clientAjax.php?addcart=${userId}&variationId=${variationId}&sizeId=${getSizeValue}&quantity=${soluongchon}&price=${tonggia}`
  )
    .then((res) => {
      if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
      return res.json();
    })
    .then((data) => {
      showNotification(data.message, data.status);
      if (data.status === "success") {
        getnumber(userId);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
});

// *** Cập nhật số lượng sản phẩm trong giỏ hàng ***
function getnumber(userId) {
  fetch(`Backend/controller/client/clientAjax.php?soluong=${userId}`)
    .then((res) => {
      if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
      return res.json();
    })
    .then((data) => {
      if (data.status === "success") {
        const soluong = data.soluong;
        console.log("soluong", soluong);
        if (soluong == null) {
          document.querySelector(".soluongCart").style.display = "none";
          localStorage.removeItem("cartNumber");
          return;
        } else {
          document.querySelector(".soluongCart").style.display = "block";
          localStorage.setItem("cartNumber", soluong);
          document.querySelector(".numberCart").innerText = soluong;
        }
      } else {
        showNotification(data.message, data.status);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
}
// console.log(document.querySelector(".cate__new"));
document.querySelector(".cate__new").addEventListener("click", () => {
  const variationId = detail.getAttribute("data-variationId");
  const salePrice = detail
    .querySelector(".detail__right--price--new")
    .getAttribute("data-price");
  const tonggia = parseInt(salePrice, 10);

  if (soluongchon > getNumberSanpham) {
    alert("Số lượng không đủ!");
    return;
  }

  if (!userId) {
    alert("Vui lòng đăng nhập!");
    localStorage.setItem("dangnhapmuahang", window.location.href);
    window.location.href = "/Yody/auth?action=login";
    return;
  }

  fetch(
    `Backend/controller/client/clientAjax.php?addcart=${userId}&variationId=${variationId}&sizeId=${getSizeValue}&quantity=${soluongchon}&price=${tonggia}`
  )
    .then((res) => {
      if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
      return res.json();
    })
    .then((data) => {
      // showNotification(data.message, data.status);
      if (data.status === "success") {
        getnumber(userId);
        window.location.href = `/Yody/cart?id=${userId}`;
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
});
