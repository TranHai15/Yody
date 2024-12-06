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

const soluongsizeId = document.getElementById("soluongsizeId").innerText;
console.log("🚀 ~ soluongsizeId:", soluongsizeId);
if (soluongsizeId == 0) {
  document.querySelector(".add__cart").classList.add("soluongkhongcon");
  document.querySelector(".add__cart").innerText = "Sản phẩm hết hàng";
  document.querySelector(".cate__new").classList.add("soluongkhongcon");
  document.querySelector(".cate__new").innerText = "Sản phẩm hết hàng";
  document.querySelector(".number").classList.add("soluongkhongcon");
}

// *** Xử lý số lượng sản phẩm ***
let soluongchon = 1;

let getNumberSanpham = parseInt(
  document.querySelector(".size-option").getAttribute("data-quantity"),
  10
);

function updateSoLuongChon(change) {
  const soluongchonElement = document.getElementById("soluongchon");

  const decreaseButton = document.getElementById("decrease");

  soluongchon = Math.min(getNumberSanpham, Math.max(1, soluongchon + change));
  soluongchonElement.textContent = soluongchon;

  decreaseButton.classList.toggle("disabled", soluongchon === 1);
}

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
      checksoluongsize(sizeId);

      getSizeValue = sizeId;
    });
  });
});

const checksoluongsize = async (id) => {
  fetch(`Backend/controller/client/clientAjax.php?checksoluongsize=${id}`)
    .then((res) => {
      if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
      return res.json();
    })
    .then((data) => {
      if (data.status === "success") {
        const element = document.querySelector("[data-quantity]");
        console.log("🚀 ~ .then ~ element:", element);
        element.setAttribute("data-quantity", data.soluong);
        document.getElementById("soluongsizeId").innerText = data.soluong;
        getNumberSanpham = data.soluong;
        console.log("🚀 ~ .then ~ getNumberSanpham:", getNumberSanpham);
        if (data.soluong == 0) {
          document.querySelector(".add__cart").classList.add("soluongkhongcon");
          document.querySelector(".add__cart").innerText = "Sản phẩm hết hàng";
          document.querySelector(".cate__new").classList.add("soluongkhongcon");
          document.querySelector(".cate__new").innerText = "Sản phẩm hết hàng";
          document.querySelector(".number").classList.add("soluongkhongcon");
          return;
        }
        document.querySelector(".number").classList.remove("soluongkhongcon");
        document
          .querySelector(".add__cart")
          .classList.remove("soluongkhongcon");
        document
          .querySelector(".cate__new")
          .classList.remove("soluongkhongcon");
        document.querySelector(".cate__new").innerText = "Mua Ngay";
        document.querySelector(".add__cart").innerText = "Thêm giỏ hàng";
      } else {
        showNotification(data.message, data.status);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
};

const detail = document.querySelector(".detail");
const userId = detail.getAttribute("data-userId");
let soluongsanphamtrongdatabase = 0;
getnumber(userId);
document.querySelector(".add__cart").addEventListener("click", () => {
  const variationId = detail.getAttribute("data-variationId");
  const salePrice = detail
    .querySelector(".detail__right--price--new")
    .getAttribute("data-price");
  const tonggia = parseInt(salePrice, 10);

  let tongsoluongchon =
    Number(soluongchon) + Number(soluongsanphamtrongdatabase);
  console.log(
    "🚀 ~ document.querySelector ~ tongsoluongchon:",
    tongsoluongchon
  );

  if (tongsoluongchon > getNumberSanpham) {
    // alert("Số lượng không đủ!");
    showNotification("Số lượng tồn kho không đủ", "error");
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
        getnumberbyorderitem(userId, getSizeValue);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
});

// console.log(document.querySelector(".cate__new"));
document.querySelector(".cate__new").addEventListener("click", () => {
  const variationId = detail.getAttribute("data-variationId");
  const salePrice = detail
    .querySelector(".detail__right--price--new")
    .getAttribute("data-price");
  const tonggia = parseInt(salePrice, 10);

  let tongsoluongchon =
    Number(soluongchon) + Number(soluongsanphamtrongdatabase);
  console.log(
    "🚀 ~ document.querySelector ~ tongsoluongchon:",
    tongsoluongchon
  );

  if (tongsoluongchon > getNumberSanpham) {
    // alert("Số lượng không đủ!");
    showNotification("Số lượng tồn kho không đủ", "error");
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

//

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
        // console.log("soluong", soluong);
        if (soluong == null) {
          document.querySelector(".soluongCart").style.display = "none";
          localStorage.removeItem("cartNumber");
          return;
        } else {
          document.querySelector(".soluongCart").style.display = "block";
          localStorage.setItem("cartNumber", soluong);
          document.querySelector(".numberCart").innerText = soluong;
          return soluong;
        }
      } else {
        showNotification(data.message, data.status);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
}

//

function getnumberbyorderitem(userId, sizeid) {
  fetch(
    `Backend/controller/client/clientAjax.php?soluongsizeId=${userId}&sizeId=${sizeid}`
  )
    .then((res) => {
      if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
      return res.json();
    })
    .then((data) => {
      if (data.status === "success") {
        const soluong = data.soluong;
        // console.log("getnumberbyorderitem", soluong);
        soluongsanphamtrongdatabase = soluong;
      } else {
        showNotification(data.message, data.status);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
}
//

function submitComment() {
  var commentText = document.getElementById("commentText").value;
  // console.log("🚀 ~ submitComment ~ commentText:", commentText);
  const productId = document
    .querySelector(".detail")
    .getAttribute("data-productId");
  const userId = document.querySelector(".detail").getAttribute("data-userId");

  if (commentText) {
    // console.log("Đã gửi bình luận: ", commentText);
    document.getElementById("commentText").value = ""; // Xóa ô nhập sau khi gửi
    fetch(
      `Backend/controller/client/clientAjax.php?addComment=${productId}&content=${commentText}&userId=${userId}`
    )
      .then((res) => {
        if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
        return res.json();
      })
      .then((data) => {
        // showNotification(data.message, data.status);
        if (data.status === "success") {
          showNotification("Comment Thành Công");
          location.reload();
        }
      })
      .catch((error) => {
        console.error("Error connecting to server:", error);
      });
  } else {
    return;
  }
}

//
// Lấy tất cả các nút và các phần nội dung
const buttons = document.querySelectorAll(".btn-bl");
const sections = document.querySelectorAll(".comment, .feedback");

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    // Loại bỏ class "active" của tất cả các nút
    buttons.forEach((btn) => btn.classList.remove("active"));
    // Thêm class "active" cho nút hiện tại
    button.classList.add("active");

    // Ẩn tất cả các phần nội dung
    sections.forEach((section) => (section.style.display = "none"));

    // Hiển thị phần nội dung tương ứng
    const btn = button.getAttribute("data-view");
    document.querySelector(`.${btn}`).style.display = "block";
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
