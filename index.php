<link rel="stylesheet" href="Frontend/Css/reset.css?ver=2">
<link rel="stylesheet" href="Frontend/Css/grid.css?ver=3">
<?php
require_once("config.php");
require_once("./Backend/controller/client/client.php");

// Lấy đường dẫn URI và tham số query
$basePath = P;
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query = $_SERVER['QUERY_STRING'] ?? '';

// Khởi tạo controller
$Client = new Controller_Client;
$Client->Header("header");

// Điều hướng URL dựa trên match
$page = match (true) {
    $urlPath === "{$basePath}/" => fn() => $Client->List("Home"),
    $urlPath === "{$basePath}/category" => fn() => require_once FRONTEND__VIEW . "category.php",
    $urlPath === "{$basePath}/detail" => fn() => $Client->detail("detail"),
    $urlPath === "{$basePath}/cart" => fn() => require_once FRONTEND__VIEW . "cart.php",
    $urlPath === "{$basePath}/event" => fn() => require_once FRONTEND__VIEW . "event.php",
    $urlPath === "{$basePath}/history" => fn() => require_once FRONTEND__VIEW . "history.php",
    $urlPath === "{$basePath}/pay" => fn() => require_once FRONTEND__VIEW . "pay.php",
    $urlPath === "{$basePath}/auth" && $query === "login" => fn() => require_once FRONTEND__VIEW . "login.php",
    $urlPath === "{$basePath}/auth" && $query === "register" => fn() => require_once FRONTEND__VIEW . "register.php",
    default => fn() => print("Page not found!"),
};

// Thực thi callback tương ứng
$page();
?>