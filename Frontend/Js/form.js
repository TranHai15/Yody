// Các hàm kiểm tra điều kiện
function isNotEmpty(input) {
  return input.trim() !== "";
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isLongerThan6Chars(input) {
  return input.length > 6;
}

// Hàm kiểm tra và hiển thị lỗi
function validateInput(fieldId) {
  const field = document.querySelector(`#${fieldId}`);
  const errorContainer = document.querySelector(`#error__${fieldId}`);

  let errorMessage = "";

  if (fieldId === "userName") {
    if (!isNotEmpty(field.value)) {
      errorMessage = "Tên không được để trống.";
    } else if (!isLongerThan6Chars(field.value)) {
      errorMessage = "Tên phải dài hơn 6 ký tự.";
    }
  } else if (fieldId === "email") {
    if (!isLongerThan6Chars(field.value)) {
      errorMessage = "Email không được để trống.";
    } else if (!isValidEmail(field.value)) {
      errorMessage = "Email không hợp lệ.";
    }
  } else if (fieldId === "password") {
    if (!isNotEmpty(field.value)) {
      errorMessage = "Mật khẩu không được để trống.";
    } else if (!isLongerThan6Chars(field.value)) {
      errorMessage = "Mật khẩu phải dài hơn 6 ký tự.";
    }
  }

  // Cập nhật thông báo lỗi và viền đỏ
  if (errorMessage) {
    errorContainer.textContent = errorMessage;
    field.classList.add("error");
  } else {
    errorContainer.textContent = "";
    field.classList.remove("error");
  }

  return errorMessage === ""; // Trả về true nếu không có lỗi
}

// Hàm xóa lỗi khi người dùng bấm vào ô input
function clearError(fieldId) {
  const field = document.querySelector(`#${fieldId}`);
  const errorContainer = document.querySelector(`#error__${fieldId}`);

  errorContainer.textContent = ""; // Xóa thông báo lỗi
  field.classList.remove("error"); // Xóa viền đỏ
}

// Hàm validate tổng hợp khi submit
function validate__register() {
  const isUserNameValid = validateInput("userName");
  const isEmailValid = validateInput("email");
  const isPasswordValid = validateInput("password");

  return isUserNameValid && isEmailValid && isPasswordValid;
}

function validate__login() {
  const isEmailValid = validateInput("email");
  const isPasswordValid = validateInput("password");
  return isEmailValid && isPasswordValid;
}
