<link rel="stylesheet" href="Frontend/Css/reset.css?ver=2">
<link rel="stylesheet" href="Frontend/Css/grid.css?ver=3">
<?php
session_start();

require_once("config.php");
require_once("./Backend/controller/client/client.php");
require_once("./Backend/controller/admin/admin.php");

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
        $urlPath === "{$basePath}/category" => fn() => require_once FRONTEND__CLIENT . "category.php",
        // 
        //  
        $urlPath === "{$basePath}/product" => fn() => $Client->detail("detail"),
        $urlPath === "{$basePath}/cart" && $_GET['id']  => fn() => $Client->dodulieuraCart(),
        $urlPath === "{$basePath}/event" => fn() => require_once FRONTEND__CLIENT . "event.php",
        $urlPath === "{$basePath}/history" => fn() => require_once FRONTEND__CLIENT . "history.php",
        $urlPath === "{$basePath}/pay" => fn() => require_once FRONTEND__CLIENT . "pay.php",


        // Kiểm tra query string với $_GET
        $urlPath === "{$basePath}/search" && $_GET['sr']  => fn() => $Client->search(),
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "login" => fn() => require_once FRONTEND__CLIENT . "login.php",
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "register" => fn() => require_once FRONTEND__CLIENT . "register.php",
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "dangki" => fn() => $Client->register(),
        $urlPath === "{$basePath}/auth" && $_GET['action'] === "dangnhap" => fn() => $Client->login(),
        $urlPath === "{$basePath}/logout" => fn() => $Client->logout(),
        default => fn() => print("Client page not found!"),
    };
}

// Execute the matched callback. thêm điều hướng cho danhmucj
$page();
