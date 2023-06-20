<?php
    include "./lib/session.php";
    Session::init();
    include_once "./classes/customer.php";
    $cus = new customer();
    $check = $cus->check_login($_POST);
    if($check){
        echo "success";
    } else {
        echo "";
    }
?>