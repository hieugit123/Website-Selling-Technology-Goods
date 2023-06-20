<?php

 	include 'inc/header.php';

    $checklogin = Session::get('checklogin');
        if($checklogin == false){
            echo header("Location:login.php");
        }
	
    $cusId =   Session::get('customerid');  
    $cus = $customer->get_by_id($cusId);

    if (isset($_GET["orderid"])) {
        $insertOrder = $cart->insert_order($cusId);
        $delcart = $cart->del_all_cart(); 
        header("Location:success.php");
    }

    // $checklogin = Session::get('checklogin');
    //     if($checklogin == false){
    //         echo header("Location:login.php");
    //     }
	
    // $cusId =   Session::get('customerid');  
    // $cus = $customer->get_by_id($cusId);

?>
<style>
    .order-submit{
    width: fit-content;
    display: block;
    margin: 20px;
    background: #15e715;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5%;
    }

    .order-submit:hover{
        opacity: 0.8;
        cursor: pointer;
    }

    .content_top{
        text-align: center;
        
    }

    .heading{
        margin: auto;
        width: 100%;
    }

    h3{
        color: #43fe43 !important;
    }
</style>
 <div class="main">
    <div class="content">
		<div class="section group">
			<div class="content_top">
                <div class="heading">
                    <center><h3>Order Succsess</h3></center>
                
                </div>
                
    		    <div class="clear"></div>                            
                <a href="orderdetail.php">Click here to see your orders.</a>
            </div>      
            </div>
    	</div>
 	</div>
</div>
<?php

	include 'inc/footer.php';

?>	