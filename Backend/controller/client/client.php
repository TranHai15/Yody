<?php
require_once("Backend/common/pdo.php");
require_once("Backend/common/function.php");
require_once("Backend/model/client/client.php");


class Controller_Client
{
    public function Header($file = "header")
    {
        $Client = new Model_Client;
        // lay toàn bộ category
        $category = $Client->getAllCategories();
        // var_dump($category)
        // lấy toàn bộ child category
        $child = $Client->getAllChildCategories();
        // lấy toàn bộ common category
        $common = $Client->getAllCommonCategories();
        // lay toan bo anh category
        $category__image = $Client->getAllCategoryImages();
        View(FRONTEND, $file, [
            "category" => $category,
            "child" => $child,
            "common" => $common,
            "category__image" => $category__image,
        ]);
    }
    public function List($file = "Home")
    {
        $Client = new Model_Client;

        View(
            FRONTEND__VIEW,
            $file,
            []

        );
    }
}
