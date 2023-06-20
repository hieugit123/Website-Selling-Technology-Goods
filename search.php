<?php
	include 'inc/header.php';

    if(isset($_POST["search"])){
        $listPro = $pro->search_product($_POST);
    }
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Search results by keyword: <?php echo $_POST["keyword"]?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group" id="listttt">
			<?php
                if($listPro){
                    while ($product = $listPro->fetch_assoc()) {
							
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img style="height:220px" src="admin/uploads/<?php echo $product['image']?>" alt="" /></a>
					 <h2><?php echo $product['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($product['productDesc'],30); ?></p>
					 <p><span class="price"><?php echo $product['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $product['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
                    }
                }else {
                    echo "<h3>No products were found!</h3>";
                }
			?>
			</div>

	
	
    </div>
 </div>
<?php

	include 'inc/footer.php';

?>	