<?php
header('Content-Type: application/json');
require_once("../../../config.php");
require_once("../../../Backend/common/pdo.php");
require_once("../../../Backend/common/function.php");
require_once("../../model/admin/admin.php");
require_once("../../model/client/client.php");

if (isPost()) {
    // $data = filter();
    $data = json_decode(file_get_contents("php://input"), true);
    // checkloi($data);
    if (isset($data['productId'])) {
        $cartItem = $data['productId'];
        $number = $data['currentQuantity'];
        $variationId = $data['variationId'];
        $sizeId = $data['sizeId'];
        $product__item = $data['product__item'];
        // checkloi(data: $sizeId);
        $data = [
            'quantity' => $number,
        ];
        $dk = 'cartitemId=' . $cartItem;
        // check so luong trong database
        $sql = "SELECT quantity From sizevariations WHERE sizeId=$sizeId AND variationId=$variationId ";

        $checknumberCart = getOne($sql);
        // checkloi($checknumberCart['quantity']);

        if ($checknumberCart['quantity'] > $number) {
            $kq = update('cartitems', $data, $dk);
            $data = (new Model_Client)->tongtienTrongtotal_price($product__item);
            if ($kq) {
                echo json_encode(array('status' => 'success', 'kq' => $kq, 'data' => $data));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'KHong có sản phẩm'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'San Pham het hang'));
        }
    } else {
        $cartId = $data[3]['cartId'];
        $cartitemId = $data[0]['cartitem'];
        $status = $data[1]['status'];
        $selected = $data[2]['selected'];
        if ($status === 'all') {
            $kq = (new Model_Client())->updateCheckCartitem($cartitemId, $status, $selected);
            $data = (new Model_Client)->tongtienTrongtotal_price($cartId);
            if ($kq) {
                echo json_encode(array('status' => 'success', 'kq' => $kq, 'data' => $data));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'check phẩm'));
            }
        } else {
            $kq = (new Model_Client())->updateCheckCartitem($cartitemId, $status, $selected);
            $data = (new Model_Client)->tongtienTrongtotal_price($cartId);
            if ($kq) {
                echo json_encode(array('status' => 'success', 'kq' => $kq, 'data' => $data));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'check phẩm'));
            }
        }
    }
}
