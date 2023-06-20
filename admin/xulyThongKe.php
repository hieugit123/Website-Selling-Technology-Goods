<?php
// Kết nối CSDL và thực hiện truy vấn
include_once "../classes/thongke.php";
$thongke = new thongke();
// Lấy kết quả từ truy vấn
$ngaybd = $_POST['ngaybd'];
$ngaykt = $_POST['ngaykt'];
$loai = $_POST['loai'];
$result = $thongke->thonKeTheoLoai($ngaybd,$ngaykt,$loai);

// Xử lý kết quả và tạo biểu đồ
if ($result) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'ProductName' => $row['ProductName'],
        'TotalQuantity' => $row['TotalQuantity'],
        'TotalRevenue' => $row['TotalRevenue']
    );
    }
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'No products were found!'));
}
?>