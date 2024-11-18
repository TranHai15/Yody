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
}
