//********************************Xử lý ảnh khi click vào sẽ lấy ảnh ra img_main********************************************8
document.querySelectorAll(".detail__left--item img").forEach((thumbnail) => {
  thumbnail.addEventListener("click", (event) => {
    // Lấy ảnh lớn
    const bigImage = document.querySelector(".detail__right--img img");

    // Lấy src của ảnh con
    const thumbnailSrc = event.target.getAttribute("src");

    // Cập nhật src của ảnh lớn
    bigImage.setAttribute("src", thumbnailSrc);

    // Thêm hiệu ứng cho ảnh được chọn (nếu cần)
    document.querySelectorAll(".detail__left--item").forEach((item) => {
      item.classList.remove("active--detail__left--item");
    });
    event.target.parentElement.classList.add("active--detail__left--item");
  });
});

//**********************************************Su ly so luong*************************************************************
let soluongchon = 1; // Giá trị mặc định ban đầu

let getNumberSanpham = document
  .querySelector(".size-option")
  .getAttribute("data-quantity");

// Hàm cập nhật số lượng
function updateSoLuongChon(change) {
  const soluongchonElement = document.getElementById("soluongchon");
  const decreaseButton = document.getElementById("decrease");

  if (soluongchon > getNumberSanpham) {
    // Cập nhật số lượng (không cho phép số lượng nhỏ hơn 1)
    soluongchon = Math.max(1, soluongchon + change);

    // Hiển thị số lượng mới
    soluongchonElement.textContent = soluongchon;
  } else {
    alert("het hang");
  }

  // Kiểm tra và cập nhật trạng thái của nút giảm
  if (soluongchon === 1) {
    decreaseButton.classList.add("disabled");
  } else {
    decreaseButton.classList.remove("disabled");
  }
}
let getSizeValue = document
  .querySelector(".size-option")
  .getAttribute("data-sizeId");

document.addEventListener("DOMContentLoaded", () => {
  const sizeOptions = document.querySelectorAll(".size-option");
  const sizeValue = document.querySelector(".value__size");
  const sizeCodeSpan = document.querySelector(
    ".detail__right-code .value__size"
  );
  const sizeLabelValue = document.querySelector(".size-label .size__value"); // Thêm dòng này

  sizeOptions.forEach((option) => {
    option.addEventListener("click", () => {
      // Lấy giá trị size và sizeId từ các thuộc tính data
      const sizeId = option.getAttribute("data-sizeId");
      const size = option.getAttribute("data-size");

      // Cập nhật giá trị size của kích thước
      sizeValue.innerText = size;
      if (sizeCodeSpan) {
        sizeCodeSpan.innerText = size;
      }
      if (sizeLabelValue) {
        sizeLabelValue.innerText = size; // Cập nhật .size__value
      }

      getSizeValue = sizeId;

      // Hiển thị hoặc xử lý size được chọn
      // console.log(`SizeId: ${sizeId}, Size: ${size}`);

      // Xử lý giao diện (thêm class active__size cho phần tử được chọn)
      sizeOptions.forEach((opt) => opt.classList.remove("active__size"));
      option.classList.add("active__size");
    });
  });
});

function showNotification(message, type = "success") {
  // Tạo phần tử thông báo
  const notification = document.createElement("section");
  notification.className = `notification ${type}`;
  notification.innerHTML = `
    <div>
      <p>${message}</p>
    </div>
  `;

  // Thêm thông báo vào body
  document.body.appendChild(notification);

  // Tự động xóa thông báo sau 5 giây
  setTimeout(() => {
    notification.style.opacity = "0"; // Hiệu ứng mờ dần
    setTimeout(() => notification.remove(), 500); // Xóa phần tử sau hiệu ứng
  }, 5000);
}

//*********************************************** */
document.querySelector(".add__cart").addEventListener("click", () => {
  // alert(soluongchon);
  const detail = document.querySelector(".detail");
  const productId = detail.getAttribute("data-productId");
  const variationId = detail.getAttribute("data-variationId");
  const name = detail.getAttribute("data-name");
  const productCode = detail.getAttribute("data-productCode");
  const variationCode = detail.getAttribute("data-variationCode");
  let user_id = detail.getAttribute("data-userId");
  //Lấy ra giá sale
  const detail_price = document.querySelector(".detail__right--price--new");
  const sale = detail_price.getAttribute("data-price");
  // alert(getSizeValue);
  alert(sale);
  const tonggia = sale;
  // console.log(tonggia);
  // alert(user_id);
  const formatTongGia = new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(tonggia);

  if (!user_id) {
    // let cart = JSON.parse(localStorage.getItem("cart"));
    // let id = new Date.now() / 1000;
    // localStorage.setItem("idvodanh", id);
    // if (!cart) {
    //   cart = [];
    // }

    // // Dữ liệu sản phẩm bạn đang xử lý
    // const productData = {
    //   productId: productId,
    //   variationId: variationId,
    //   tonggia: tonggia, // Giá sản phẩm
    //   soluong: soluongchon, // Số lượng người dùng chọn
    //   sizeId: getSizeValue, // Size của sản phẩm
    // };

    // // Kiểm tra nếu sản phẩm đã có trong giỏ hàng, nếu có thì cập nhật số lượng
    // const existingProductIndex = cart.findIndex(
    //   (item) =>
    //     item.productId === productData.productId &&
    //     item.variationId === productData.variationId &&
    //     item.sizeId === productData.sizeId
    // );

    // if (existingProductIndex !== -1) {
    //   // Cập nhật số lượng của sản phẩm đã có trong giỏ hàng
    //   cart[existingProductIndex].soluong += productData.soluong;
    // } else {
    //   // Thêm sản phẩm mới vào giỏ hàng
    //   cart.push(productData);
    // }

    // // Lưu giỏ hàng vào localStorage sau khi cập nhật
    // localStorage.setItem("cart", JSON.stringify(cart));

    // console.log(cart);
    // // Hiển thị thông báo thêm thành công

    alert("Sản phẩm đã được thêm vào giỏ hàng!");
  } else {
    fetch(
      `Backend/controller/client/clientAjax.php?addcart=${user_id}&variationId=${variationId}&sizeId=${getSizeValue}&quantity=${soluongchon}&price=${tonggia}`
    )
      .then((res) => {
        if (!res.ok) {
          throw new Error(`Fetch error: ${res.status}`);
        }
        return res.json();
      })
      .then((data) => {
        console.log("Updated data:", data);
        // Hiển thị thông báo dựa trên phản hồi từ backend
        if (data.status === "success") {
          // alert(data.message); // Cập nhật thành công
          showNotification(data.message, data.status);
          getnumber(user_id);
        } else {
          showNotification(data.message, data.status);
        }
      })
      .catch((error) => {
        console.error("Error connecting to server:", error);
      });
  }
});

const getnumber = (id) => {
  fetch(`Backend/controller/client/clientAjax.php?soluong=${id}`)
    .then((res) => {
      if (!res.ok) {
        throw new Error(`Fetch error: ${res.status}`);
      }
      return res.json();
    })
    .then((data) => {
      console.log("Updated data:", data);
      // Hiển thị thông báo dựa trên phản hồi từ backend
      if (data.status === "success") {
        // alert(data.message); // Cập nhật thành công
        document.querySelector(".soluongCart").style.display = "block";
        const numberData = data.soluong;
        localStorage.setItem("cartNumber", numberData);
        const soluong = localStorage.getItem("cartNumber");
        document.querySelector(".numberCart").innerText = soluong;
        // console.log(numberData);
        // console.log(numberData.soluong);
      } else {
        showNotification(data.message, data.status);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
};
