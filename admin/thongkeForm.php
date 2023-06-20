<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    include_once '../classes/brand.php';
    $brand = new brand();
    $listBrand = $brand->show_brand();
?>

        <div class="grid_10">
            <div class="box round first grid">

                <div class="formThongKe">
                    <div class="form-gr">
                        <label for="chonloai">Chọn loại</label>
                        <select name="chonloai" id="chonloai">
                            <option value="">--CHỌN--</option>
                            <?php 
                                while($row = $listBrand->fetch_assoc()) {
                            
                            ?>
                                 <option value="<?php echo $row['brandId'];?>"><?php echo $row['brandName'];?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-gr">
                        <label for="ngaybd">Ngày bắt đầu</label>
                        <input type="date" name="ngaybd" id="ngaybd">
                    </div>
                    <div class="form-gr">
                        <label for="ngaykt">Ngày kết thúc</label>
                        <input type="date" name="ngaykt" id="ngaykt">
                    </div>
                    <div class="button">
                        <input style="margin-top: 10px;cursor: pointer; background-color: rgb(239, 37, 175); color: white;" type="button" id="btn-ThongKe1" value="Thống kê" onclick="thongKe1()">
                    </div>
                </div>
                <style>
                    .form-gr {
                        margin-top: 10px;
                        
                    }
                    .button input{
                        border-radius: 5px;
                        
                    }
                </style>

                <div class="ListSPThongKe">
                    
                </div>

            </div>
        </div>
<?php include 'inc/footer.php';?>
<!-- Hiển thị biểu đồ -->
<script type="text/javascript">
    function thongKe1() {
        var ngaybd = document.querySelector('#ngaybd').value;
        var ngaykt = document.querySelector('#ngaykt').value;
        var loai = document.querySelector('#chonloai').value;
        $.ajax({
            type: "POST",
            url: "http://localhost:81/Web2-master/admin/xulyThongKe.php",
            data: {
            ngaybd: ngaybd,
            ngaykt: ngaykt,
            loai: loai
            },
            success: function (response) {
                var jsonData = JSON.parse(response);

                var html = `<table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width="15%"></th>
                            <th width="30%">Sản phẩm</th>
                            <th width="25%">Số lượng bán</th>
                            <th width="30%">Tổng tiền</th>
                        </tr>
			        </thead>
                    <tbody>`;
                var spbanchay = '';
                var maxSL = -1;
                for (var i = 0; i < jsonData.length; i++) {
                    var product = jsonData[i];
                    if(maxSL < product.TotalQuantity && i<(jsonData.length-1)){
                        spbanchay = product.ProductName;
                        maxSL = product.TotalQuantity;
                    }
                    html += '<tr class="odd gradeX">';
                    html += '<td></td>';
                    html += '<td>' + product.ProductName + '</td>';
                    html += '<td>' + product.TotalQuantity + '</td>';
                    html += '<td>' + product.TotalRevenue + '.đ</td>';
                    html += '</tr>';
                }
                html+=`<tr class="odd gradeX">
                            <td style="color: black;font-weight: 700;">Sản phẩm bán chạy</td>
                            <td style="color: black;font-weight: 700;">`+ spbanchay + `</td>
                            <td></td>
                            <td></td>
                        </tr>
			            </tbody>
                    </table>`;
                $('.ListSPThongKe').html(html);
                
            }, error: function(response) {
                // Xử lý lỗi (nếu có)
                console.log(response.responseText);
                }
        });
    }
</script>