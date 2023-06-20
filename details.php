<?php

	include 'inc/header.php';
//	include 'inc/slider.php';
	if(isset($_GET['proid']) && $_GET['proid']!=NULL){
				$id = $_GET['proid'];
			}else{
				echo "<script> window.location = '404.php'</script>";
			}
	$product = $pro->ShowDetail($id);

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		if($checkLogin){
			$cus = Session::get("customerid");
			$cartId = $cart->getId($cus);
			$soluong = $_POST["quantity"];
       		$addtocart = $chitietcart->update_chitietCart_bynow($cartId, $id, $soluong);
			echo "<script>window.location.href = 'http://localhost:81/Web2-master/cart.php?action=cart';</script>";
		} else {
			echo "<script>window.location.href = 'http://localhost:81/Web2-master/login.php';</script>";
		}
    }

?>
 <div class="main">
    <div class="content">
		<div class="content_top">
    		<div class="heading">				
    		<h3><?php
			
				if($product){
					$progetted = $product->fetch_assoc();
					echo $progetted["catName"].' > '.$progetted["brandName"];					
				}

							
			 	?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>	
		<div class="section group">
			<?php
				if($product){				
			 	
							
			 ?>
					 <div class="cont-desc span_1_of_2 product_detail_wrap">				
						 <div class="grid images_3_of_2">
							 <img src="admin/uploads/<?php echo $progetted['image']?>" alt="" />
						 </div>
					 <div class="desc span_3_of_2">
						 <h2><?php echo $progetted['productName']; ?> </h2>
						 <!-- <p><?php echo $fm->textShorten($progetted['productDesc'],150); ?></p>					 -->
						 <div class="price">
							 <p>Price: <span><?php echo $progetted['price']; ?> VND</span></p>
							 <p>Category: <span><?php echo $progetted['catName']; ?></span></p>
							 <p>Brand:<span><?php echo $progetted['brandName']; ?></span></p>
						 </div>
					 <div class="add-cart">
						 <form action="" method="post">
							 <input type="hidden" name="chitietcartid" value="<?php echo $progetted["productId"]?>"/>
							 <input type="number" class="buyfield" name="quantity" value="1" min="1"/>
							 <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						 <?php
						 if(isset($addtocart)){
							echo "<h2 style='color: blue; '>$addtocart</h2>";
						 }
						 ?>				
						 </form>
					 </div>
				 </div>
				 <div class="product-desc">
				 <div class="content_top">
    		<div class="heading">				
    		<h3>Description</h3>
    		</div>
    		<div class="clear"></div>
    	</div>	
				<p><?php echo $progetted['productDesc']; ?></p>					
				</div>			
	</div>
				 <?php
				}
				?>
				<div class="rightsidebar span_3_of_1">
					   	
				</div>
				
 		</div>
 	</div>
<?php

	include 'inc/footer.php';

?>	