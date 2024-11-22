document.querySelectorAll(".color-option, .size-option").forEach((element) => {
  element.addEventListener("click", () => {
    // Kiểm tra xem phần tử được nhấn là color hay size
    const isColor = element.classList.contains("color-option");

    // Cập nhật trạng thái 'selected' cho phần tử chọn
    const options = document.querySelectorAll(
      isColor ? ".color-option" : ".size-option"
    );
    options.forEach((el) =>
      el.classList.remove(isColor ? "selected" : "active__size")
    );
    element.classList.add(isColor ? "selected" : "active__size");

    // Lấy giá trị cần thiết
    const dataVariationId = document
      .querySelector(".color-option.selected")
      .getAttribute("data-colorId"); // Thay thế 'data-variationId'
    const dataSizeId = document
      .querySelector(".size-option.active__size")
      .getAttribute("data-sizeId");
    const dataProductId = document
      .querySelector(".detail")
      .getAttribute("data-productId");

    // Cập nhật URL mà không tải lại trang
    const newUrl = `http://localhost/duan1/detail?product=${dataProductId}&color=${dataVariationId}&size=${dataSizeId}`;
    history.pushState(null, "", newUrl); // Cập nhật URL

    // Fetch dữ liệu mới từ server
    fetch(
      `http://localhost/duan1/Backend/controller/client/clientAjax.php?product=${dataProductId}&color=${dataVariationId}`
    )
      .then((res) => {
        if (!res.ok) {
          throw new Error(`Fetch error: ${res.status}`);
        }
        return res.json();
      })
      .then((data) => {
        console.log("Updated data:", data);

        // Cập nhật HTML dựa trên dữ liệu mới
        // Cập nhật màu sắc
        document.querySelector(".value__color").innerText = data.color;

        // Cập nhật kích thước
        document.querySelector(".value__size").innerText = data.size;

        // Cập nhật giá mới
        document.querySelector(
          ".detail__right--price--new"
        ).innerText = `${data.price} đ`;

        // Cập nhật giá cũ nếu có
        document.querySelector(".detail__right--price--old").innerText =
          data.old_price ? `${data.old_price} đ` : "";

        // Cập nhật hình ảnh sản phẩm
        document
          .querySelector(".detail__right--img img")
          .setAttribute("src", data.image);

        // Cập nhật tên và mã sản phẩm
        document.querySelector(".detail__right--name").innerText =
          data.productName;
        document.querySelector(".detail__right-code .value__color").innerText =
          data.variationCode;
        document.querySelector(".value__size").innerText = data.size;
      })
      .catch((error) => {
        console.error("Error connecting to server:", error);
      });
  });
});
