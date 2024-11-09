<link rel="stylesheet" href="Frontend/Css/reset.css?ver=2">
<link rel="stylesheet" href="Frontend/Css/grid.css?ver=3">
<?php

require_once("./config.php");
require_once("Backend/common/pdo.php");
Connect();
$url = $_GET['clt'] ?? "";

switch ($url) {
    case "/":
        require_once FRONTEND . "Home.php";
        break;
    case "":
        require_once FRONTEND . "Home.php";
        break;
    case "category":
        require_once FRONTEND . "category.php";
        break;
    case "detail":
        require_once FRONTEND . "detail.php";
        break;
    case "cart":
        require_once FRONTEND . "cart.php";
        break;
    case "event":
        require_once FRONTEND . "event.php";
        break;
    case "history":
        require_once FRONTEND . "history.php";
        break;
    case "pay":
        require_once FRONTEND . "pay.php";
        break;
    case "auth":
        if (isset($_GET["clt"]) && $_GET["action"] == "login") {
            require_once FRONTEND . "login.php";
        } else if (isset($_GET["clt"]) && $_GET["action"] == "register") {
            require_once FRONTEND . "register.php";
        }
        break;
    case "header":
        require_once "./Frontend/component/client/footer.php";
        break;
    default:
        echo "Page not found!";
        break;
}
