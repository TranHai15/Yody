const soluonrtyertyg = document.getElementById("soluong").value;
console.log("soluong:", soluonrtyertyg);
localStorage.setItem("cartNumber", soluonrtyertyg);
document.querySelector(".numberCart").innerText = soluong;

setTimeout(() => {
  // console.log("aaa");
  // alert("chuyen trang");
  window.location.href = "/Yody/history";
}, 1000);
