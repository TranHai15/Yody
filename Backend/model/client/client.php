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
        $sql = "
    SELECT 
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
    LIMIT 12;
";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================================



    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

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
    ci.quantity AS total_quantity,
    ci.price AS total_price,
    v.image,
    v.price AS variation_price,
    v.sale AS variation_sale,
    v.color,
    p.name AS product_name,
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
        ci.cartId = $cartid;
    ";
        return getRaw($sql);
    }
    public function tongtienTrongtotal_price()
    {
        $sql = " SELECT SUM(price) AS total
    FROM cartitems";
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
}
