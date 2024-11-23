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
    public function searchProducts($keyword){
        $sql = "SELECT * FROM products WHERE name LIKE :keyword OR description LIKE :keyword";
        $value = getRaw($sql);
        return $value;

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
}
