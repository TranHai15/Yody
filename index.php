<link rel="stylesheet" href="Frontend/Css/reset.css?ver=2">
<link rel="stylesheet" href="Frontend/Css/grid.css?ver=3">
<?php
require_once("config.php");
require_once("./Backend/controller/client/client.php");
require_once("./Backend/controller/admin/admin.php");

// Lấy đường dẫn URI và tham số query
$basePath = P;
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query = $_SERVER['QUERY_STRING'] ?? '';

// Khởi tạo controller
$Admin =  new Controller__Admin;
$Client = new Controller_Client;
// $Client->Header("header");

// Điều hướng URL dựa trên match
$page = match (true) {
    $urlPath === "{$basePath}/" => fn() => $Client->List("Home"),
    $urlPath === "{$basePath}/category" => fn() => require_once FRONTEND__CLIENT . "category.php",
    $urlPath === "{$basePath}/detail" => fn() => $Client->detail("detail"),
    $urlPath === "{$basePath}/cart" => fn() => require_once FRONTEND__CLIENT . "cart.php",
    $urlPath === "{$basePath}/event" => fn() => require_once FRONTEND__CLIENT . "event.php",
    $urlPath === "{$basePath}/history" => fn() => require_once FRONTEND__CLIENT . "history.php",
    $urlPath === "{$basePath}/pay" => fn() => require_once FRONTEND__CLIENT . "pay.php",
    $urlPath === "{$basePath}/auth" && $query === "login" => fn() => require_once FRONTEND__CLIENT . "login.php",
    $urlPath === "{$basePath}/auth" && $query === "register" => fn() => require_once FRONTEND__CLIENT . "register.php",

    // ==================================================================================================
    // Admin
    // ==================================================================================================
    $urlPath === "{$basePath}/adminIndex" => fn() => $Admin->List("index"),
    $urlPath === "{$basePath}/adminAccount" => fn() => $Admin->List("account"),
    $urlPath === "{$basePath}/adminCategory" => fn() => $Admin->List("category"),
    $urlPath === "{$basePath}/adminComment" => fn() => $Admin->List("comment"),
    $urlPath === "{$basePath}/adminEditProduct" => fn() => $Admin->List("EditProducts"),
    $urlPath === "{$basePath}/adminListProducts" => fn() => $Admin->List("ListProducts"),
    $urlPath === "{$basePath}/adminAddProduct" => fn() => $Admin->List("addProducts"),
    $urlPath === "{$basePath}/adminAddCategory" => fn() => $Admin->List("addCategory"),
    $urlPath === "{$basePath}/adminMain" => fn() => $Admin->List("main"),

    default => fn() => print("Page not found!"),
};

// Thực thi callback tương ứng
$page();
?>