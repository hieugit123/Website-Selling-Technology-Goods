<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>



<?php

    class brand
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_brand($brandName)
        {
            $brandName = $this->fm->validation($brandName);

            $brandName = mysqli_real_escape_string($this->db->link, $brandName);


            if (empty($brandName)){
                $alert = "<span class = 'successfull'> Can not empty !! </span>";
                return $alert;
            }else{

                $query = "INSERT INTO tbl_brand(brandName) VALUE('$brandName')";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class = 'successfull'> Insert brand successfull !! </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'successfull'> Something wrong !! </span>";
                    return $alert;
                }
                

            }
        }

        public function show_brand()
        {
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_brand($brandId)
        {
            $query = "DELETE FROM tbl_brand WHERE brandId = '$brandId';";
            $result = $this->db->delete($query);
            return 'delete successfull !';
        }

        public function getbrandbyId($id)
        {
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getnamebyid($id)
        {
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            while ($a = $result->fetch_assoc()) {
                $name = $a['brandName'];
            }
            return $name;
        }

        public function Update_brand($brandName,$id)
        {
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $id = mysqli_real_escape_string($this->db->link, $id);


            if (empty($brandName)){
                $alert = "<span class = 'successfull'> Can not empty !! </span>";
                return $alert;
            }else{

                $query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'successfull'> Update brand successfull !! </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'successfull'> Something wrong !! </span>";
                    return $alert;
                }
                

            }
        }

    }

    

?>



