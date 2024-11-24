<?php
header('Content-Type: application/json');
require_once("../../../config.php");
require_once("../../../Backend/common/pdo.php");
require_once("../../../Backend/common/function.php");
require_once("../../model/admin/admin.php");
require_once("../../model/client/client.php");


if ($_GET['addcart']) {

    $userId = $_GET['addcart'];
    $variationId = $_GET['variationId'];
    $sizeId = $_GET['sizeId'];
    $quantity = $_GET['quantity'];
    $price = $_GET['price'];

    $dateTime = (new DateTime())->format('Y-m-d H:i:s'); // Định dạng Năm-Tháng-Ngày Giờ:Phút:Giây
    // echo $dateTime; // Ví dụ: 2024-11-23 14:45:30
    // checkloi($dateTime);
    $gioHang = new Model_Client;

    $sql = "SELECT * FROM carts WHERE userId=$userId";
    $number_col = getRows($sql);
    // checkloi($number_col);
    if ($number_col === 1) {
        $cart = $gioHang->layCartIdByUserID($userId);
        // $idcart = $cart['cartId'];
        // checkloi($cart);
        $cartid = $cart['cartId'];

        // checkloi($cartid);
        $dataOnDb = $gioHang->getCartId($cartid);
        // checkloi($dataOnDb);
        foreach ($dataOnDb as $key => $value) {
            // echo $value['variationId'] . "<br>";
            if ($value['variationId'] == $variationId) {
                if ($value['sizeId'] == $sizeId) {
                    $quantity = $quantity + $value['quantity'];
                    $price = $price + $value['price'];
                    $data_new = [
                        'cartId' => $cartid,
                        'variationId' => $variationId,
                        'sizeId' => $sizeId,
                        'quantity' => $quantity,
                        'price' => $price
                    ];
                    checkloi($data_new);
                    $dk = 'cartitemId=' . $value['cartitemId'];
                    $kq = $gioHang->updateCartItem('cartitems', $data_new, $dk);
                    // checkloi($kq);
                }
            }
        }

        $data = [
            'cartId' => $cartid,
            'variationId' => $variationId,
            'sizeId' => $sizeId,
            'quantity' => $quantity,
            'price' => $price
        ];
        $kq = $gioHang->cartItem('cartitems', $data);
        // checkloi($kq);
    } else {

        $data = [
            'userId' => $userId,
            'createAt' => $dateTime
        ];
        $kq = $gioHang->carts('carts', $data);
        // checkloi($kq);/
        if ($kq) {
            $cart = $gioHang->layCartIdByUserID($userId);
            $cartid = $cart['cartId'];

            // checkloi($cartid);
            // $cart['cartId'];
            // checkloi($cart);
            $data = [
                'cartId' => $cartid,
                'variationId' => $variationId,
                'sizeId' => $sizeId,
                'quantity' => $quantity,
                'price' => $price
            ];
            $kq = $gioHang->cartItem('cartitems', $data);
            // checkloi($kq);




        } else {
            echo " Khong them dc di ";
        }
        // var_dump($kq);
    }
}
