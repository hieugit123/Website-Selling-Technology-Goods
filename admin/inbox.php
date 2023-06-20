<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';

	include '../helpers/format.php';
    include '../lib/database.php';

	spl_autoload_register(function ($classname)
	{
		include_once "../classes/".$classname.".php";
	});

	$donhang = new donhang();
	$chitietDH = new chitietdonhang();
	$product = new product();
	$fm = new Format();
	
	if(isset($_GET["shiftId"])){
		$id = $_GET["shiftId"];
		$donhang->updateStateByAdmin($id);
		$listSPMua = $chitietDH->getListCTDH($id);
		$product->updateQuantity($listSPMua);
		echo "<script>
					window.location.href = 'http://localhost:81/Web2-master/admin/inbox.php';
			</script>";
	}

	//chắc là xóa đơn hàng
	if(isset($_GET["delId"])){
		$shifted = $cart->del_ordered($_GET["delId"]);
	}

	$getAllOrder = $donhang->getAllDH();

?>
<style>
a:hover{
	color: red;
}

</style>
        <div class="grid_10">
			<div class="searchKhoang" style="text-align: left; margin: 15px 0 30px 0;">
				<form action="" method="post">
					<input style="height: 25px;" type="date" placeholder="Nhập ngày bắt đầu" name="datebd" id="ngaybd">
					<input style="height: 25px;" type="date" placeholder="Nhập ngày kết thúc" name="datekt" id="ngaykt">
					<button style="width: 65px; height: 30px; border-radius: 10px; font-size: 12px; cursor: pointer;" 
					type="button" name="btn-searchKhoang" id="btn-searchKhoang" onclick="searchTheoKhoang()">SEARCH</button>
				</form>
			</div>
            <div class="box round first grid">
                <h2>Orders</h2>
				<?php
					if (isset($shifted)) {
						echo $shifted;
					}
				?>
                <div class="block showSearch">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="7%">Serial No.</th>
							<th width="20%">Date</th>
							<th width="15%">Total money</th>
							<th width="15%">Customers</th>
							<th width="23%">Status</th>
							<th width="20%">Detail</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
							if ($getAllOrder) {
								while ($pro = $getAllOrder->fetch_assoc()) {
									$i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $pro["createDate"]?></td>
							<td><?php echo $pro["tongTien"].".đ"?></td>
							<td><a href="customer.php?cusId=<?php echo $pro["customerId"]?>">Cumtomer</a></td>
							<td><?php 
                                    if($pro["state"] == 0){										
                                        echo "<a href='?shiftId=".$pro["id"]."'>pending</a>";
                                    }else if($pro["state"] != -1){
                                        echo "processed";
                                    } else 
										echo "canceled";
                            ?></td>
							<td>
									<form action="chitietHD.php" method="post">
                                        <input type="hidden" name="idHD" value="<?php echo $pro["id"]?>"/>
                                        <input type="submit" name="loadchitiet" id="loadCT" value="Xem chi tiết"/>
									</form>
							</td>
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

        // $('.datatable').dataTable();
        // setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
