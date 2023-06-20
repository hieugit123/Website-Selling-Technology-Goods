<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once require_once;

?>


<?php

    class chitietdonhang
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_chitiet($masp, $mahd, $soluong, $dongia)
        {
            $maSP = mysqli_real_escape_string($this->db->link, $masp);
            $maHD = mysqli_real_escape_string($this->db->link, $mahd);
            $soluong = mysqli_real_escape_string($this->db->link, $soluong);
            $dongia = mysqli_real_escape_string($this->db->link, $dongia);
            $thanhtien = $soluong*$dongia;
            $query = "INSERT INTO chitietorder (MaSP, MaHD, SoLuong, DonGia, ThanhTien) 
              VALUES ('$maSP', '$maHD', '$soluong', '$dongia', '$thanhtien')";

            $result = $this->db->insert($query);
            return $result;
        }

        public function getCTDHBy_Id($id)
        {
            $query = "SELECT productName, image, DonGia, c.SoLuong, ThanhTien FROM `chitietorder` c, `tbl_product` a WHERE MaHD = '$id' AND (MaSP=a.productId);";
            $result = $this->db->select($query);
            return $result;
        }

        public function getListCTDH($id)
        {
            $query = "SELECT MaSP, SoLuong FROM `chitietorder` WHERE MaHD = '$id';";
            $result = $this->db->select($query);
            return $result;
        }
    }
    

?>