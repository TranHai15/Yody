// Lấy phần tử select
const addressSelect = document.getElementById("address");

// Thêm sự kiện "change" vào phần tử select
addressSelect.addEventListener("change", function () {
  // Lấy giá trị value của tùy chọn được chọn
  const selectedValue = this.value;
  form2Html(selectedValue);
});

const form2Html = (id) => {
  fetch(`Backend/controller/client/clientAjax.php?form2=${id}`)
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
        // console.log(data.data);
        renderViewForm2(data.data);
      } else {
        showNotification(data.message, data.status);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
};
const form3Html = (id) => {
  fetch(`Backend/controller/client/clientAjax.php?form3=${id}`)
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
        console.log(data.data);
        renderViewForm3(data.data);
      } else {
        showNotification(data.message, data.status);
      }
    })
    .catch((error) => {
      console.error("Error connecting to server:", error);
    });
};

// Hàm render dữ liệu vào select và thêm sự kiện change
const renderViewForm2 = (data) => {
  console.log(data);
  if (data.length === 0) {
    console.error("Dữ liệu không hợp lệ");
    return;
  }

  // Tạo thẻ select
  const select = document.createElement("select");
  select.id = "dynamic-select";
  select.classList.add("checkout__address-select");

  // Thêm các tùy chọn vào select
  data.forEach((item) => {
    if (item.district_id && item.name) {
      // Kiểm tra xem item có đủ id và name không
      const option = document.createElement("option");
      option.value = item.district_id;
      option.textContent = item.name;
      select.appendChild(option);
    }
  });

  // Thêm sự kiện "change" vào select
  select.addEventListener("change", function () {
    console.log(this.value);
    form3Html(this.value);
  });

  const container = document.querySelector(".form2");
  container.style.display = "block";
  container.appendChild(select);
};
const renderViewForm3 = (data) => {
  console.log(data);
  if (data.length === 0) {
    console.error("Dữ liệu không hợp lệ");
    return;
  }

  // Tạo thẻ select
  const select = document.createElement("select");
  select.id = "dynamic-select";
  select.classList.add("checkout__address-select");

  // Thêm các tùy chọn vào select
  data.forEach((item) => {
    if (item.wards_id && item.name) {
      const option = document.createElement("option");
      option.value = item.wards_id;
      option.textContent = item.name;
      select.appendChild(option);
    }
  });

  // Thêm sự kiện "change" vào select
  select.addEventListener("change", function () {
    // alert(`ID bạn đã chọn là: ${this.value}`);
    console.log(this.value);
  });

  const container = document.querySelector(".form3");
  container.style.display = "block";
  container.appendChild(select);
};
// Gọi hàm render với dữ liệu mẫu

document
  .querySelector(".checkout__pay-cod")
  .addEventListener("click", function (e) {
    e.preventDefault();

    // Lấy các giá trị từ biểu mẫu
    const name = document.querySelector(
      ".checkout__receiver-form input[placeholder='Tên khách hàng']"
    );
    const phone = document.querySelector(
      ".checkout__receiver-form input[placeholder='Số điện thoại']"
    );
    const address = document.querySelector(".checkout__address-home");

    let isValid = true;

    // Hàm hiển thị lỗi
    function showError(input, message) {
      const errorSpan = input.nextElementSibling; // Thẻ span kế tiếp
      if (errorSpan && errorSpan.classList.contains("error-message")) {
        errorSpan.textContent = message; // Cập nhật nội dung lỗi
      } else {
        const span = document.createElement("span");
        span.className = "error-message";
        span.style.color = "red";
        span.style.fontSize = "12px";
        span.textContent = message;
        input.parentElement.appendChild(span); // Thêm thẻ span vào DOM
      }
      isValid = false;
    }

    // Hàm xóa lỗi
    function clearError(input) {
      const errorSpan = input.nextElementSibling;
      if (errorSpan && errorSpan.classList.contains("error-message")) {
        errorSpan.remove(); // Xóa thẻ span lỗi
      }
    }

    // Kiểm tra tên
    if (name.value.trim() === "") {
      showError(name, "Tên không được để trống.");
    } else {
      clearError(name);
    }

    // Kiểm tra số điện thoại
    const phoneRegex = /^0\d{9}$/;
    if (!phoneRegex.test(phone.value.trim())) {
      showError(phone, "Số điện thoại không hợp lệ. Ví dụ: 0123456789");
    } else {
      clearError(phone);
    }

    // Kiểm tra địa chỉ
    if (address.value.trim() === "") {
      showError(address, "Địa chỉ không được để trống.");
    } else {
      clearError(address);
    }

    // Nếu hợp lệ, xử lý tiếp
    if (isValid) {
      window.location.href = "/Yody/message";
    }
  });
