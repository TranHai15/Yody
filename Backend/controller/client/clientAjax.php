<?php
header('Content-Type: application/json');
require_once("../../../config.php");
require_once("../../../Backend/common/pdo.php");
require_once("../../../Backend/common/function.php");
require_once("../../model/admin/admin.php");
require_once("../../model/client/client.php");



if (isset($_GET['addcart'])) {

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
        $cartid = $cart['cartId'];
        $dataOnDb = $gioHang->getCartId($cartid);

        $found = false; // Cờ kiểm tra
        foreach ($dataOnDb as $key => $value) {
            $variationIdcheck = $value['variationId'];
            $sizeIdcheck = $value['sizeId'];

            if ($variationIdcheck == $variationId && $sizeIdcheck == $sizeId) {
                // Nếu trùng, cập nhật số lượng và giá
                $quantity_new = $quantity + $value['quantity'];
                $price_new = $price;

                $data_new = [
                    'cartId' => $cartid,
                    'variationId' => $variationId,
                    'sizeId' => $sizeId,
                    'quantity' => $quantity_new,
                    'price' => $price_new,
                    'selects' => 1,
                ];

                $dk = 'cartitemId=' . $value['cartitemId'];
                $kq = $gioHang->updateCartItem('cartitems', $data_new, $dk);

                $found = true; // Đánh dấu đã cập nhật
                break; // Dừng vòng lặp
            }
        }

        if (!$found) {
            // Nếu không tìm thấy sản phẩm trùng, thêm sản phẩm mới
            $data = [
                'cartId' => $cartid,
                'variationId' => $variationId,
                'sizeId' => $sizeId,
                'quantity' => $quantity,
                'price' => $price,
                'selects' => 1,
            ];
            $kq = $gioHang->cartItem('cartitems', $data);
        }

        if ($kq) {
            echo json_encode(['status' => 'success', 'message' => 'Thêm giỏ hàng thành công']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Thêm Không thành công']);
        }
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
            if ($kq) {
                echo json_encode(array('status' => 'success', 'message' => 'Thêm giỏ hàng thành công'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Thêm Không thành công'));
            }
        } else {
            echo " Khong them dc di ";
        }
        // var_dump($kq);
    }
}

if (isset($_GET['soluong'])) {
    $id = $_GET['soluong'] ?? "";
    $kq = (new Model_Client)->getNumber($id);
    $sl = $kq[0]['total_quantity'];
    if ($kq) {
        echo json_encode(array('status' => 'success', 'soluong' => $sl));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'loi Không thành công'));
    }
}
if (isPost()) {
    $data = json_decode(file_get_contents("php://input"), true);

    // Tạo điều kiện lọc động
    $where = [];

    if (!empty($data['gender'])) {
        $genderConditions = [];
        foreach ($data['gender'] as $gender) {
            $genderConditions[] = "p.name LIKE '%" . addslashes($gender) . "%'";
        }
        $where[] = '(' . implode(' OR ', $genderConditions) . ')';
    }

    if (!empty($data['colors'])) {
        $colorConditions = [];
        foreach ($data['colors'] as $color) {
            $colorConditions[] = "v.color LIKE '%" . addslashes($color) . "%'";
        }
        $where[] = '(' . implode(' OR ', $colorConditions) . ')';
    }

    if (!empty($data['sizes'])) {
        $sizeConditions = [];
        foreach ($data['sizes'] as $size) {
            $sizeConditions[] = "s.size LIKE '%" . addslashes($size) . "%'";
        }
        $where[] = '(' . implode(' OR ', $sizeConditions) . ')';
    }

    if (!empty($data['price'])) {
        $priceConditions = [];
        foreach ($data['price'] as $price) {
            if ($price == 'below-350k') {
                $priceConditions[] = "v.price < 350000";
            } elseif ($price == 'between-350k-750k') {
                $priceConditions[] = "(v.price BETWEEN 350000 AND 750000)";
            } elseif ($price == 'above-750k') {
                $priceConditions[] = "v.price > 750000";
            }
        }
        if (!empty($priceConditions)) {
            $where[] = '(' . implode(' OR ', $priceConditions) . ')';
        }
    }

    // Ghép điều kiện lọc vào câu lệnh SQL chính
    $sql = "
        SELECT 
            p.productId,
            p.name,
            p.categoryId,
            MIN(v.price) AS new_price,
            MIN(v.sale) AS old_price,
            MIN(v.image) AS ImageMain,
            MIN(v.variationId) AS colorId,
            JSON_ARRAYAGG(
                JSON_OBJECT(
                    'anhColor', v.anhColor,
                    'image', v.image,
                    'variationId', v.variationId
                )
            ) AS variations
        FROM products AS p
        JOIN variations AS v ON p.productId = v.productId
       
    ";
    if (!empty($data['sizes'])) {
        $sql .= " JOIN sizevariations s ON v.variationId = s.variationId ";
    }

    // Nếu có điều kiện lọc thì thêm vào WHERE
    if (!empty($where)) {
        $sql .= " WHERE (p.name like '%a%') AND  " . implode(" OR ", $where);
    } else {
        // Không có điều kiện lọc thì chỉ thêm điều kiện cơ bản
        $sql .= "";
    }

    $sql .= "
        GROUP BY p.productId
        ORDER BY p.productId
        LIMIT 12
    ";
    // echo $sql;
    $kq = getRaw($sql);

    if ($kq) {
        echo json_encode(array('status' => 'success', 'kq' => $kq));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'KHong có sản phẩm'));
    }
}


if (isset($_GET['form2'])) {
    $id = $_GET['form2'] ?? "";
    $kq = (new Model_Client)->getAllDistrict($id);

    if ($kq) {
        echo json_encode(array('status' => 'success', 'data' => $kq));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'loi Không thành công'));
    }
}
if (isset($_GET['form3'])) {
    $id = $_GET['form3'] ?? "";
    $kq = (new Model_Client)->getAllWards($id);

    if ($kq) {
        echo json_encode(array('status' => 'success', 'data' => $kq));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'loi Không thành công'));
    }
}

if (isset($_GET['addComment'])) {
    $userId = $_GET['userId'] ?? null;
    $productid = $_GET['addComment'] ?? null;

    $content = $_GET['content'] ?? null;

    if ($productid && $content && $userId) {
        $dataNew = [
            'productId' => $productid,
            'userId' => $userId,
            'content' => $content,
            'createAt' => (date('Y-m-d H:i:s')),
            'status' => 1,
            'likes' => 1,
        ];

        $kq = insert('comments', $dataNew);
        if ($kq) {
            echo json_encode(array('status' => 'success', 'message' => ' thành công'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'loi Không thành công'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Lỗi kĩ thuật'));
    }
}
