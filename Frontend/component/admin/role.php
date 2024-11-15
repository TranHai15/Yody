<?php

$check = $_SESSION['role'] ?? "";

if ($check === 1) {
    require_once("Frontend/component/admin/index.php");
    exit;
} else {

    require_once("Frontend/component/client/views/login.php");
}
