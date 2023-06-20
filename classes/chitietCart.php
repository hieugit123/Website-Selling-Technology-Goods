<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once require_once;
    include_once "product.php";
?>

<?php
    class chitietCart {
        private $db;
        private $fm;
        private $product;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
            $this->product = new product();
        }

        public function update_chitietCart($id, $soluong){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $soluong = mysqli_real_escape_string($this->db->link, $soluong);
            $query = "UPDATE chitietcart SET SoLuong = $soluong WHERE id = '$id'";
            $update = $this->db->update($query);
                if($update) {
                    // $msg = "Cập nhật giỏ hàng thành công";
                    return true;
                } else {
                    // $msg = "Cập nhật giỏ hàng thất bại";
                    return false;
                }
        
        }

        public function deleteByID($id) {
            $query = "DELETE FROM chitietcart WHERE id = '$id';";
            $result = $this->db->delete($query);
            return $result;
        }
        
        public function update_chitietCart_bynow($cartId, $productId, $soluong){
            $productId = mysqli_real_escape_string($this->db->link, $productId);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $soluong = mysqli_real_escape_string($this->db->link, $soluong);
            // Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa
            $query = "SELECT * FROM chitietcart WHERE MaCart = '$cartId' AND MaSP='$productId'";
            $check = $this->db->select($query);
        
            // Nếu sản phẩm đã có trong giỏ hàng
            if($check) {
                $result = $check->fetch_assoc();
                $id = $result['id'];
                $soluong1 = $result['SoLuong'] + $soluong;
                $query = "UPDATE chitietcart SET SoLuong = $soluong1 WHERE id = '$id'";
                $update = $this->db->update($query);
                if($update) {
                    // $msg = "Cập nhật giỏ hàng thành công";
                    return true;
                } else {
                    // $msg = "Cập nhật giỏ hàng thất bại";
                    return false;
                }
        
            // Nếu sản phẩm chưa có trong giỏ hàng
            } else {
                $query = "INSERT INTO chitietcart(MaCart,MaSP,SoLuong) VALUES('$cartId','$productId','$soluong')";
                $insert = $this->db->insert($query);
                if($insert) {
                    // $msg = "Thêm sản phẩm vào giỏ hàng thành công";
                    return true;
                } else {
                    // $msg = "Thêm sản phẩm vào giỏ hàng thất bại";
                    return false;
                }
            }
        }

        public function getChitietCart($cartId) {
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "SELECT id, MaSP, MaCart, productName, image, c.SoLuong, price FROM chitietcart c,tbl_product p WHERE (c.MaSP = p.productId) AND MaCart = '$cartId';";
            $result = $this->db->select($query);
            return $result;
        }

        public function getSoLuongSP($cartId) {
            
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "SELECT COUNT(MaSP) AS SOSP FROM `chitietcart` WHERE MaCart = '$cartId';";
            $result = $this->db->select($query);
            if($result){
                $value = $result->fetch_assoc();
                $soluong = $value['SOSP'];
                return $soluong;
            }
            return $result;
        }

        public function getChitietCartByIds($cartIds) {
            $ids = implode(",", $cartIds);
            $query = "SELECT id, MaSP, MaCart, productName, image, c.SoLuong, price
                      FROM chitietcart c, tbl_product p
                      WHERE c.MaSP = p.productId AND c.id IN ($ids)";
            $result = $this->db->select($query);
            return $result;
        }
        
        
    }

?>