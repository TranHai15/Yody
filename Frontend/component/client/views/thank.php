<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    h1 {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>
</head>

<body>


    <input type="hidden" name="" id="soluong" value="<?= getsession('sl')??'' ?>">
    <h1>Thanh Toán Thành Công</h1>
</body>
<!-- <script src="Frontend/Js/message.js"></script> -->
<SCript>
const soluonrtyertyg = document.getElementById("soluong").value;
console.log("soluong:", soluonrtyertyg);
localStorage.setItem("cartNumber", soluonrtyertyg);
document.querySelector(".numberCart").innerText = soluong;

setTimeout(() => {
    // console.log("aaa");
    // alert("chuyen trang");
    window.location.href = "/Yody/history";
}, 1000);
</SCript>

</html>