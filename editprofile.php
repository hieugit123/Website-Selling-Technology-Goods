<?php
	include 'inc/header.php';

	// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    //     $insertCustomer = $customer->insert_customer($_POST);
    // }
    $cusId =   Session::get('customerid');  

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $editresult = $customer->edit_customer($_POST,$cusId);
    }

    $checklogin = Session::get('checklogin');
        if($checklogin == false){
            echo header("Location:login.php");
        }
	$cus = $customer->get_by_id($cusId);


?>
<style>
	input[type=text]{
		margin: 0px 0px 10px 0px !important;
	}
	select{
		margin: 0px 0px 10px 0px !important;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="register_account profile" style="height:auto">
    		<h3>Edit Profile</h3>
			<?php
				if (isset($editresult)) {
					echo $editresult;
				}
			?>
    		<form action="" method="POST">
                <?php
                    if($cus){
                        while ($info = $cus->fetch_assoc()) {                           
                ?>
		   			 <table class="profile_table">
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="Name" value="<?php echo $info["name"]?>" required>
							</div>
							
							<div>
							<input type="text" name="City" value="<?php echo $info["city"]?>" required >
							</div>
							
							<div>
							<input type="text" name="Zip-Code" value="<?php echo $info["zipcode"]?>" required>
							</div>

		    			 </td>
		    			<td>
						<div>
							<input type="text" name="Address" value="<?php echo $info["address"]?>" required>
						</div>
		    		<div>
                        
						<select id="country" name="Country" class="frm-field required" required>
							<option value="null">Select a Country</option>         
							<option value="VN" selected>Viet Nam</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="Phone" value="<?php echo $info["phone"]?>" required>
		          </div>
				  
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="buysubmit grey" value="Update" style="padding:6px; margin-top:2px"></div></div>
		    <div class="clear"></div>
            <?php
                        }
                    }
                ?>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php

	include 'inc/footer.php';

?>	