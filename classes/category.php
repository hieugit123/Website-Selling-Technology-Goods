<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once require_once;

?>


<?php

    class category
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_catgory($catName)
        {
            $catName = $this->fm->validation($catName);

            $catName = mysqli_real_escape_string($this->db->link, $catName);


            if (empty($catName)){
                $alert = "<span class = 'successfull'> Can not empty !! </span>";
                return $alert;
            }else{

                $query = "INSERT INTO tbl_category(catName) VALUE('$catName')";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class = 'successfull'> Insert category successfull !! </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'successfull'> Something wrong !! </span>";
                    return $alert;
                }
                

            }
        }

        public function show_category()
        {
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_category($catId)
        {
            $query = "DELETE FROM tbl_category WHERE catId = '$catId';";
            $result = $this->db->delete($query);
            return 'delete successfull !';
        }

        public function getcatbyId($id)
        {
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else {
                return "No category";
            }
        }

        public function getnamebyid($id)
        {
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            while ($a = $result->fetch_assoc()) {
                $name = $a['catName'];
            }
            return $name;
        }

        public function Update_catgory($catName,$id)
        {
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);


            if (empty($catName)){
                $alert = "<span class = 'successfull'> Can not empty !! </span>";
                return $alert;
            }else{

                $query = "UPDATE tbl_category SET catName='$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'successfull'> Update category successfull !! </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'successfull'> Something wrong !! </span>";
                    return $alert;
                }
                

            }
        }

        public function get_pro_by_catId($catId){
            $query = "SELECT * FROM tbl_product WHERE catId = '$catId'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else {
                
            }
            
        
        }

    }
    

?>