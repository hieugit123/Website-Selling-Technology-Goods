<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once require_once;

?>


<?php

    class donhang
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_hoadon($customerId, $tongtien)
{
            $createDtae = date('Y-m-d'); // Lấy ngày hiện tại

            $customerId = mysqli_real_escape_string($this->db->link, $customerId);
            $tongtien = mysqli_real_escape_string($this->db->link, $tongtien);
            $createDtae = mysqli_real_escape_string($this->db->link, $createDtae);

            $query = "INSERT INTO tbl_order (customerId, createDate, tongTien, state)
                    VALUES ('$customerId', '$createDtae', '$tongtien', 0)";
                    
            $result = $this->db->insert($query);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function getIDDH(){
            $query = "SELECT COUNT(*) AS count FROM tbl_order";
            $result = $this->db->select($query);
            if ($result) {
                $row = $result->fetch_assoc();
                $count = $row['count'] + 5;
                return $count;
            }
            return '';
        }

        public function show_hoadon_byIdCus($idCus)
        {
            $query = "SELECT * FROM tbl_order WHERE customerId = '$idCus';";
            $result = $this->db->select($query);
            return $result;
        }

        public function getAllDH()
        {
            $query = "SELECT * FROM tbl_order;";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function updateState($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $query = "UPDATE tbl_order SET state = -1 WHERE id = '$id'";
            $result = $this->db->update($query);
            if($result)
                return true;
            return false;
        }

        public function updateState111($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $query = "UPDATE tbl_order SET state = 2 WHERE id = '$id'";
            $result = $this->db->update($query);
            if($result)
                return true;
            return false;
        }


        public function searchByDate($ngaybd, $ngaykt) {
            // Chuyển định dạng ngày tháng từ string sang đối tượng DateTime
            // $startDate = DateTime::createFromFormat('Y-m-d', $ngaybd);
            // $endDate = DateTime::createFromFormat('Y-m-d', $ngaykt);
        
            // Kiểm tra nếu chuyển đổi thành công
            // if ($startDate && $endDate) {
                // Định dạng lại ngày tháng cho truy vấn SQL
                // $startDateFormatted = $startDate->format('Y-m-d');
                // $endDateFormatted = $endDate->format('Y-m-d');
        
                // Thực hiện truy vấn SQL để tìm kiếm các đơn hàng trong khoảng thời gian
                if($ngaybd != '' && $ngaykt != '') {
                $query = "SELECT * FROM tbl_order WHERE createDate BETWEEN '$ngaybd' AND '$ngaykt'";
                // Thực hiện truy vấn và trả về kết quả
                $result = $this->db->select($query);
                return $result;
            // } else {
                // Ngày tháng không hợp lệ
                // return false;
                } else {
                    if($ngaybd == '' && $ngaykt == ''){
                            $query = "SELECT * FROM tbl_order";
                            // Thực hiện truy vấn và trả về kết quả
                            $result = $this->db->select($query);
                            return $result; 
                    } else {
                        if($ngaybd != ''){
                            $query = "SELECT * FROM tbl_order WHERE createDate >= '$ngaybd'";
                            // Thực hiện truy vấn và trả về kết quả
                            $result = $this->db->select($query);
                            return $result; 
                        } else {
                            $query = "SELECT * FROM tbl_order WHERE createDate <= '$ngaykt'";
                            // Thực hiện truy vấn và trả về kết quả
                            $result = $this->db->select($query);
                            return $result;  
                        }
                    }
                }
        }

        public function updateStateByAdmin($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $query = "UPDATE tbl_order SET state = 1 WHERE id = '$id'";
            $result = $this->db->update($query);
            if($result)
                return true;
            return false;
        }

        // public function del_category($catId)
        // {
        //     $query = "DELETE FROM tbl_category WHERE catId = '$catId';";
        //     $result = $this->db->delete($query);
        //     return 'delete successfull !';
        // }

        // public function getcatbyId($id)
        // {
        //     $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        //     $result = $this->db->select($query);
        //     if($result){
        //         return $result;
        //     }else {
        //         return "No category";
        //     }
        // }

    }
    

?>