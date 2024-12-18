<link rel="stylesheet" href="Frontend/Css/reset.css?ver=2">
<link rel="stylesheet" href="Frontend/Css/grid.css?ver=3">
<link rel="stylesheet" href="Frontend/Css/hf.css">
<?php
session_start();
require_once("./Backend/common/sendMail.php");

require_once("config.php");
require_once('./Backend/common/function.php');
require_once("./Backend/controller/client/client.php");
require_once("./Backend/controller/admin/admin.php");


// sendMail('thangle12112005@gmail.com', 'HẢi gửi ', 'test quen mat khau');
// Get URI path
$basePath = P;
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Initialize controllers
$Admin = new Controller__Admin;
$Client = new Controller_Client;

// Check if the path is for admin or client
if (strpos($urlPath, "{$basePath}/admin") === 0) {
    // Admin routes using match
    $page = match (true) {
        $urlPath === "{$basePath}/admin" => fn() => $Admin->List("role"),
        default => fn() => print("Admin page not found!"),
    };
} else {
    // Client routes using match
    $Client->Header("header");
    $page = match (true) {
        $urlPath === "{$basePath}/" => fn() => $Client->List("Home"),
        $urlPath === "{$basePath}/category" && $_GET['id'] => fn() => $Client->locCategory(),
        // 
        //  
        $urlPath === "{$basePath}/product" => fn() => $Client->detail("detail"),
        $urlPath === "{$basePath}/cart" && $_GET['id']  => fn() => $Client->dodulieuraCart(),
        $urlPath === "{$basePath}/pay" && $_GET['id']  => fn() => $Client->dodulieuraPay('pay'),
        $urlPath === "{$basePath}/event" && $_GET['name']  => fn() => $Client->goiEvent('event'),
        $urlPath === "{$basePath}/history" => fn() => $Client->getOrder(),
        $urlPath === "{$basePath}/pay" => fn() => require_once FRONTEND__CLIENT . "pay.php",
        $urlPath === "{$basePath}/form" => fn() => require_once FRONTEND__CLIENT . "form.php",
        $urlPath === "{$basePath}/formProductView" => fn() => $Client->productView(),
        $urlPath === "{$basePath}/message" => fn() => require_once FRONTEND__CLIENT . "message.php",
        $urlPath === "{$basePath}/thank" => fn() => require_once FRONTEND__CLIENT . "thank.php",
        $urlPath === "{$basePath}/forgot" => fn() => require_once FRONTEND__CLIENT . "forgot.php",
        // $urlPath === "{$basePath}/change" => fn() => $Client->change(),
        $urlPath === "{$basePath}/order" => fn() => $Client->order(),
        $urlPath === "{$basePath}/itemOrder" => fn() => $Client->itemOrder(),



        // Kiểm tra query string với $_GET
        $urlPath === "{$basePath}/search" && $_GET['sr']  => fn() => $Client->search(),
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "login" => fn() => require_once FRONTEND__CLIENT . "login.php",
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "register" => fn() => require_once FRONTEND__CLIENT . "register.php",
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "dangki" => fn() => $Client->register(),
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "dangnhap" => fn() => $Client->login(),
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "forgot" => fn() => $Client->forgot(),
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "change" => fn() => $Client->change(),
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "reset_password" => fn() => $Client->reset_password(),
        $urlPath === "{$basePath}/logout" => fn() => $Client->logout(),
            // $urlPath === "{$basePath}/reset_password" => fn() => $Client->reset_password(),
        default => fn() => print("Client page not found!"),
    };
}

// Execute the matched callback. thêm điều hướng cho danhmucj
$page();
