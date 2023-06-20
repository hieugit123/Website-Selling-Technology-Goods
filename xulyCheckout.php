<?php
    include "./lib/session.php";
    Session::init();
    $arr = $_POST['arrID'];
    Session::set("listSP",$arr);
    echo "success";
?>