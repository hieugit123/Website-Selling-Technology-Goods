<?php
    include "./lib/session.php";
    include_once "./classes/donhang.php";
    include_once "./classes/chitietCart.php";
    include_once "./classes/chitietdonhang.php";
    Session::init();
    $donhang = new donhang();
    $chitiet = new chitietCart();
    $chitietDH = new chitietdonhang();
    $cusID = Session::get("customerid");
    $tongtien = Session::get("tongtien");
    $check = $donhang->insert_hoadon($cusID, $tongtien);
    $id = $donhang->getIDDH();
    $listId = Session::get("listSP");
    $result = $chitiet->getChitietCartByIds($listId);
    //insert chi tiết đơn hàng theo $id, và $listID
    //maHD, maSp, soluong, dongia, thanhtien
    //xóa chi tiết cart
    while($CT = $result->fetch_assoc()){
        $idCT = $CT['id'];
        $maSP = $CT['MaSP'];
        $soluong = $CT['SoLuong'];
        $dongia = $CT['price'];
        $thanhtien = $soluong*$dongia;
        $chitietDH->insert_chitiet($maSP,$id,$soluong,$dongia);

        $chitiet->deleteByID($idCT);
    }
    echo "success";
?>