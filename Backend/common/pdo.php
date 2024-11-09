<!-- kết nối database -->
<?php
require_once("config.php");
function Connect()
{
    try {
        $conn =  new PDO("mysql:host=" . _HOST . "; dbname=" . _DB . "; port=" . _PORT . "; charset=utf8;", _USER, _PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Ket NOi Thanh cong <br>";
        return $conn;
    } catch (PDOException $th) {
        echo "Ket NOi That Bai <br>";
        $th->getMessage();
        die;
    }
}
