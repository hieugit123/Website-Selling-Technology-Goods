<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';

	include '../helpers/format.php';
    include '../lib/database.php';

	spl_autoload_register(function ($classname)
	{
		include_once "../classes/".$classname.".php";
	});

	$chitietDH = new chitietdonhang();
	$fm = new Format();
	
	// if(isset($_GET["shiftId"])){
	// 	$shifted = $cart->set_shifted($_GET["shiftId"]);
	// }

	//chắc là xóa đơn hàng
	// if(isset($_GET["delId"])){
	// 	$shifted = $cart->del_ordered($_GET["delId"]);
	// }
    $id = $_POST['idHD'];
	$listCT = $chitietDH->getCTDHBy_Id($id);

?>
<style>
a:hover{
	color: red;
}

</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php
					if (isset($shifted)) {
						echo $shifted;
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="23%">Product Name</th>
							<th width="17%">Image</th>
							<th width="20%">Quantity</th>
							<th width="20%">Unit price</th>
							<th width="20%">Into money</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if ($listCT) {
								while ($pro = $listCT->fetch_assoc()) {
									// $i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $pro["productName"]?></td>
							<td><img style="width: 30px; height: 30px;" src="uploads/<?php echo $pro['image']?>" alt=""/></td>
							<td><?php echo $pro["SoLuong"]?></td>
							<td><?php echo $pro["DonGia"]?></td>
							<td><?php echo $pro["ThanhTien"].".đ"?></td>
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
