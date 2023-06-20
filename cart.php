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
	// $id = $_GET['id'];
	if(isset($_GET['cartid'])){
		$cusId = Session::get('customerid'); 
		$cartId = $cart->getId($cusId);
		$idCT = $_GET['cartid'];
		$result = $chitietcart->deleteByID($idCT);
		echo "<script>
					window.location.href = 'http://localhost:81/Web2-master/cart.php?id=$cartId';
			</script>";
	}

	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['chitietcartid'];
		$soluong = $_POST['quanlity'];
		$updateChitietCart = $chitietcart->update_chitietCart($id, $soluong);
    }

?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Cart</h2>
					<?php
					if(isset($cartupdate)){
						echo $cartupdate;
					}
					if(isset($cart_del)){
						echo $cart_del;
					}
					?>
						<table class="tblone">
							<tr>
								<th width="2%"></th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="14%">Price</th>
								<th width="24%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$get_pro_cart = $chitietcart->getChitietCart($_GET['id']);

								if($get_pro_cart){
									$subtotal = 0;
									$proInCart = 0;
									while ($pro = $get_pro_cart->fetch_assoc()) {																			
							?>
							<tr>
								<td>
									<input type="checkbox" id="vehicle1" name="selectedItems[]" value="<?php echo $pro['id'] ?>">
								</td>
								<td>
									<?php echo $pro["productName"]?>
								</td>
								<td><img src="admin/uploads/<?php echo $pro['image']?>" alt=""/></td>
								<td><?php echo $pro["price"].".đ"?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="chitietcartid" value="<?php echo $pro["id"]?>"/>
										<input type="number" name="quanlity" min="1" value="<?php echo $pro["SoLuong"]?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td> 
								<?php
									$total = $pro["SoLuong"] * $pro["price"];
									echo $total.".đ";							
								?></td>
								<td><a href="?cartid=<?php echo $pro['id']?>">Xóa</a></td>
							</tr>
							<?php
									$proInCart+=1;
									$subtotal+= $total;
									}
									Session::set("ProInCart",$proInCart);
								}
							?>
							
							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							
					</table>
					</div>
					<div class="shopping">
						<div class="shopright">
							<button type="button" id="btn-checkout" onclick="xulyCheckout()">CHECK OUT <i class="ti-direction"> </i></button>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php

	include 'inc/footer.php';

?>	