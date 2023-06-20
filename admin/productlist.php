<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/category.php';?>
<?php include_once '../helpers/format.php';?>

<?php
	$fm = new Format();
	$pro = new product();
	if (isset($_GET['DelId']) && $_GET['DelId'] != NULL){
		echo '<script>
				alert("Bạn có chắc không!");
			</script>';
		$del = $pro->del_pro($_GET['DelId']);
		echo "<script>
					window.location.href = 'http://localhost:81/Web2-master/admin/productlist.php';
			</script>";
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
		<?php
			if(isset($del)){
				echo '<span>';
				echo $del; 
				echo '</span>';
			}
		?>
		
		<div class="form-confirm">
			<h2>Bạn có chắc không</h2>
			<a href="?DelId">Delete</a>
			<a href="?cancel">Cancel</a>
			</div>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Description</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Image</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$list = $pro->show_product();

					while ($result = $list->fetch_assoc()) {	
					if($result['state'] == 1) {				
					$cat = new category();
					$brand = new brand();
				?>
					<tr class="odd gradeX">
						<td><?php echo $result['productId']; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td><?php echo $fm->textShorten($result['productDesc'], 50) ; ?></td>
						<td><?php echo $cat->getnamebyid($result['catId']); ?></td>
						<td><?php echo $brand->getnamebyid($result['brandId']); ?></td>
						<td><?php echo $result['SoLuong']; ?></td>
						<td> <?php echo $result['price'].".đ"; ?></td>
						<td> <img src="uploads/<?php echo $result['image']; ?> " alt="" width= '50px'> </td>
						<td><a href="productedit.php?productId=<?php echo $result['productId']; ?>">Edit</a> || <a href="?DelId=<?php echo $result['productId']; ?>">Delete</a>

						</td>
					</tr>
				<?php
					}
					}
				?>
			</tbody>
		</table>

		<style>
			.form-confirm {
				width: 120px;
				height: 85px;
				background-color: gold;
				position: absolute;
				display: none;
			}
			.form-confirm h2{
				font-size: 12px;
				background-color: gold;
				padding: 0;
				margin: 0;
				color: white;
				border-bottom: none;
			}
			.form-confirm a{
				font-size: 14px;
				width: 40px;
				background-color: black;
				color: white;
			}
		</style>
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
