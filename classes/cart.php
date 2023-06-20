<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once require_once;

?>


<?php

    class cart
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($customerId){

            $customerId = mysqli_real_escape_string($this->db->link, $customerId);

            $query = "SELECT * FROM tbl_cart WHERE customerId = '$customerId'";

            $check = $this->db->select($query);

            if($check){
                //$cur_quan = $check->fetch_assoc();
                //$total_quan = $quantity + $cur_quan["quantity"];
                //$query = "UPDATE tbl_cart SET quantity='$total_quan' where productId = '$id'";
                $msg = "THE USER HAS A FAKE PRODUCT!";
                return $msg;
            }else {
                $query = "INSERT INTO tbl_cart(customerId)
                VALUE('$customerId')";
                $result2 = $this->db->insert($query);

                if($result2){
                    $msg = "";
                    return $msg;
                }else{
                    header('Location:404.php');
                }
            }   
        }

        public function getId($customerId) {
            $customerId = mysqli_real_escape_string($this->db->link, $customerId);

            $query = "SELECT cartId FROM tbl_cart WHERE customerId = '$customerId'";

            $check = $this->db->select($query);
            if($check){
                $result = $check->fetch_assoc();
                $id = $result['cartId'];
                return $id;
            }
            return "";
        }
    }
?>