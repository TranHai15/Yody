<?php

class Model_Client
{
    public $conn = null;

    // Connect to the database
    public function __construct()
    {
        $this->conn = Connect();
    }

    // Disconnect from the database
    public function __destruct()
    {
        $this->conn = null;
    }

    // Get all records from the categoryes table
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categorys";
        $value = getRaw($sql);
        return $value;
        // var_dump($value);
    }

    // Get all records from the childcategoryes table
    public function getAllChildCategories()
    {
        $sql = "SELECT * FROM childcategorys";
        $value = getRaw($sql);
        return $value;
    }

    // Get all records from the commoncategories table
    public function getAllCommonCategories()
    {
        $sql = "SELECT * FROM commoncategorys";
        $value = getRaw($sql);
        return $value;
    }
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getAllVariationsWhereProductIdWhereVariationId($idVariations)
    {
        $sql = "
        SELECT p.*, 
               v.variationId, 
               v.image, 
               v.color, 
               v.price, 
               v.descripe, 
               v.variationCode, 
               v.sale, 
               s.sizeId, 
               s.size
        FROM variations AS v
        JOIN products AS p ON p.productId = v.productId
        LEFT JOIN sizevariations AS s ON s.variationId = v.variationId
        WHERE v.variationId = $idVariations
        AND s.sizeId = (SELECT MIN(sizeId) 
                        FROM sizevariations 
                        WHERE variationId = $idVariations)";
        return getOne($sql);
    }

    public function getAllSizeWhereProductIdWhereVariationId($idVariations)
    {


        $sql = "SELECT * FROM sizevariations WHERE variationId = $idVariations";
        return getRaw($sql);
    }
    public function getAllVariationWhereProductId($productId)
    {
        $sql = "SELECT * FROM variations WHERE productId = $productId";
        return getRaw($sql);
    }

    public function getAllImageWhereProductIdWhereVariationId($idVariations)
    {
        $sql = "SELECT * FROM variationimages WHERE variationId = $idVariations";
        return getRaw($sql);
    }
    // ****************************Slide***********************
    public function get_Slide_Imgs()
    {
        $sql = "SELECT * FROM slides";
        $value = getRaw($sql);
        // var_dump($value);
        return $value;
    }
    // =============================Thắng làm 21/11/2024==================
    public function searchProducts($keyword)
    {
        $sql = "SELECT 
        p.productId,
        p.name,
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
    WHERE p.name LIKE :keyword
    GROUP BY p.productId
    ORDER BY p.productId
    LIMIT 12;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================================
    public function categoryLoc($idName)
    {
        $sql = "SELECT 
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
    WHERE categoryId = $idName
    GROUP BY p.productId
    ORDER BY p.productId
    LIMIT 12";
        return getRaw($sql);
    }

    public function getNumber($id)
    {
        $sql = "SELECT SUM(ca.quantity) as total_quantity FROM carts AS c JOIN cartitems AS ca ON c.cartId = ca.cartId  WHERE userId = $id";
        return getRaw($sql);
    }
    public function getNumberbysizeID($iduser, $sizeId)
    {
        $sql = "SELECT SUM(ca.quantity) as total_quantity FROM carts AS c JOIN cartitems AS ca ON c.cartId = ca.cartId  WHERE userId = $iduser AND sizeId = $sizeId";
        return getOne($sql);
    }
    public function viewProduct($id)
    {
        $sql = "SELECT p.productId FROM products as p JOIN variations as v on p.productId = v.productId WHERE v.variationId =$id ";
        return getOne($sql);
    }
    public function updateViewProduct($id)
    {
        $sql = "SELECT p.view FROM products as p WHERE p.productId =$id";
        $soluong = getOne($sql);
        // checkloi($id);
        // checkloi($soluong);
        // $sql = "UPDATE products AS p SET p.`view` = $soluong+1 WHERE p.productId=$id";
        $dk = 'productId=' . $id;
        // checkloi($dk);
        $view = (int)$soluong['view'] + 1;
        // checkloi($view);
        $data = [
            'view' => $view
        ];
        return update('products', $data, $dk);
    }


    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // ***********************Lấy 4sp*************************88
    public function getAllProducts()
    {
        $sql = "SELECT p.productId,
        p.name,
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
 GROUP BY p.productId
 ORDER BY p.productId
 LIMIT 4;
 ";

        return getRaw($sql);
    }
    // ***********************Lấy ra 15 sản phẩm đổ bên dưới****************************
    public function getAll()
    {
        $sql  = "SELECT p.productId,
        p.name,
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
        GROUP BY p.productId
        ORDER BY p.productId LIMIT 15";
        return getRaw($sql);
    }

    //************************** */ Lấy 4 sp có view cao***************************
    public function get4productsWhereViewDesc()
    {
        $sql = "SELECT 
    p.productId,
    p.name,
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
FROM 
    products AS p
JOIN 
    variations AS v ON p.productId = v.productId
GROUP BY 
    p.productId
ORDER BY 
    p.view DESC
LIMIT 4
";
        return getRaw($sql);
    }
    // *********************Thêm giỏ hàng******************************************
    // *********************Thêm giỏ hàng******************************************
    // *********************Thêm giỏ hàng******************************************
    public function carts($table, $data)
    {
        return  insert($table, $data);
    }
    public function cartItem($table, $data)
    {

        return insert($table, $data);
    }

    public function getCartId($cartid)
    {
        $sql = "SELECT * FROM `cartitems` WHERE cartId = $cartid";
        return getRaw($sql);
    }
    public function layCartIdByUserID($userId)
    {
        $sql = "SELECT cartId FROM carts WHERE userId = $userId";
        return getOne($sql);
    }
    //Đổ dữ liệu ra giỏ hàng

    public function getCartItemsWithProductName($cartid)
    {
        $sql = " SELECT 
    ci.cartitemId,
    ci.cartId,
    ci.selects,
    ci.quantity AS total_quantity,
    ci.price AS total_price,
    v.image,
    v.price AS variation_price,
    v.sale AS variation_sale,
    v.color,
    v.variationId,
    p.name AS product_name,
    sv.sizeId,
    sv.size
    FROM 
        cartitems ci
    JOIN 
        variations v ON ci.variationId = v.variationId
    JOIN 
        products p ON v.productId = p.productId
    JOIN 
        sizevariations sv ON ci.sizeId = sv.sizeId
    WHERE 
        ci.cartId = $cartid  ;
    ";
        return getRaw($sql);
    }
    public function getCartItemsWithProductNameId($cartid)
    {
        $sql = " SELECT 
    ci.cartitemId,
    ci.cartId,
    ci.selects,
    ci.quantity AS total_quantity,
    ci.price AS total_price,
    v.image,
    v.price AS variation_price,
    v.sale AS variation_sale,
    v.color,
    v.variationId,
    p.name AS product_name,
    sv.sizeId,
    sv.size
    FROM 
        cartitems ci
    JOIN 
        variations v ON ci.variationId = v.variationId
    JOIN 
        products p ON v.productId = p.productId
    JOIN 
        sizevariations sv ON ci.sizeId = sv.sizeId
    WHERE 
        ci.cartId = $cartid AND ci.selects =1 ;
    ";
        return getRaw($sql);
    }
    public function tongtienTrongtotal_price($cartid)
    {
        $sql = "SELECT SUM(quantity * price) AS total
        FROM cartitems
        WHERE cartId = $cartid AND selects = 1;
        ";
        return getOne($sql);
    }
    public function getRaCartIdTrongCart($id)
    {
        $sql = "SELECT cartid FROM carts WHERE userId= $id";
        return getOne($sql);
    }
    public function updateCartItem($table, $data, $Where)
    {
        return update($table, $data, $Where);
    }

    public function rateProduct($table, $data)
    {
        return insert($table, $data);
    }


    public function updateCheckCartitem($where, $check, $value)
    {
        if ($check === 'all') {
            $data = [
                'selects' => $value
            ];
            $dk = 'cartId=' . $where;
            return update('cartitems', $data, $dk);
        } else {
            $data = [
                'selects' => $value
            ];
            $dk = 'cartitemId=' . $where;
            return update('cartitems', $data, $dk);
        }
    }
    // 
    public function getAllProvince()
    {
        $sql = "SELECT * FROM province";
        return getRaw($sql);
    }
    public function getAllDistrict($id)
    {
        $sql = "SELECT * FROM district WHERE province_id = $id";
        return getRaw($sql);
    }
    public function getAllWards($id)
    {
        $sql = "SELECT * FROM wards WHERE district_id = $id";
        return getRaw($sql);
    }
    public function goiEventtheoPast($past)
    {
        $sql = "SELECT * FROM slides WHERE past = '$past' ";
        return getOne($sql);
    }
    public function getAddress($province_id, $district_id, $wards_id)
    {
        $sql = "SELECT p.name AS Tp , d.name AS Huyen , w.name AS Xa  FROM province AS p JOIN district AS d ON p.province_id = d.province_id 
        JOIN wards AS w ON d.district_id = w.district_id WHERE p.province_id =$province_id AND d.district_id=$district_id AND w.wards_id=$wards_id";
        return getOne($sql);
    }
    public function insertOrder($table, $data)
    {
        return insert($table, $data);
    }
    public function getAllcartItemByuserId($id, $dk = 1)
    {
        if ($dk === 1) {
            $sql = "SELECT * FROM cartitems WHERE cartId = (SELECT cartId FROM carts WHERE userId= $id) AND selects=1";
            return getRaw($sql);
        } else {
            $sql = "SELECT * FROM cartitems WHERE cartId = (SELECT cartId FROM carts WHERE userId= $id) AND selects=1";
            return getRaw($sql);
        }
    }
    public function insertOrderItem($table, $data)
    {
        return insert($table, $data);
    }
    public function deleteQuatitySize($sizeId, $soluong)
    {
        $sql = "SELECT quantity FROM sizevariations WHERE sizeId = $sizeId";
        $dataNumber = getOne($sql);
        // checkloi($dataNumber['quantity']);
        $numberNew = (int)($dataNumber['quantity'] - $soluong);
        $dk = 'sizeId=' . $sizeId;
        return update('sizevariations', ['quantity' => $numberNew], $dk);
    }


    public function deleteCartitem($id)
    {
        return delete('cartitems', "cartitemId=$id");
    }
    public function getOrdersandOrderItem($userId)
    {
        $sql = "SELECT 
    o.orderId,
    o.statusId,
    os.name AS orderStatusName,
    os.description AS orderStatusDescription,
    o.userId,
    o.sumPrice,
    o.address,
    o.phone,
    o.payId,
    o.payStatusId,
    o.updateAt AS orderUpdateAt,
    o.createAt AS orderCreateAt,
    oi.orderitemId,
    oi.variationId,
    oi.sizeId,
    oi.quantity,
    oi.price AS itemPrice,
    v.image AS variationImage,
    v.color AS variationColor,
    v.price AS variationPrice,
    v.sale AS variationSale,
    v.descripe AS variationDescripe,
    p.name AS productName,
    sz.size AS sizeName
    FROM orders o
    INNER JOIN orderstatus os ON o.statusId = os.statusId
    INNER JOIN orderitems oi ON o.orderId = oi.orderId
    INNER JOIN variations v ON oi.variationId = v.variationId
    INNER JOIN sizevariations sz ON oi.sizeId = sz.sizeId
    INNER JOIN products p ON v.productId = p.productId
    WHERE o.userId = $userId;
    ";
        return getRaw($sql);
    }

    public function getAllOrder($userId)
    {
        $sql = "SELECT o.*,pa.name AS paymethod, os.name AS statusDonhang, p.paymentStatus AS phuongthucTT from orders AS o JOIN pay AS pa ON o.payId = pa.payId    JOIN orderstatus  AS os ON o.statusId = os.statusId  JOIN paystatus AS p ON o.payStatusId = p.payStatusId where userId = $userId ORDER BY o.orderId DESC;";
        return getRaw($sql);
    }
    // ******************************* Đổ comment ra*************************
    public function getAllphanhoiWhereProductId($productId)
    {
        $sql = "SELECT pr.*, u.name AS nameuser, u.avata,p.name FROM productrivews AS pr JOIN users AS u ON pr.userId = u.userId JOIN products AS p ON pr.productId = p.productId WHERE pr.productId = $productId
";
        return getRaw($sql);
    }
    // cap nhat ly do huy don
    public function huydon($lydo, $orderId)
    {
        if (is_array($lydo)) {
            $lydo = implode(", ", $lydo);
        }

        $sql = "UPDATE orders SET statusId = 8, lydomuonhuydon = :lydo WHERE orderId = :orderId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':lydo', $lydo, PDO::PARAM_STR);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

        // Debug SQL
        // $debugSQL = str_replace([':lydo', ':orderId'], [$lydo, $orderId], $sql);
        // echo $debugSQL;

        return $stmt->execute();
    }
    //*********************************************** */ Lấy dữ liệu đổ ra orderItemDetail******************************************
    public function getAlldulieudoraorderItemDetail($idOrder)
    {
        $sql = "SELECT 
    o.*, 
    v.image AS anhsp, 
    v.color AS mausp, 
    s.size, 
    os.name AS trangthaidonhang, 
    os.statusId AS idtrangthaidonhang,
    pa.paymentStatus AS trangthaithanhtoan, 
    pa.payStatusId AS idtrangthaithanhtoan, 
    p.name AS tensanpham
    FROM 
        orderitems AS o
    JOIN 
        variations AS v ON o.variationId = v.variationId
    JOIN 
        products AS p ON v.productId = p.productId
    JOIN 
        sizevariations AS s ON o.sizeId = s.sizeId
    JOIN 
        orderstatus AS os ON o.statusId = os.statusId
    JOIN 
        paystatus AS pa ON o.payStatusId = pa.payStatusId
    WHERE 
        o.orderId = $idOrder;

    ";
        return getRaw($sql);
    }
    // Hủy sản phẩm trong đơn hàng
    public function cancelOrderItem($id, $lydo)
    {
        if (is_array($lydo)) {
            $lydo = implode(", ", $lydo);
        }

        $sql = "UPDATE orderitems SET statusId = 8, lydo = :lydo WHERE orderitemId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':lydo', $lydo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function UpdateQuantitykhihuydonhang($orderitemId)
    {
        $sql = " UPDATE sizevariations sv
            JOIN (
                SELECT sizeId, quantity
                FROM orderitems
                WHERE orderitemId = :orderitemId 
            ) oi ON sv.sizeId = oi.sizeId
            SET sv.quantity = sv.quantity + oi.quantity;
        ";

        // Chuẩn bị và thực thi truy vấn
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['orderitemId' => $orderitemId]);
    }

    public function cancelOrderAndUpdateQuantity($orderId)
    {
        // Bước 1: Lấy tất cả orderitemId, sizeId, quantity từ bảng orderitems với orderId
        $sql = "
        SELECT orderitemId, sizeId, quantity
        FROM orderitems
        WHERE orderId = :orderId
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['orderId' => $orderId]);
        $orderItems = $stmt->fetchAll();

        // Bước 2: Duyệt qua các orderitemId để lấy sizeId và quantity, sau đó cập nhật bảng sizevariations
        foreach ($orderItems as $item) {
            $sizeId = $item['sizeId'];
            $quantity = $item['quantity'];

            // Bước 3: Lấy sizevariations và cộng quantity
            $updateSql = "
            UPDATE sizevariations
            SET quantity = quantity + :quantity
            WHERE sizeId = :sizeId
        ";

            $updateStmt = $this->conn->prepare($updateSql);
            $updateStmt->execute([
                'quantity' => $quantity,
                'sizeId' => $sizeId
            ]);
        }

        // Bước 4: (Tùy chọn) Cập nhật trạng thái đơn hàng trong bảng orders nếu cần
        $updateOrderSql = "  UPDATE orders
        SET statusId = 8, lydomuonhuydon = 'Đơn hàng bị hủy'
        WHERE orderId = :orderId
    ";

        $updateOrderStmt = $this->conn->prepare($updateOrderSql);
        $updateOrderStmt->execute(['orderId' => $orderId]);

        return true; // Trả về true nếu mọi thứ thành công
    }


    public function getAllCommentByProductId($id)
    {
        $sql = "SELECT pr.*, u.name AS nameuser,u.avata,
        p.name FROM comments AS pr JOIN users AS u ON pr.userId = u.userId JOIN products AS p ON pr.productId = p.productId WHERE pr.productId = $id";
        return getRaw(
            $sql
        );
    }
}
