	<div class="header_bottom">
		<div class="header_bottom_right_images">
		   		<!-- FlexSlider -->
             
				<section class="slider">
					<div class="flexslider">
						<ul class="slides">
							<?php
								$listSlider = $pro->show_slider();
								if($listSlider){
									while ($slider = $listSlider->fetch_assoc()) {
										
									
							?>
							<li><img src="admin/uploads/<?php echo $slider['image']?>" alt=""/></li>
							<?php
									}
								}
							?>
						</ul>
					</div>
				</section>
				<!-- FlexSlider -->
	    	</div>
		<div class="header_bottom_left">
			<div class="content_top">
    		<div class="heading">
    		<h3><i class="ti-star"></i> Popular Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$getLastestMacbook = $pro->getLastestMacbook();
					if ($getLastestMacbook) {
						$LastestMacbook = $getLastestMacbook->fetch_assoc();
					}

					$getLastestIphone = $pro->getLastestIphone();
					if ($getLastestIphone) {
						$LastestIphone = $getLastestIphone->fetch_assoc();
					}

					$getLastestSamsung = $pro->getLastestSamsung();
					if ($getLastestSamsung) {
						$LastestSamsung = $getLastestSamsung->fetch_assoc();
					}

					$getLastestCannon = $pro->getLastestCannon();
					if ($getLastestCannon) {
						$LastestCannon = $getLastestCannon->fetch_assoc();
					}
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/<?php echo $LastestMacbook['image']?>" alt="" /></a>
					</div>					
				    <div class="text list_2_of_1">
						<h2>Macbook</h2>
						<p><?php echo $LastestMacbook['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $LastestMacbook['productId']?>">Buy now</a></span></div>
				   </div>
			   </div>	

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/<?php echo $LastestSamsung['image']?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $LastestSamsung['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $LastestSamsung['productId']?>">Buy now</a></span></div>
					</div>
				</div>
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/<?php echo $LastestIphone['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $LastestIphone['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $LastestIphone['productId']?>">Buy now</a></span></div>
				   </div>
			   </div>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/<?php echo $LastestCannon['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p><?php echo $LastestCannon['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $LastestCannon['productId']?>">Buy now</a></span></div>
					</div>
				</div>
			</div>
		  <div class="clear"></div>
		</div>
			
	  <div class="clear"></div>
  </div>