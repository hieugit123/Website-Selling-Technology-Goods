<?php
	ob_start();
	include 'inc/header.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertCustomer = $customer->insert_customer($_POST);
		$id = $customer->getID();
		$cart->add_to_cart($id);
    }

	// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    //     $checklogin = $customer->check_login($_POST);
	// 	if($checklogin)
	// 		header("Location:index.php");
    // }
	$current_page = $_SERVER['PHP_SELF'];
	$login_page = '/login.php';

	if ($current_page === $login_page) {
		// Bạn đang ở trang login.php
		if($checklogin){
			header("Location:index.php");
		}
	}

?>
<!-- <script src></script> -->
 <div class="main">
    <div class="content">
		<div class="content_top content_top_center">
    		<div class="heading">
    		<h3>Login form</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		
    	 <div class="login_panel">
        	<h3>Login</h3>
			<div class="showloi">
			<?php
				if (isset($checklogin)) {
					if(!$checklogin)
					{
						$alert = "<span class = 'successfull' style='color:red'> Email and Password do not match !! </span>";
						echo $alert;
					}
				}
			?>
			</div>
        	<form action="" method="POST" id="member">
				<input  type="text" name="user" id="user" class="field" placeholder="Email" required>
				<input  type="password" name="pass" id="pass" class="field" placeholder="Password" required>
				
				<div class="buttons"><div><button type="button" name="login" class="grey login_buton" style="padding:8px; margin-top:2px" onclick="xulyLoginAjax()">Login</button></div></div>
			</form>
         </div>
    		<div class="clear"></div>

		 <div class="content_top content_top_center">
    		<div class="heading">
    		<h3>Register form</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
				if (isset($insertCustomer)) {
					echo $insertCustomer;
				}
			?>
    		<form action="" method="POST">
		   			 <table class="profile_table">
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="Name" placeholder="Name" required>
							</div>
							
							<div>
							   <input type="text" name="City" placeholder="City" required >
							</div>
							
							<div>
								<input type="text" name="Zip-Code" placeholder="Zip-code" required>
							</div>
							<div>
								<input type="text" name="E-Mail" placeholder="E-Mail" required>
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="Address" placeholder="Address" required>
						</div>
		    		<div>
						<select id="country" name="Country" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="VN">Viet Nam</option>
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
		          <input type="text" name="Phone" placeholder="Phone" required>
		          </div>
				  
				  <div>
					<input type="password" style="font-size: 12px;color: #B3B1B1;padding: 8px; outline: none;margin: 5px 0;width: 340px;" name="Password" placeholder="Password" required>
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="login_buton grey" value="Create Account" style="padding:6px; margin-top:2px"></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
	ob_end_flush();
?>	