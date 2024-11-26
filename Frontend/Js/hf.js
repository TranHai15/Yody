const itemMenu = document.querySelectorAll(".menu-item-hover.has-submenu");
const overlay = document.querySelector(".overlay");

itemMenu.forEach((item) => {
  item.addEventListener("mouseover", function () {
    overlay.style.display = "block"; // Hiển thị overlay khi có submenu
    // item.classList.add("overflow"); // Thêm class overflow
  });

  item.addEventListener("mouseout", function () {
    overlay.style.display = "none"; // Ẩn overlay khi không hover
    // item.classList.remove("overflow"); // Bỏ class overflow
  });
});

// Search
const search = document.querySelector(".header__search--input");

// fame search
const searchButton = document.querySelector(".header__search--input");
const fameSearch = document.querySelector(".fame__search");
const closeButton = document.querySelector(".fame__close");

// Hiện menu tìm kiếm khi nhấn vào nút tìm kiếm và focus vào input
searchButton.addEventListener("click", function () {
  fameSearch.style.display = "block"; // Hiện menu tìm kiếm
  overlay.style.display = "block"; // Hiện overlay
  search.focus(); // Focus vào input tìm kiếm
});

// Ẩn menu tìm kiếm khi nhấn vào nút đóng
closeButton.addEventListener("click", function () {
  fameSearch.style.display = "none"; // Ẩn menu tìm kiếm
  overlay.style.display = "none"; // Ẩn overlay
});

// user
var check = false;
const user = document.querySelector(".if_login_ok");
const userInfoDropdown = document.querySelector(".user-info-dropdown");
user.addEventListener("click", () => {
  if (!check) {
    userInfoDropdown.style.display = "block";
    overlay.style.display = "block";
    check = true;
  } else {
    userInfoDropdown.style.display = "none";
    overlay.style.display = "none";
    check = false;
  }
});

// Ẩn menu tìm kiếm khi nhấn ra ngoài
overlay.addEventListener("click", function () {
  fameSearch.style.display = "none"; // Ẩn menu tìm kiếm
  overlay.style.display = "none"; // Ẩn overlay
  userInfoDropdown.style.display = "none";
});

const soluong = localStorage.getItem("cartNumber");
if (soluong) {
  document.querySelector(".soluongCart").style.display = "block";
  console.log(soluong);
  const aa = (document.querySelector(".numberCart").innerText = soluong);
  console.log(aa);
}
