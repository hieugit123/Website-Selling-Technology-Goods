<?php

	include 'inc/header.php';
	include 'inc/slider.php';
?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3><i class="ti-star"></i> Feature </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
				$prolist = $pro->Get_Feature_Product();
				while ($pro_item = $prolist->fetch_assoc()) {
									
			?>
				<div class="grid_1_of_4 images_1_of_4" style="height:389.62 px !important">
					 <a href="details.php?proid=<?php echo $pro_item['productId'] ?>"><img style="height=220px" src="admin/uploads/<?php echo $pro_item['image']; ?>" alt="" width = 220 height = 220 /></a>
					 <h2><?php echo $pro_item['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($pro_item['productDesc'],30); ?></p>
					 <p><span class="price"><?php echo $pro_item['price']; ?> đ</span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $pro_item['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
				}
			?>	
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3><i class="ti-star"></i> New</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
				$pronewlist = $pro->Get_New_Product();
				while ($pro_Newitem = $pronewlist->fetch_assoc()) {
									
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $pro_Newitem['productId'] ?>"><img src="admin/uploads/<?php echo $pro_Newitem['image']; ?>" alt="" width = 220 height = 220 /></a>
					 <h2><?php echo $pro_Newitem['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($pro_Newitem['productDesc'],30); ?></p>
					 <p><span class="price"><?php echo $pro_Newitem['price']; ?> .đ</span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $pro_Newitem['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
				}
			?>
			</div>
    </div>
 </div>

<?php

	include 'inc/footer.php';

?>	