<?php
class Model_Admin
{
    public $conn = null;
    public function __construct()
    {
        $this->conn = Connect();
    }
    public function get_All_Img()
    {
        $sql = "SELECT * FROM slides";
        $value = getRaw($sql);
        return $value;
    }
}
