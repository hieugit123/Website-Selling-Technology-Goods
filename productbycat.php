<?php
	include 'inc/header.php';

    if(isset($_GET['catId']) && $_GET['catId']!=NULL){
		$catId = $_GET['catId'];
        $catName = $cat->getnamebyid($catId);
		
    }else{
        echo "<script> window.location = '404.php'</script>";
    }
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Category: <?php echo $catName?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
				$listPro = $cat->get_pro_by_catId($catId);
						if($listPro){
							while ($pro = $listPro->fetch_assoc()) {
							
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img style="height:220px" src="admin/uploads/<?php echo $pro['image']?>" alt="" /></a>
					 <h2><?php echo $pro['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($pro['productDesc'],30); ?></p>
					 <p><span class="price"><?php echo $pro['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $pro['productId']; ?>" class="details">Details</a></span></div>
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