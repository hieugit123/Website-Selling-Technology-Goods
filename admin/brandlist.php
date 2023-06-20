<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    $brand = new brand();
	if (isset($_GET['delId']) && $_GET['delId'] != NULL){
		$del = $brand->del_brand($_GET['delId']);
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>brand List</h2>
				<?php
					if(isset($del)){
						echo '<span>';
						echo $del;
						echo '</span>';
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$show_brand = $brand->show_brand();
							if($show_brand){
								$i = 0;
								while ($result = $show_brand->fetch_assoc()) {
									$i++;
								
						?>
									<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><?php echo $result['brandName'];?> </td>
									<td><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a> || 
									<a href="?delId=<?php echo $result['brandId'] ?>">Delete</a></td>								
									</tr>
						<?php
								}
							}		
						?>

					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

