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

// Hàm cập nhật số lượng
function updateSoLuongChon(change) {
  const soluongchonElement = document.getElementById("soluongchon");
  const decreaseButton = document.getElementById("decrease");

  // Cập nhật số lượng (không cho phép số lượng nhỏ hơn 1)
  soluongchon = Math.max(1, soluongchon + change);

  // Hiển thị số lượng mới
  soluongchonElement.textContent = soluongchon;

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

//*********************************************** */
document.querySelector(".add__cart").addEventListener("click", () => {
  // alert(soluongchon);
  const detail = document.querySelector(".detail");
  const productId = detail.getAttribute("data-productId");
  const variationId = detail.getAttribute("data-variationId");
  const name = detail.getAttribute("data-name");
  const productCode = detail.getAttribute("data-productCode");
  const variationCode = detail.getAttribute("data-variationCode");
  const user_id = detail.getAttribute("data-userId");
  // alert(user_id);
  //Lấy ra giá sale
  const detail_price = document.querySelector(".detail__right--price--old");
  const sale = detail_price.getAttribute("data-price");
  // alert(getSizeValue);
  // alert(sale);
  const tonggia = sale * soluongchon;
  console.log(tonggia);

  const formatTongGia = new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(tonggia);

  // alert(formatTongGia);
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
        alert(data.message); // Cập nhật thành công
      } else {
        alert(data.message); // Cập nhật thất bại
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
});
