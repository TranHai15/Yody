// Object lưu trữ giá trị lọc
const btn__drop = document.querySelector(".dropbtn");
btn__drop.addEventListener("click", () => {
  const list__drop = document.querySelector(".dropdown__content");
  list__drop.classList.toggle("display__none");
  const icon__bottom = document.querySelector(".icon__bottom");
  const icon__top = document.querySelector(".icon__top");
  icon__top.classList.toggle("display__none");
  icon__bottom.classList.toggle("display__none");
});

//  const
const list__name = document.querySelectorAll(".list__name");
list__name.forEach((e) => {
  e.addEventListener("click", () => {
    const list__content__none = e.nextElementSibling;
    list__content__none.classList.toggle("display__none");
    // console.log(icon__bottom)
    // icon__bottom.classList.toggle("xoay")
  });
});

// Object lưu trữ giá trị lọc
let filterValues = {
  gender: [],
  colors: [],
  sizes: [],
  price: [],
};

// Hàm gửi dữ liệu lên server qua AJAX
function sendFilterValues() {
  fetch(`Backend/controller/client/clientAjax.php`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(filterValues),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data.kq); // Hiển thị kết quả trả về (danh sách sản phẩm)
      // displayResults(data); // Hàm render sản phẩm (cần tạo)
      // Gọi hàm render với dữ liệu JSON
      renderProducts(data.kq);
    })
    .catch((error) => console.error("Error:", error));
}

// Xử lý sự kiện khi chọn checkbox (giới tính, giá)
document
  .querySelectorAll('.checkbox-item input[type="checkbox"]')
  .forEach((checkbox) => {
    checkbox.addEventListener("change", (event) => {
      const { id, checked } = event.target;
      const category = event.target.closest(".list__sex")
        ? "gender"
        : event.target.closest(".list__price")
        ? "price"
        : null;

      if (category) {
        if (checked) {
          filterValues[category].push(id);
        } else {
          filterValues[category] = filterValues[category].filter(
            (item) => item !== id
          );
        }
      }

      // Gửi dữ liệu ngay sau khi thay đổi
      sendFilterValues();
    });
  });

// Xử lý sự kiện khi chọn màu sắc
document
  .querySelectorAll(".color-item .color-circle")
  .forEach((colorCircle) => {
    colorCircle.addEventListener("click", (event) => {
      const color = colorCircle.getAttribute("data-color");
      console.log(color);
      const index = filterValues.colors.indexOf(color);
      if (index > -1) {
        filterValues.colors.splice(index, 1); // Bỏ màu nếu đã chọn
      } else {
        filterValues.colors.push(color); // Thêm màu nếu chưa chọn
      }

      // Gửi dữ liệu ngay sau khi thay đổi
      sendFilterValues();
    });
  });

// Xử lý sự kiện khi chọn kích thước
document.querySelectorAll(".size-item .size-circle").forEach((sizeCircle) => {
  sizeCircle.addEventListener("click", (event) => {
    const size = event.target.textContent.trim();
    const index = filterValues.sizes.indexOf(size);
    if (index > -1) {
      filterValues.sizes.splice(index, 1); // Bỏ kích thước nếu đã chọn
    } else {
      filterValues.sizes.push(size); // Thêm kích thước nếu chưa chọn
    }

    // Gửi dữ liệu ngay sau khi thay đổi
    sendFilterValues();
  });
});

function replaceSpacesWithHyphen(str) {
  return str.replace(/\s+/g, "-");
}

// Container để render danh sách sản phẩm
const container = document.querySelector(".products");

// Hàm render sản phẩm
function renderProducts(products) {
  // Xóa nội dung cũ
  container.innerHTML = "";

  // Kiểm tra nếu không có sản phẩm
  console.log(products);
  if (products == undefined) {
    container.innerHTML = `
      <div class="no-products">
        <p>Không có sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.</p>
      </div>
    `;
    return;
  }

  // Nếu có sản phẩm, render danh sách
  products.forEach((product) => {
    const name = replaceSpacesWithHyphen(product.name);

    // Tính giá khuyến mãi nếu có
    const sale =
      product.old_price > 0
        ? product.new_price - product.new_price * (product.old_price / 100)
        : product.new_price;

    // Chuyển chuỗi variations thành đối tượng JSON
    const variations = JSON.parse(product.variations);

    // HTML từng sản phẩm
    const productHTML = `
      <article class="product l-3 m-4 c-12">
        <a href="/Yody/product?${name}&color=${product.colorId}">
          <div class="product__image">
            <img loading="lazy" src="${product.ImageMain}" alt="${
      product.name
    }" />
          </div>
          <span class="product__name">${product.name}</span>
          <div class="product__price row align-items-center">
            ${
              product.old_price > 0
                ? `<span class="price__new">${formatCurrency(
                    sale
                  )}</span><span class="price__old">${formatCurrency(
                    product.new_price
                  )}</span>`
                : `<span class="price__new">${formatCurrency(
                    product.new_price
                  )}</span>`
            }
            ${
              product.old_price > 0
                ? `<div class="product__logo--sale row align-items-center justify-content-center"><span>-${product.old_price}%</span></div>`
                : ""
            }
          </div>
          <div class="product__variation row align-items-center">
            ${variations
              .map(
                (variation) => `
              <a href="/Yody/product?${name}&color=${
                  variation.variationId
                }" data-images="${variation.image}">
                <span class="product__variation--item ${
                  variation.variationId === product.colorId
                    ? "active__product--variation"
                    : ""
                }" style="background-color: ${variation.anhColor}"></span>
              </a>
            `
              )
              .join("")}
          </div>
        </a>
      </article>
    `;

    // Gắn sản phẩm vào container
    container.innerHTML += productHTML;
  });
}

// Hàm định dạng giá tiền (VND)
function formatCurrency(value) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
    minimumFractionDigits: 0,
  }).format(value);
}
