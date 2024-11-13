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
        $TopProduct = $Client->getAllProducts();

        $slides =  $Client->get_Slide_imgs();


        View(FRONTEND__CLIENT, $file, ["slides" => $slides, "TopProduct" => $TopProduct]);
    }

    public function detail($file = "detail")
    {
        $idProduct = $_GET['product'] ?? "";
        $idVariation = $_GET['color'] ?? "";
        $idVariation = $_GET['size'] ?? "";
        $Client = new Model_Client;
        $OneVariations = $Client->getAllVariationsWhereProductIdWhereVariationId($idProduct, $idVariation);
        View(
            FRONTEND__CLIENT,
            $file,
            [
                "OneVariations" => $OneVariations,
            ]
        );
    }
}
