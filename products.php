<?php
	include 'inc/header.php';
	include 'inc/slider.php';

	if (isset($_GET["page"])) {
		$listproduct = $pro->get_pro_page($_GET["page"]);
	}else{
		$listproduct = $pro->get_pro_page(1);
	}
?>
<style>
	/**** Grid 1_0f_4 ****/

</style>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Products</h3>
    		</div>
    		<div class="clear"></div>			
    	</div>
			<ul>
				<?php
					$count_product = 0;
					$list = $pro->show_product();
					while($item = $list->fetch_assoc()){
						$count_product++;
					}

					$productInPage = 8;
					$pages = ceil($count_product/$productInPage);

					for($i=1;$i<=$pages;$i++){
						// echo '<li class="pages" id="page'.$i.'"><a href="?page='.$i.'">'.$i.'</a></li>';
						echo '<li class="pages"  id="page'.$i.'" 
						
						>'.$i.'</li>';

					}
					echo "<input id='numPage' type='hidden' value='$pages'/> "
				?>
				
			</ul>
	      <div class="section group" id ="section">

			<?php

				if($listproduct){
					while ($product = $listproduct->fetch_assoc()) {
							
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img style="height:220px" src="admin/uploads/<?php echo $product['image']?>" alt="" /></a>
					 <h2><?php echo $product['productName']; ?> </h2>
					 <?php echo $fm->textShorten($product['productDesc'],30); ?>
					 <p><span class="price"><?php echo $product['price']; ?> .đ</span></p>
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

 <style>
	#section{
		min-height:500px;
	}
 </style>
 <script>
			var numPage = document.querySelector("#numPage").value;

			var pages = document.querySelectorAll(".pages")

			console.log(pages);

			for(var i = 0; i < numPage; i++) {
				console.log(pages[i]);
				pages[i].onclick = function () {
					$.ajax({
					type: "GET",
					url: "loadproductajax.php",
					data: "id=" + this.id,
					success: function (reponse) {
						$("#section").html(reponse);
					}
					});
				};						
			}
			function a(obj) {
			
			}
			
           
        
 </script>
<?php

	include 'inc/footer.php';

?>	