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

    public function getAllVariationsWhereProductIdWhereVariationId($id)
    {
        $sql = "SELECT p.* , v.variationId,v.image,v.color,v.price,v.descripe,v.variationCode ,v.sale
        FROM products AS p
        JOIN variations AS v ON p.productId = v.productId
        
        WHERE p.productId = 2 AND v.variationId = 3
        
 ";
        return getRaw($sql);
    }

    public function getAllSizeVariationsWhereVariationId($id)
    {
        $sql = "SELECT s.sizeCode, s.size, s.quantity
        FROM sizevariations AS s
        WHERE s.variationId = 2;
        ";
        return getRaw($sql);
    }
    public function getAllImageVariationsWhereVariationId($id)
    {
        $sql = "SELECT i.image AS variation_image
        FROM variationimages AS i
        WHERE i.variationId = 2;
        ";
        return getRaw($sql);
    }
    public function getAllVariationColor($id)
    {
        $sql = "SELECT *
        FROM variations WHERE productId = 3";
    }
}
