<?php

 	include 'inc/header.php';
// //	include 'inc/slider.php';
// 	if(isset($_GET['proid']) && $_GET['proid']!=NULL){
// 				$id = $_GET['proid'];
// 			}else{
// 				echo "<script> window.location = '404.php'</script>";
// 			}
// 	$product = $pro->ShowDetail($id);

// 	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
// 		$quan = $_POST["quantity"];
//        $addtocart = $cart->add_to_cart($id,$quan);
//     }

    $checklogin = Session::get('checklogin');
        if($checklogin == false){
            echo header("Location:login.php");
        }
	
    $cusId =   Session::get('customerid');  
    $cus = $customer->get_by_id($cusId);

?>
 <div class="main">
    <div class="content">
		<div class="section group">
			<div class="content_top">
                <div class="heading">
                <h3>Profile</h3>
                </div>
    		    <div class="clear"></div>
            </div>
            <table class="tblone">
                <?php
                    if($cus){
                        while ($info = $cus->fetch_assoc()) {                           
                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?php echo $info["name"]?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $info["city"]?> </td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $info["country"]?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $info["address"]?> </td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $info["phone"]?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $info["email"]?> </td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $info["zipcode"]?> </td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Edit profile</a></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
    	</div>
 	</div>
</div>
<?php

	include 'inc/footer.php';

?>	