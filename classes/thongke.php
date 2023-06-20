<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once require_once;
?>
<?php
    class thongke
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function thonKeTheoLoai($ngaybd, $ngaykt, $loai){
            if($loai == ''){
                if($ngaybd != '' && $ngaykt != ''){
                    $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS 
                    TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN 
                    tbl_product p ON co.MaSP = p.productID WHERE o.createDate BETWEEN '$ngaybd' AND 
                    '$ngaykt' AND o.state >= 1 GROUP BY p.ProductName UNION ALL SELECT 'Total', 
                    SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS TotalRevenue FROM 
                    tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN tbl_product p 
                    ON co.MaSP = p.productID WHERE o.createDate BETWEEN '$ngaybd' AND '$ngaykt' 
                    AND o.state >= 1;
                    ";
                    $result = $this->db->select($query);
                    return $result;
                } else {
                    if($ngaybd == '' && $ngaykt == ''){
                        $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS 
                        TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN 
                        tbl_product p ON co.MaSP = p.productID GROUP BY p.ProductName UNION ALL SELECT 'Total', 
                        SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS TotalRevenue FROM 
                        tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN tbl_product p 
                        ON co.MaSP = p.productID;
                        ";
                        $result = $this->db->select($query);
                        return $result;
                    }
                    if($ngaybd == ''){
                        $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS 
                        TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN 
                        tbl_product p ON co.MaSP = p.productID WHERE o.createDate <= '$ngaykt' AND o.state >= 1 GROUP BY p.ProductName UNION ALL SELECT 'Total', 
                        SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS TotalRevenue FROM 
                        tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN tbl_product p 
                        ON co.MaSP = p.productID WHERE o.createDate <= '$ngaykt' 
                        AND o.state >= 1;
                        ";
                        $result = $this->db->select($query);
                        return $result;
                    } else if($ngaykt == ''){
                        $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS 
                        TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN 
                        tbl_product p ON co.MaSP = p.productID WHERE o.createDate >= '$ngaybd' AND o.state >= 1 GROUP BY p.ProductName UNION ALL SELECT 'Total', 
                        SUM(co.SoLuong) AS TotalQuantity, SUM(co.ThanhTien) AS TotalRevenue FROM 
                        tbl_order o INNER JOIN chitietorder co ON o.id = co.MaHD LEFT JOIN tbl_product p 
                        ON co.MaSP = p.productID WHERE o.createDate >= '$ngaykt' 
                        AND o.state >= 1;
                        ";
                        $result = $this->db->select($query);
                        return $result;
                    }
                }
            }else {
                if($ngaybd != '' && $ngaykt != ''){
                    $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity,
                    SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON 
                    o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE o.createDate
                    BETWEEN '$ngaybd' AND '$ngaykt' AND o.state >= 1 AND brandId = $loai GROUP BY 
                    p.ProductName UNION ALL SELECT 'Total', SUM(co.SoLuong) AS TotalQuantity, 
                    SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co 
                    ON o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE 
                    o.createDate BETWEEN '$ngaybd' AND '$ngaykt' AND o.state >= 1 AND 
                    brandId = $loai;";
                    $result = $this->db->select($query);
                    return $result;
                } else {
                    if($ngaybd == '' && $ngaykt == ''){
                        $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity,
                        SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON 
                        o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE o.state >= 1 AND brandId = $loai GROUP BY 
                        p.ProductName UNION ALL SELECT 'Total', SUM(co.SoLuong) AS TotalQuantity, 
                        SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co 
                        ON o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE o.state >= 1 AND 
                        brandId = $loai;";
                        $result = $this->db->select($query);
                        return $result;
                    }
                    if($ngaybd == ''){
                        $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity,
                        SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON 
                        o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE o.createDate <= '$ngaykt' AND o.state >= 1 AND brandId = $loai GROUP BY 
                        p.ProductName UNION ALL SELECT 'Total', SUM(co.SoLuong) AS TotalQuantity, 
                        SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co 
                        ON o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE 
                        o.createDate <= '$ngaykt' AND o.state >= 1 AND 
                        brandId = $loai;";
                        $result = $this->db->select($query);
                        return $result;
                    } else {
                        $query = "SELECT p.productName AS ProductName, SUM(co.SoLuong) AS TotalQuantity,
                        SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co ON 
                        o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE o.createDate >= '$ngaybd' AND o.state >= 1 AND brandId = $loai GROUP BY 
                        p.ProductName UNION ALL SELECT 'Total', SUM(co.SoLuong) AS TotalQuantity, 
                        SUM(co.ThanhTien) AS TotalRevenue FROM tbl_order o INNER JOIN chitietorder co 
                        ON o.id = co.MaHD LEFT JOIN tbl_product p ON co.MaSP = p.productID WHERE 
                        o.createDate >= '$ngaybd' AND o.state >= 1 AND 
                        brandId = $loai;";
                        $result = $this->db->select($query);
                        return $result;
                    }
                }
            }
        }
       
    }
?>