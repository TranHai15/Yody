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

        $slides =  $Client->get_Slide_imgs();

<<<<<<< HEAD
        View(FRONTEND__VIEW, $file, ["slides" => $slides]);
=======

<<<<<<< HEAD
        View(FRONTEND__VIEW, $file, []);
>>>>>>> 8d1ae2d (duong past moi)
=======
        View(FRONTEND__CLIENT, $file, []);
>>>>>>> 058d150 (tich hop admin vao)
    }

    public function detail($file = "detail")
    {
        $idProduct = $_GET['product'] ?? "";
        $idVariation = $_GET['color'] ?? "";
        $idVariation = $_GET['size'] ?? "";
        $Client = new Model_Client;
        $OneVariations = $Client->getAllVariationsWhereProductIdWhereVariationId($idProduct, $idVariation);
        $AllSizeVariations = $Client->getAllSizeVariationsWhereVariationId($idVariation);
        $AllVariationsImage = $Client->getAllImageVariationsWhereVariationId($idVariation);
        $AllVariationsColor = $Client->getAllVariationColor($idVariation);
        $AllVariationsSize = $Client->getAllVariationSize($idVariation);

        View(
            FRONTEND__CLIENT,
            $file,
            [
                "OneVariations" => $OneVariations,
                "AllVariationsImage" => $AllVariationsImage,
                "AllVariationsColor" => $AllVariationsColor,
                "AllVariationsSize" => $AllVariationsSize,
                "AllSizeVariations" => $AllSizeVariations
            ]
        );
    }
}
