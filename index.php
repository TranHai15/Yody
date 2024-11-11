<link rel="stylesheet" href="Frontend/Css/reset.css?ver=2">
<link rel="stylesheet" href="Frontend/Css/grid.css?ver=3">

<?php

require_once("config.php");

require_once("./Backend/controller/client/client.php");

$url = $_GET['clt'] ?? "/";
$Client = new Controller_Client;
$Client->Header("header");
switch ($url) {
    case "/":
        $Client->List("Home");
        break;
    case "category":
        require_once FRONTEND__VIEW . "category.php";
        break;
    case "detail":
        $Client->detail("detail");
        break;
    case "cart":
        require_once FRONTEND__VIEW . "cart.php";
        break;
    case "event":
        require_once FRONTEND__VIEW . "event.php";
        break;
    case "history":
        require_once FRONTEND__VIEW . "history.php";
        break;
    case "pay":
        require_once FRONTEND__VIEW . "pay.php";
        break;
    case "auth":
        if (isset($_GET["clt"]) && $_GET["action"] == "login") {
            require_once FRONTEND__VIEW . "login.php";
        } else if (isset($_GET["clt"]) && $_GET["action"] == "register") {
            require_once FRONTEND__VIEW . "register.php";
        }
        break;
    default:
        echo "Page not found!";
        break;
}
