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


        View(FRONTEND, $file, [
            "category" => $category,
            "child" => $child,
            "common" => $common,
        ]);
    }
    public function List($file = "Home")
    {
        $Client = new Model_Client;



        View(FRONTEND__VIEW, $file, []);
    }

    public function detail($file = "detail")
    {
        $Client = new Model_Client;
        $OneVariations = $Client->getAllVariationsWhereProductIdWhereVariationId(2);
        $AllSizeVariations = $Client->getAllSizeVariationsWhereVariationId(2);
        $AllVariationsImage = $Client->getAllImageVariationsWhereVariationId(2);

        View(
            FRONTEND__VIEW,
            $file,
            [
                "OneVariations" => $OneVariations,
                "AllVariationsImage" => $AllVariationsImage,
                "AllSizeVariations" => $AllSizeVariations

            ]

        );
    }
}
