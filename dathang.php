<?php

	include 'inc/header.php';

	// if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
	// 	$quan = $_POST["quan"];
	// 	$cartid = $_POST["cartid"];
	// 	$cartupdate = $cart->update_quan($quan, $cartid); 
	// }

	// if(isset($_GET["cartid"])){
	// 	$cartdelid = $_GET["cartid"];
	// 	$cart_del = $cart->delete_product($cartdelid);
	// }
	if(isset($_GET['id'])){

	}

	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}

	// if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     $id = $_POST['chitietcartid'];
	// 	$soluong = $_POST['quanlity'];
	// 	$updateChitietCart = $chitietcart->update_chitietCart($id, $soluong);
    // }

?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Cart</h2>
						<table class="tblone">
							<tr>
                                <th width="10%"></th>
								<th width="23%">Product Name</th>
								<th width="13%">Image</th>
								<th width="20%">Price</th>
								<th width="14%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
							<?php
								$listCTID = Session::get("listSP");
								if($listCTID){
                                $listCT = $chitietcart->getChitietCartByIds($listCTID);
								if($listCT){
									$subtotal = 0;
									while ($pro = $listCT->fetch_assoc()) {																			
							?>
							<tr>
                                <td></td>
								<td>
									<?php echo $pro["productName"]?>
								</td>
								<td><img src="admin/uploads/<?php echo $pro['image']?>" alt=""/></td>
								<td><?php echo $pro["price"].".đ"?></td>
								<td>
                                    <?php echo $pro["SoLuong"]?>							
								</td>
								<td> 
								<?php
                                    $thanhtien = $pro["price"] * $pro["SoLuong"];
									echo $thanhtien.".đ";						
								?></td>
							</tr>
							<?php
									$subtotal += $pro["price"] * $pro["SoLuong"];
									}
									Session::set("tongtien",$subtotal);
								}
							?>
                            <tr>
                                <td style="font-size: 20px;">Tổng tiền</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: black; font-weight: 500;">
                                <?php 
                                    $tongtien = Session::get("tongtien");
                                    echo $tongtien.".đ";
							}
                                ?>
                                </td>
                            </tr>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							
					</table>
					</div>
					<div class="shopping">
						<div class="shopright">
							<button type="button" id="btn-checkout" onclick="xulyMuahang()">CONFIRM<i class="ti-direction"> </i></button>
						</div>
                        
					</div>
                    
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php

	include 'inc/footer.php';

?>	