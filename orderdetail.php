<?php

	include 'inc/header.php';

    $cusId =   Session::get('customerid');

?>
<style>
    h2{
        width: auto !important;
    }

    .status{
        color:#ff9d2d;
    }
</style> 
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Order details</h2>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="20%">Price</th>
								<th width="20%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
							<?php
								$chitietDH = $chitietdonhang->getCTDHBy_Id($_POST['idHD']);

								if($chitietDH){
									while ($chitiet = $chitietDH->fetch_assoc()) {																			
							?>
							<tr>
								<td><?php echo $chitiet["productName"]?></td>
								<td><img src="admin/uploads/<?php echo $chitiet['image']?>" alt=""/></td>
								<td><?php echo $chitiet["DonGia"]?></td>
								<td>
										<?php echo $chitiet["SoLuong"]?>
								</td>
								<td>
									<?php echo $chitiet["ThanhTien"]?>							
								</td>
							</tr>
							<?php
									}
								}
							?>
							
							
						</table>
					</div>

					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php

	include 'inc/footer.php';

?>	