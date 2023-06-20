<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>

<?php
    $pro = new product();

    // if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

    //     $insertSilder = $pd->insert_slider($_POST,$_FILES);
    // }

	if(isset($_GET['delId'])){
		$delResult = $pro->del_slider($_GET['delId']);
	}

	if(isset($_GET['id']) && isset($_GET['type'])){
		$delResult = $pro->update_slider($_GET['id'],$_GET['type']);
	}

?>
<style>
	
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
		<?php
			if(isset($delResult)){
				echo $delResult;
			}
		?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<td>Type</td>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$list = $pro->get_all_slider();
					
					if($list){
						$i = 0;
						while ($slider = $list->fetch_assoc()) {
							$i++;
							echo '<tr class="odd gradeX">
							<td>'.$i.'</td>
							<td>'.$slider["title"].'</td>
							<td><img src="uploads/'.$slider["image"].'" height="40px" width="60px"/></td>				
							<td>';
							if($slider['type']=='0'){
								echo '<a href="?id='.$slider["id"].'&type=1" style="color:#9aff3d">turn On</a> </td>';
							}else{
								echo '<a href="?id='.$slider["id"].'&type=0" style="color:red">turn Off</a> </td>';
							}
							
							?>
								<td><a href="?delId=<?php echo $slider['id']?>"  onclick="return confirm('Are you sure to delete slider ?')" >Delete</a> 
							</td>
							</tr>'
							
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
