<?php

	include 'inc/header.php';

	// if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
	// 	$quan = $_POST["quan"];
	// 	$cartid = $_POST["cartid"];
	// 	$cartupdate = $cart->update_quan($quan, $cartid); 
	// }

	if(isset($_GET["idCT"])){
		$id = $_GET["idCT"];
		$result = $donhang->updateState($id);
		$listSpMua = $chitietdonhang->getListCTDH($id);
		$result = $pro->updateQuantity11($listSpMua);
        if($result){
            echo "<script>
					window.location.href = 'http://localhost:81/Web2-master/donhang.php';
			</script>";
        } else {

        }
	} //getListCTDH($id)

	if(isset($_GET["idDHConfirm"])){
		$id = $_GET["idDHConfirm"];
		$result = $donhang->updateState111($id);
		if($result){
            echo "<script>
					window.location.href = 'http://localhost:81/Web2-master/donhang.php';
			</script>";
        } else {

        }
	}


	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idHD'])){
        // $id = $_POST['chitietcartid'];
		// $soluong = $_POST['quanlity'];
		// $updateChitietCart = $chitietcart->update_chitietCart($id, $soluong);
        echo `<script>
                var element = document.querySelector('.tbhidden');
                element.style.display = "none";
            </script>`;
    }

?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="width: 200px;">Các đơn hàng</h2>
					
						<table class="tblone tbhidden">
							<tr>
								<th width="10%">Đơn hàng</th>
								<th width="20%">Ngày lập</th>
								<th width="20%">Tổng tiền</th>
								<th width="15%">Action</th>
                                <th width="15%">State</th>
                                <th width="10%">Hủy</th>
								<th width="10%">Nhận hàng</th>
							</tr>
							<?php
                                $cusId = Session::get('customerid');
								$donhangs = $donhang->show_hoadon_byIdCus($cusId);

								if($donhangs){
									while ($donhang = $donhangs->fetch_assoc()) {																			
							?>
							<tr>
								<td>
                                    <?php echo $donhang["id"]?>
								</td>
								<td>
									<?php echo $donhang["createDate"]?>
								</td>
								<td><?php echo $donhang["tongTien"]?></td>
								<td>
                                    <form action="./orderdetail.php" method="post">
                                        <input type="hidden" name="idHD" value="<?php echo $donhang["id"]?>"/>
                                        <input type="submit" name="loadchitiet" value="Xem chi tiết"/>
									</form>
                                </td>
                                <td><?php 
                                    if($donhang["state"] == 1){
                                        echo "Đang giao";
                                    } else if($donhang["state"] == 0){
                                        echo "Đang chờ xác nhận";
                                    } else if($donhang["state"] == 2)
                                        echo "Đã nhận";
                                    else 
                                        echo "Đã hủy"
                                ?></td>
                                <td>
                                    <?php 
                                        if ($donhang["state"] != -1 && $donhang["state"] != 2) {
                                            $id = $donhang['id'];
                                            $html = '<a href="?idCT=' . $id . '" style="background-color: black; height: 20px; color: white; border-radius: 5px; width: 100px; cursor: pointer;">Hủy</a>';
                                            echo $html;
                                        }                                        
                                    ?>
                                    
                                </td>
								<td>
                                    <?php 
                                        if ($donhang["state"] == 1) {
                                            $id = $donhang['id'];
                                            $html = '<a href="?idDHConfirm=' . $id . '" style="background-color: red; height: 20px; border-radius: 5px; color: white; width: 100px; cursor: pointer;">Confirm</a>';
                                            echo $html;
                                        }                                       
                                    ?>
									<!-- <style>
										.h {
											
										}
									</style> -->
                                </td>
							</tr>
							<?php
									// $proInCart+=1;
									// $subtotal+= $total;
									}
									// Session::set("ProInCart",$proInCart);
								}
							?>
							
							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							
					</table>
					</div>
					<div class="shopping">
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php

	include 'inc/footer.php';

?>	