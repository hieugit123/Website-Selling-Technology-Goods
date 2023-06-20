<?php
    include_once "./classes/product.php";
    $pro = new product();

    // $keyword = $_POST['keyword'];
    // $brandId = $_POST['brandId'];
    // $mingia = $_POST['mingia'];
    // $maxgia = $_POST['maxgia'];
    $result = $pro->search_product_bangcao($_POST);
    if ($result) {
        $products = array();
        while ($product = $result->fetch_assoc()) {
            $products[] = $product;
        }
        echo json_encode($products);
    } else {
        echo json_encode(array('error' => 'No products were found!'));
    }
                
?>