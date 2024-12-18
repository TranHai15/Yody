<?php

class Model_Admin
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

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        return getRaw($sql);
    }

    public function getOneUserById($id)
    {
        $sql = "SELECT * From users WHere userId = $id";
        return getOne($sql);
    }

    public function updateOneUserWhereById($table, $data, $Where)
    {
        return update($table, $data, $Where);
    }

    public function addOneUser($table, $data)
    {
        return insert($table, $data);
    }



    public function getAllComments()
    {
        $sql = "SELECT * FROM comments";
        return getRaw($sql);
    }
    public function DuyetComeent($tabele, $data, $dk)
    {

        return update($tabele, $data, $dk);
    }
    public function DeleteComment($tabele, $dk)
    {

        return delete($tabele, $dk);
    }
    public function getAllOrder()
    {
        $sql = "SELECT o.*, u.name FROM orders AS o JOIN users AS u ON o.userId = u.userId";
        return getRaw($sql);
    }
    public function getAllOrderItems()
    {
        $sql = "SELECT * FROM orderitems";
        return getRaw($sql);
    }
    public function getAllPay()
    {
        $sql = "SELECT * FROM pay";
        return getRaw($sql);
    }
    public function getAllOrderStatus()
    {
        $sql = "SELECT * FROM orderstatus";
        return getRaw($sql);
    }
    public function getAllPayStatus()
    {
        $sql = "SELECT * FROM paystatus";
        return getRaw($sql);
    }
    public function getOneOrder()
    {
        $sql = "SELECT * FROM order ";
        return getRaw($sql);
    }
    public function updateOrder($table, $data, $dk)
    {
        return update($table, $data, $dk);
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        return getRaw($sql);
    }

    public function getAllVariationByProductId($id)
    {
        $sql = "SELECT * FROM variations WHERE productId=$id";
        return getRaw($sql);
    }
    public function getAllSizeVariationByVariationId($id)
    {
        $sql = "SELECT s.*,v.variationCode FROM sizevariations AS s JOIN variations AS v  ON s.variationId = v.variationId WHERE v.variationId=$id";
        return getRaw($sql);
    }
    public function getAllImageVariationByVariationId($id)
    {
        $sql = "SELECT s.*,v.variationCode FROM variationimages AS s JOIN variations AS v  ON s.variationId = v.variationId WHERE v.variationId=$id";
        return getRaw($sql);
    }
    public function addVariation($table, $data)
    {
        return insert($table, $data);
    }
    public function DeleteVariation($table, $dk)
    {
        return delete($table, $dk);
    }

    public function addSize($table, $data)
    {
        return insert($table, $data);
    }
    public function addImageVariation($table, $data)
    {
        return insert($table, $data);
    }
    public function DeleteSize($table, $dk)
    {
        return delete($table, $dk);
    }
    public function DeleteImageVariation($table, $dk)
    {
        return delete($table, $dk);
    }
    public function get_All_Slide()
    {
        $sql = "SELECT * FROM slides";
        return getRaw($sql);
    }
    public function addSlide($table, $data)
    {
        return insert($table, $data);
    }
    public function getOneSlideById($sildeId)
    {
        $sql = "SELECT * FROM slides WHERE sildeId = $sildeId ";
        return getOne($sql);
    }
    public function updateOneSlideWhereID($table, $data, $Where)
    {
        return update($table, $data, $Where);
    }

    public function deleteCategory($dieukien, $cap = 0)
    {
        if ($cap == 0) {
            return delete("categorys", $dieukien);
            die();
        }
        if ($cap == 1) {
            return delete("childcategorys", $dieukien);
            die();
        }
        if ($cap == 2) {
            return delete("commoncategorys", $dieukien);
            die();
        }
    }



    // ============================================= Thắng mới làm ====================================
    // ================================================================================================
    public function addCategory($table, $data)
    {
        return insert($table, $data);
    }
    public function addChild($table, $data)
    {
        return insert($table, $data);
    }
    public function addCommont($table, $data)
    {
        return insert($table, $data);
    }
    public function getOneCategoryById($id)
    {
        $sql = "SELECT * From categorys WHere categoryId = $id";
        return getOne($sql);
    }
    // 12/1/2024
    public function getOneChildCategoryById($id)
    {
        $sql = "SELECT * From childcategorys WHere childId = $id";
        return getOne($sql);
    }
    public function getOneCommontCategoryById($id)
    {
        $sql = "SELECT * From commoncategorys WHere commonId = $id";
        return getOne($sql);
    }

    public function updateOneCategoryWhereById($table, $data, $Where)
    {
        return update($table, $data, $Where);
    }
    public function updateOneChildCategoryWhereById($table, $data, $Where)
    {
        return update($table, $data, $Where);
    }
    public function updateOneCommontCategoryWhereById($table, $data, $Where)
    {
        return update($table, $data, $Where);
    }





    // ========================== product=====================
    public  function  addProduct($table, $data)
    {
        return insert($table, $data);
    }
    public function getproductIdNewByAdd()
    {
        $sql = "SELECT MAX(productId) AS maxProductId FROM products ";

        return getOne($sql);
    }

    public function xoaProduct($table, $id)
    {
        return delete($table, $id);
    }
    public function getAllProductByCategoryId($id)
    {

        $sql = "SELECT * FROM products where categoryId=$id";
        return getRaw($sql);
    }

    // 
    public function phanhoi()
    {

        $sql = "SELECT pr.*, u.name as nameUser,p.name as nameProduct FROM productrivews AS pr JOIN users AS u ON pr.userId = u.userId JOIN products AS p ON pr.productId = p.productId";
        return   getRaw($sql);
    }
    public function Deletefeedbackss($table, $dk)
    {
        return delete($table, $dk);
    }
}

// 