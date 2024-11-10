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
        $sql = "SELECT * FROM categoryes";
        $value = getRaw($sql);
        return $value;
    }

    // Get all records from the childcategoryes table
    public function getAllChildCategories()
    {
        $sql = "SELECT * FROM childcategoryes";
        $value = getRaw($sql);
        return $value;
    }

    // Get all records from the commoncategories table
    public function getAllCommonCategories()
    {
        $sql = "SELECT * FROM commoncategories";
        $value = getRaw($sql);
        return $value;
    }

    // Get all records from the categoryimage table
    public function getAllCategoryImages()
    {
        $sql = "SELECT * FROM categoryimage";
        $value = getRaw($sql);
        return $value;
    }
}
