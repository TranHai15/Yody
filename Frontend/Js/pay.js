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
    document.getElementById("district").value = this.value;
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
    document.getElementById("ward").value = this.value;
  });

  const container = document.querySelector(".form3");
  container.style.display = "block";
  container.appendChild(select);
};
// Gọi hàm render với dữ liệu mẫu
document.querySelector(".checkout").addEventListener("submit", function (e) {
  let isValid = true;
  document.getElementById("sumPrice").value = document
    .querySelector(".thanhtoan")
    .getAttribute("data-sumPrice");
  // Validate tên khách hàng
  const nameInput = document.querySelector('[name="customer_name"]');
  if (!validateName(nameInput)) isValid = false;

  // Validate số điện thoại
  const phoneInput = document.querySelector('[name="phone_number"]');
  if (!validatePhone(phoneInput)) isValid = false;

  // Validate Tỉnh/Thành phố
  const provinceSelect = document.querySelector('[name="province_id"]');
  if (!validateProvince(provinceSelect)) isValid = false;

  // Validate Địa chỉ chi tiết
  const streetInput = document.querySelector('[name="street_address"]');
  if (!validateStreet(streetInput)) isValid = false;

  // Nếu có lỗi, ngăn không cho gửi form
  if (!isValid) {
    e.preventDefault();
  }
});

// Gán sự kiện onblur cho từng input
document
  .querySelector('[name="customer_name"]')
  .addEventListener("blur", function () {
    validateName(this);
  });

document
  .querySelector('[name="phone_number"]')
  .addEventListener("blur", function () {
    validatePhone(this);
  });

document
  .querySelector('[name="province_id"]')
  .addEventListener("blur", function () {
    validateProvince(this);
  });

document
  .querySelector('[name="street_address"]')
  .addEventListener("blur", function () {
    validateStreet(this);
  });

// Các hàm validate
function validateName(input) {
  if (input.value.trim() === "") {
    displayError(input, "Tên khách hàng không được để trống");
    return false;
  } else {
    clearError(input);
    return true;
  }
}

function validatePhone(input) {
  const phonePattern = /^[0-9]{10,11}$/;
  if (!phonePattern.test(input.value.trim())) {
    displayError(input, "Số điện thoại không hợp lệ (10-11 chữ số)");
    return false;
  } else {
    clearError(input);
    return true;
  }
}

function validateProvince(input) {
  if (!input.value) {
    displayError(input, "Vui lòng chọn Tỉnh/Thành phố");
    return false;
  } else {
    clearError(input);
    return true;
  }
}

function validateStreet(input) {
  if (input.value.trim() === "") {
    displayError(input, "Vui lòng nhập địa chỉ chi tiết");
    return false;
  } else {
    clearError(input);
    return true;
  }
}

// Hiển thị lỗi
function displayError(input, message) {
  const errorSpan = input.nextElementSibling;
  if (errorSpan && errorSpan.classList.contains("error-message")) {
    errorSpan.textContent = message;
    input.classList.add("invalid");
  }
}

// Xóa lỗi
function clearError(input) {
  const errorSpan = input.nextElementSibling;
  if (errorSpan && errorSpan.classList.contains("error-message")) {
    errorSpan.textContent = "";
    input.classList.remove("invalid");
  }
}

const phuongthuc = document.querySelector(".checkout__paymentMethod-input-2");
