<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once require_once;

?>


<?php

    class product
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function get_pro_page($page){
            $productInPage = 8;
            $beginIndex = ($page-1)*$productInPage;
            $query = "SELECT * from tbl_product order by productId desc LIMIT $beginIndex,$productInPage";
            $result = $this->db->select($query);
            return $result;
        }

        public function search_product($data)
        {
            $keyword = $this->fm->validation($data['keyword']);
            $query = "SELECT * from tbl_product where productName LIKE '%$keyword%'";
            $result = $this->db->select($query);
            return $result;
        }

        public function search_product_bangcao ($data){
            $keyword = $this->fm->validation($data['keyword']);
            $loai = $this->fm->validation($data['brandId']);
            $mingia = $this->fm->validation($data['mingia']);
            $maxgia = $this->fm->validation($data['maxgia']);
            $query = "SELECT * from tbl_product where productName LIKE '%$keyword%' AND brandId = '$loai' AND  price BETWEEN $mingia AND $maxgia;";
            if($keyword != ''){
                if($loai == ''){
                    if($mingia == '' || $maxgia == ''){
                        $query = "SELECT * from tbl_product where productName LIKE '%$keyword%'";
                    } else {
                        $query = "SELECT * from tbl_product where productName LIKE '%$keyword%' AND  price BETWEEN $mingia AND $maxgia;";
                    }
                } else {
                    if($mingia == '' || $maxgia == '')
                    $query = "SELECT * from tbl_product where productName LIKE '%$keyword%' AND brandId = '$loai';";
                }
            } else {
                if($loai == ''){
                    if($mingia == '' || $maxgia == ''){
                        $query = "SELECT * from tbl_product";
                    } else {
                        $query = "SELECT * from tbl_product where price BETWEEN $mingia AND $maxgia;";
                    }
                } else {
                    if($mingia == '' || $maxgia == '')
                        $query = "SELECT * from tbl_product where brandId = '$loai';";
                    else
                        $query = "SELECT * from tbl_product where brandId = '$loai' AND price BETWEEN $mingia AND $maxgia;";
                }
            }
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_product($data,$files)
        {
            // $catName = $this->fm->validation($catName);
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $SoLuong = mysqli_real_escape_string($this->db->link, $data['SoLuong']);

            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['name'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $uploaded_image = "images/".$unique_image;

            if ($productName =="" || $brand ==""|| $category ==""|| $productDesc ==""|| $price ==""|| $type ==""){
                $alert = "<span class = 'successfull'> Full information required !! </span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_product(productName,catId,brandId,productDesc,type,price,image,state,SoLuong)
                VALUE('$productName','$category','$brand','$productDesc','$type','$price','$unique_image',1,'$SoLuong')";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class = 'successfull'> Insert successfull !! </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'successfull'> Something wrong !! </span>";
                    return $alert;
                }
                

            }
        }

        public function show_product()
        {
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_pro($id)
        {
            $query = "UPDATE tbl_product SET state = 0 WHERE productId = '$id'";
            $result = $this->db->delete($query);
            return 'delete successfull !';
        }

        public function getProById($id)
        {
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function Update_pro($data,$files,$id)
        {
            // $catName = $this->fm->validation($catName);
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['name'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if ($productName =="" || $brand ==""|| $category ==""|| $productDesc ==""|| $price ==""|| $type ==""){
                $alert = "<span class = 'error'> Full information required !! </span>";
                return $alert;
            }else
            {
                if(!empty($file_name)){ 
                move_uploaded_file($file_temp,$uploaded_image);

                    $query = "update tbl_product set
                        productName='$productName',
                        catId='$category',brandId='$brand',
                        productDesc='$productDesc',type='$type',
                        price='$price',
                        image='$unique_image'
                        where productId='$id'"; 
                    // if($file_size > 2048){
                    //     return "<span class = 'error'>Image size should be less than 2MB!</span>";
                    // }             
                    // elseif(in_array($file_ext, $permited) === false){

                    //     return "<span class = 'error'>you can upload only:".implode(', ',$permited)." </span>";
                    // }else{
                    //     $query = "update tbl_product set
                    //     productName='$productName',
                    //     catId='$category',brandId='$brand',
                    //     productDesc='$productDesc',type='$type',
                    //     price='$price',
                    //     image='$unique_image'
                    //     where productId='$id'";
                    // }
                }else{
                    $query = "update tbl_product set
                     productName='$productName',
                     catId='$category',
                     brandId='$brand',
                     productDesc='$productDesc',
                     type='$type',
                     price='$price'                  
                    where productId='$id'";
                } 
            }
                   
                $result = $this->db->update($query);

                if($result){
                    $alert = "<span class = 'successfull'> Update successfull !! </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'> Something wrong !! </span>";
                    return $alert;
                }
                

        }

        public function updateQuantity($data){
            if($data){
                while ($pro = $data->fetch_assoc())
                {
                    $idSP = $pro['MaSP'];
                    //lấy số lượng hiện còn
                    $query = "SELECT SoLuong FROM tbl_product WHERE productId = '$idSP'";
                    $result = $this->db->select($query);
                    $soluongHienTai = $result->fetch_assoc()['SoLuong'];
                    //lấy số lượng mua
                    $soLuongTru = $pro['SoLuong'];
                    $soluong = $soluongHienTai - $soLuongTru;
                    $query = "UPDATE tbl_product SET SoLuong = $soluong WHERE productId = '$idSP'";
                    $result = $this->db->update($query);                   
                }
            }
            return $result;
        } 

        public function updateQuantity11($data){
            if($data){
                while ($pro = $data->fetch_assoc())
                {
                    $idSP = $pro['MaSP'];
                    //lấy số lượng hiện còn
                    $query = "SELECT SoLuong FROM tbl_product WHERE productId = '$idSP'";
                    $result = $this->db->select($query);
                    $soluongHienTai = $result->fetch_assoc()['SoLuong'];
                    //lấy số lượng mua
                    $soLuongTru = $pro['SoLuong'];
                    $soluong = $soluongHienTai + $soLuongTru;
                    $query = "UPDATE tbl_product SET SoLuong = $soluong WHERE productId = '$idSP'";
                    $result = $this->db->update($query);                   
                }
            }
            return $result;
        } 

        //END BACKEND

        public function Get_Feature_Product()
        {
            $query = "SELECT * FROM tbl_product
                        WHERE type = 1
             ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function Get_New_Product()
        {
            $query = "SELECT * FROM tbl_product
                        
             ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function ShowDetail($id){
            $query = "SELECT tbl_product.*, tbl_category.catName , tbl_brand.brandName FROM tbl_product inner join tbl_category on tbl_category.catId = tbl_product.catId INNER join tbl_brand on tbl_brand.brandId = tbl_product.brandId where tbl_product.productId ='$id'"
            ;
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestMacbook(){
            $query = "SELECT * FROM tbl_product where brandId='4'                        
             ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestIphone(){
            $query = "SELECT * FROM tbl_product where brandId='8'                        
             ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestSamsung(){
            $query = "SELECT * FROM tbl_product where brandId='3'                        
             ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestCannon(){
            $query = "SELECT * FROM tbl_product where brandId='7'                        
             ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_slider($data,$files)
        {
            // $catName = $this->fm->validation($catName);
            $title = mysqli_real_escape_string($this->db->link, $data['title']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['name'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_slider(title,type,image)
            VALUE('$title','$type','$unique_image')";
            $result = $this->db->insert($query);

            if($result){
                $alert = "<span class = 'successfull'> Insert successfull !! </span>";
                return $alert;
            }else{
                $alert = "<span class = 'successfull'> Something wrong !! </span>";
                return $alert;
            }
                            
        }

        public function show_slider()
        {
            $query = "SELECT * FROM tbl_slider                       
             where type =1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_slider()
        {
            $query = "SELECT * FROM tbl_slider                       
            ORDER BY id DESC ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_slider_byId($id)
        {
            $query = "SELECT * FROM tbl_slider                       
            where id='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function update_slider($id,$type)
        {
            $type = mysqli_real_escape_string($this->db->link, $type);
            $query = "update tbl_slider set                   
                    type='$type'
                    where id='$id'"; 
                   
            $result = $this->db->update($query);

            if($result){
                $alert = "<span class = 'successfull'> Update successfull !! </span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'> Something wrong !! </span>";
                return $alert;
            }
                

        }

        public function del_slider($Id)
        {
            $query = "DELETE FROM tbl_slider WHERE id = '$Id';";
            $result = $this->db->delete($query);
            if($result){
                    $alert = "<span class = 'successfull'> Delete successfull !! </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'> Something wrong !! </span>";
                    return $alert;
                }
        }
        
    }
    

?>