<?php
header('Content-Type: application/json');
require_once("../../../config.php");
require_once("../../../Backend/common/pdo.php");
require_once("../../../Backend/common/function.php");
require_once("../../model/admin/admin.php");
require_once("../../model/client/client.php");


if ($_GET['addcart']) {

    $userId = (int)$_GET['addcart'];
    $variationId = (int)$_GET['variationId'];
    $sizeId = (int)$_GET['sizeId'];
    $quantity = (int)$_GET['quantity'];
    $price = (int)$_GET['price'];

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
        // checkloi($variationId);
        // checkloi($cartid);
        $dataOnDb = $gioHang->getCartId($cartid);
        // $dataOnDb['variationId'];

        // checkloi($dataOnDb);
        foreach ($dataOnDb as $key => $value) {
            $variationIdcheck = $value['variationId'];
            $sizeIdcheck = $value['sizeId'];
            // checkloi($variationIdcheck);
            // checkloi($sizeId);
            if ($variationIdcheck == $variationId) {
                if ($sizeIdcheck == $sizeId) {
                    // $test = "vaodayroi";
                    $quantity_new = $quantity + $value['quantity'];
                    $price_new = $price + $value['price'];
                    $data_new = [
                        'cartId' => $cartid,
                        'variationId' => $variationId,
                        'sizeId' => $sizeId,
                        'quantity' => $quantity_new,
                        'price' => $price_new
                    ];
                    // checkloi($data_new);
                    $dk = 'cartitemId=' . $value['cartitemId'];
                    $kq = $gioHang->updateCartItem('cartitems', $data_new, $dk);
                    // die;
                    if ($kq) {
                        // $data_cart = $gioHang->getCartItemsWithProductName($cartid);
                        // // Encode data to JSON
                        // $json_cart_data = json_encode($data_cart, JSON_UNESCAPED_UNICODE);
                        // header('Location: Yody/cart.php?data=' . urlencode($json_cart_data));
                        exit;
                    }
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
