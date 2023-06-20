<?php
    include_once "../classes/donhang.php";
    $donhang = new donhang();

    // $keyword = $_POST['keyword'];
    // $brandId = $_POST['brandId'];
    // $mingia = $_POST['mingia'];
    // $maxgia = $_POST['maxgia'];
    $datebd = $_POST['datebd'];
    $datekt = $_POST['datekt'];
    $result = $donhang->searchByDate($datebd, $datekt);
    if ($result) {
        $Listdonhang = array();
        while ($product = $result->fetch_assoc()) {
            $Listdonhang[] = $product;
        }
        echo json_encode($Listdonhang);
    } else {
        echo json_encode(array('error' => 'No Oders were found!'));
    }
                
?>