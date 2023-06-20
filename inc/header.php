<?php
	ob_start();
    include 'lib/session.php';
	 Session::init();
    include 'helpers/format.php';
    include 'lib/database.php';

	spl_autoload_register(function ($classname)
	{
		include_once "classes/".$classname.".php";
	});
	
	$db = new Database();
	$fm = new Format();
	$cat = new category();
	$user = new user();
	$cart = new cart();
	$pro = new product();
	$brand = new brand();
	$customer = new customer();
	$chitietcart = new chitietCart();
	$donhang = new donhang();
	$chitietdonhang = new chitietdonhang();
	$checkLogin = Session::get("checklogin");

	// if($check)
    if(isset($_GET['action']) && $_GET['action'] == "cart") {
      if($checkLogin) {
        $cusId = Session::get('customerid'); 
		$cartId = $cart->getId($cusId);
		$soluong = $chitietcart->getSoLuongSP($cartId);
        echo "<script>
					window.location.href = 'http://localhost:81/Web2-master/cart.php?id=$cartId';
			</script>";
      } else {
		// echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href = 'http://localhost:81/Web2-master/login.php';</script>";		
      }
    }
    if(isset($_GET['action']) && $_GET['action'] == "logout"){
      Session::destroy();
      echo "<script>window.location.href = 'http://localhost:81/Web2-master/login.php';</script>";
    }
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/newcss.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/cssnewcode.css" rel="stylesheet" type="text/css" media="all"/>

<link href="css/themify-icons/themify-icons.css" rel="stylesheet" type="text/css" media="all"/>
    

<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Ceviche+One&family=Quicksand&display=swap" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
  function showForm() {
	var check = document.querySelector('.isShow');
	var form = document.querySelector('.form_nangcao');
	if(!check)
	{
		form.style.display = "block";
		form.classList.add("isShow");
	} else {
		form.style.display = "none";
		form.classList.remove("isShow");
	}
  }

  function searchNangcao() {
  var tenSp = document.querySelector('#tensp').value;
  var loai = document.querySelector('#loai').value;
  var mingia = document.querySelector('#mingia').value;
  var maxgia = document.querySelector('#maxgia').value;
  $.ajax({
    type: "POST",
    url: "http://localhost:81/Web2-master/xulysearch.php",
    data: {
      keyword: tenSp,
      brandId: loai,
      mingia: mingia,
      maxgia: maxgia
    },
    success: function (response) {
	var form = document.querySelector('.form_nangcao');
	var form1 = document.querySelector('.header_bottom');
	if(form1)
		form1.style.display = "none";
	form.style.display = "none";
	form.classList.remove("isShow");
    var products = JSON.parse(response);
    var html = `<div class="content_top">
    			<div class="heading">
				<h3>Search results by keyword:</h3>
				</div>
				<div class="clear"></div>
				</div>
				<div class="section group" id="listttt">`;
    if (products.length > 0) {
        for (var i = 0; i < products.length; i++) {
            var product = products[i];
            html += '<div class="grid_1_of_4 images_1_of_4">';
            html += '<a href="preview-3.php"><img style="height:220px" src="admin/uploads/' + product.image + '" alt="" /></a>';
            html += '<h2>' + product.productName + '</h2>';
            html += '<p>' + product.productDesc + '</p>';
            html += '<p><span class="price">' + product.price + '</span></p>';
            html += '<div class="button"><span><a href="details.php?proid=' + product.productId + '" class="details">Details</a></span></div>';
            html += '</div>';
        }
    } else {
        html += '<h3>No products were found!</h3>';
    }
	html += '</div>';
    $('.content').html(html);
	},
    error: function(response) {
      // Xử lý lỗi (nếu có)
      console.log(response.responseText);
    }
  });
}

function xulyLoginAjax(){
		var user = document.querySelector('#user').value;
		var pass = document.querySelector('#pass').value;
		$.ajax({
			type: "POST",
			url: "http://localhost:81/Web2-master/xulyLoginAjax.php",
			data: {
			user: user,
			pass: pass
			},
			success: function (response) {
				if(response.trim() === "success"){
					var html = `<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><span class="sign">Nak Shop</span></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form method="post" action="search.php">
				    	<input type="text" placeholder="Search for products" name="keyword" fdprocessedid="07h6wt">
						<input type="submit" value="SEARCH" name="search" fdprocessedid="c6uou">
						<button type="button" id="showNangcao" onclick="showForm()" fdprocessedid="29h2v">Nâng cao</button>
						<div class="form_nangcao">
							<h2>Tìm kiếm nâng cao</h2>
							
								<div class="form-gr">
									<label for="tensp">Tên sản phẩm</label>
									<input type="text" name="tensp" id="tensp" placeholder="Nhập tên sản phẩm">
								</div>
								<div class="form-gr">
									<label for="loai">Chọn loại</label>
									<select name="loai" id="loai">
										<option value="">---CHỌN---</option>
																				<option value="8">iphone</option>
																				<option value="7">Canon</option>
																				<option value="6">Oppo</option>
																				<option value="4">Macbook</option>
																				<option value="3">Samsung</option>
																				<option value="1">Dell</option>
																			</select>
								</div>
								<div class="form-gr">
									<label>Khoảng giá</label>
									<div class="gia">
										<input type="number" name="mingia" id="mingia" require="" placeholder="Giá nhỏ nhất">
										<input type="number" name="maxgia" id="maxgia" require="" placeholder="Giá lớn nhất">
									</div>
								</div>
								<button type="button" name="searchnangcao" id="searchnangcao" onclick="searchNangcao()">SEARCH</button>
							
						</div></form> 															    
					
			    </div>
			    <div class="wrapp-cart">					
					<div class="cart-icon">
					<a href="?action=cart">
						<i class="ti-shopping-cart"></i>
					</a>
					</div>
					<div class="cart">
						<a href="" title="View my shopping cart" rel="nofollow">
								<span class="no_product">
									</span></a><a class="product_cart"> 0 </a>								
						
					</div>
			    </div>
				
					
					<div class="login">
						<a href='?action=logout'>Logout></a>			
					</div>
						
		 <div class="clear"></div>
	 	</div>
	 <div class="clear"></div>
 </div>
<div class="menu">
<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="products.php" class="dc-mega">Category<span class="dc-mega-icon"></span></a> 
	  	<div class="sub-container non-mega" style="left: 247.137px; top: 59px; z-index: 1000;"><ul class="sub">
							<li><a href="productbycat.php?catId=19">Camera</a></li>
							<li><a href="productbycat.php?catId=18">test</a></li>
							<li><a href="productbycat.php?catId=17">ScreenCard</a></li>
							<li><a href="productbycat.php?catId=16">PC</a></li>
							<li><a href="productbycat.php?catId=15">screen</a></li>
							<li><a href="productbycat.php?catId=14">phone</a></li>
							<li><a href="productbycat.php?catId=7">Desktop</a></li>
			    	</ul></div>
		</li>

	  <li><a href="topbrands.php">Top Brands</a></li>
	  <li><a href="donhang.php">Ordered</a></li><li><a href="profile.php">Profile</a></li>	  
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>
	<div class="header_bottom">
		
		<div class="header_bottom_left">
			<div class="content_top">
    		<div class="heading">
    		<h3><i class="ti-star"></i> Popular Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
								<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/a46dfec5f6.jpg" alt=""></a>
					</div>					
				    <div class="text list_2_of_1">
						<h2>Macbook</h2>
						<p>Macbook M10 pro</p>
						<div class="button"><span><a href="details.php?proid=18">Buy now</a></span></div>
				   </div>
			   </div>	

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/6fd9ac0f3c.png" alt=""></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p>Galaxy S23 Ultra</p>
						  <div class="button"><span><a href="details.php?proid=16">Buy now</a></span></div>
					</div>
				</div>
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/4622cdb5b3.png" alt=""></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p>Iphone 6s</p>
						<div class="button"><span><a href="details.php?proid=12">Buy now</a></span></div>
				   </div>
			   </div>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/58c71baba8.jpg" alt=""></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p>camera hidden</p>
						  <div class="button"><span><a href="details.php?proid=19">Buy now</a></span></div>
					</div>
				</div>
			</div>
		  <div class="clear"></div>
		</div>
			
	  <div class="clear"></div>
  </div>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3><i class="ti-star"></i> Feature </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
							<div class="grid_1_of_4 images_1_of_4" style="height:389.62 px !important">
					 <a href="details.php?proid=19"><img style="height=220px" src="admin/uploads/58c71baba8.jpg" alt="" width="220" height="220"></a>
					 <h2>camera hidden </h2>
					 <p></p><p>camera hiddencamera.....</p>
					 <p><span class="price">2000 đ</span></p>
				     <div class="button"><span><a href="details.php?proid=19" class="details">Details</a></span></div>
				</div>
							<div class="grid_1_of_4 images_1_of_4" style="height:389.62 px !important">
					 <a href="details.php?proid=18"><img style="height=220px" src="admin/uploads/a46dfec5f6.jpg" alt="" width="220" height="220"></a>
					 <h2>Macbook M10 pro </h2>
					 <p></p><p>macbook m10 pro macbook.....</p>
					 <p><span class="price">1 đ</span></p>
				     <div class="button"><span><a href="details.php?proid=18" class="details">Details</a></span></div>
				</div>
							<div class="grid_1_of_4 images_1_of_4" style="height:389.62 px !important">
					 <a href="details.php?proid=17"><img style="height=220px" src="admin/uploads/db76baa730.jpg" alt="" width="220" height="220"></a>
					 <h2>Camera </h2>
					 <p></p><p>Camera canon B650 full xlm.....</p>
					 <p><span class="price">500 đ</span></p>
				     <div class="button"><span><a href="details.php?proid=17" class="details">Details</a></span></div>
				</div>
							<div class="grid_1_of_4 images_1_of_4" style="height:389.62 px !important">
					 <a href="details.php?proid=16"><img style="height=220px" src="admin/uploads/6fd9ac0f3c.png" alt="" width="220" height="220"></a>
					 <h2>Galaxy S23 Ultra </h2>
					 <p></p><p><span>Samsung Galaxy.....</span></p>
					 <p><span class="price">4 đ</span></p>
				     <div class="button"><span><a href="details.php?proid=16" class="details">Details</a></span></div>
				</div>
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3><i class="ti-star"></i> New</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
							<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=19"><img src="admin/uploads/58c71baba8.jpg" alt="" width="220" height="220"></a>
					 <h2>camera hidden </h2>
					 <p></p><p>camera hiddencamera.....</p>
					 <p><span class="price">2000 .đ</span></p>
				     <div class="button"><span><a href="details.php?proid=19" class="details">Details</a></span></div>
				</div>
							<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=18"><img src="admin/uploads/a46dfec5f6.jpg" alt="" width="220" height="220"></a>
					 <h2>Macbook M10 pro </h2>
					 <p></p><p>macbook m10 pro macbook.....</p>
					 <p><span class="price">1 .đ</span></p>
				     <div class="button"><span><a href="details.php?proid=18" class="details">Details</a></span></div>
				</div>
							<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=17"><img src="admin/uploads/db76baa730.jpg" alt="" width="220" height="220"></a>
					 <h2>Camera </h2>
					 <p></p><p>Camera canon B650 full xlm.....</p>
					 <p><span class="price">500 .đ</span></p>
				     <div class="button"><span><a href="details.php?proid=17" class="details">Details</a></span></div>
				</div>
							<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=16"><img src="admin/uploads/6fd9ac0f3c.png" alt="" width="220" height="220"></a>
					 <h2>Galaxy S23 Ultra </h2>
					 <p></p><p><span>Samsung Galaxy.....</span></p>
					 <p><span class="price">4 .đ</span></p>
				     <div class="button"><span><a href="details.php?proid=16" class="details">Details</a></span></div>
				</div>
						</div>
    </div>
 </div>

</div>
<div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Service</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Hotline</h4>
						<ul>
							<li><span>+84835973152</span></li>
							<li><span>+84835973152</span></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Media</h4>
							<ul>
							<li class="facebook"><a href="#" target="_blank"><i class="ti-facebook"></i></a></li>
							<li class="twitter"><a href="#" target="_blank"> <i class="ti-twitter"></i></a></li>
							<li class="googleplus"><a href="#" target="_blank"><i class="ti-email"></i></a></li>
							<div class="clear"></div>
						</ul>
					</div>
			</div>
			<div class="copy_right loadLogin">
				<p>Training with live project &amp; All rights Reseverd </p>
		   </div>
     </div>
    </div>
`;
			$('body').html(html);
				} else {
					$('.showloi').html("<span class = 'successfull' style='color:red'> Email and Password do not match !! </span>");
					// <span class = 'successfull' style='color:red'> Email and Password do not match !! </span>
				}
			},
			error: function(response) {
			// Xử lý lỗi (nếu có)
			console.log(response.responseText);
			}
		});
}
window.load = function() {
    // Thực hiện các hành động sau khi trang login.php được tải lại
    // Ví dụ: gửi một request AJAX, hiển thị thông báo, chuyển hướng, vv.
	var element = document.querySelector('.loadLogin');
	if(element){
		element.classList.remove("loadLogin");
		window.location.href = "http://localhost:81/Web2-master/index.php";
	}
}

function xulyCheckout(){
		const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        const selectedItems = [];

        checkboxes.forEach(function(checkbox) {
            selectedItems.push(checkbox.value);
        });

        // sử dụng AJAX để gửi các giá trị đã chọn đến trang xử lý phụ
        // ...
		$.ajax({
			type: "POST",
			url: "http://localhost:81/Web2-master/xulyCheckout.php",
			data: {
			arrID: selectedItems
			},
			success: function (response) {
				window.location.href = "http://localhost:81/Web2-master/dathang.php";
			},
			error: function(response) {
			// Xử lý lỗi (nếu có)
			console.log(response.responseText);
			}
		});
}

function xulyMuahang() {
	$.ajax({
			type: "POST",
			url: "http://localhost:81/Web2-master/xulymuahang.php",
			data: {
			arrID: "hi"
			},
			success: function (response) {
				alert("Bạn đã đặt hàng thành công!");
				window.location.href = "http://localhost:81/Web2-master/index.php";
			},
			error: function(response) {
			// Xử lý lỗi (nếu có)
			console.log(response.responseText);
			}
		});
}

</script>
</head>
<body>
	<style>
		

	</style>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><span class="sign">Nak Shop</span></a>
			</div>
			
			  <div class="header_top_right">
			    <div class="search_box">
				    <form method="post" action="search.php">
				    	<input type="text" placeholder="Search for products" name="keyword">
						<input type="submit" value="SEARCH" name="search">
						<button type="button" id="showNangcao" onclick="showForm()">Nâng cao</button>
						<div class="form_nangcao">
							<h2>Tìm kiếm nâng cao</h2>
							<form action="" class="form_search_nangcao">
								<div class="form-gr">
									<label for="tensp">Tên sản phẩm</label>
									<input type="text" name="tensp" id="tensp" placeholder="Nhập tên sản phẩm">
								</div>
								<div class="form-gr">
									<label for="loai">Chọn loại</label>
									<select name="loai" id="loai">
										<option value="">---CHỌN---</option>
										<?php
											$listBrand = $brand->show_brand();
											if($listBrand){
												while ($branditem = $listBrand->fetch_assoc()) {
										?>
										<option value="<?php echo $branditem['brandId']?>"><?php echo $branditem['brandName']?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
								<div class="form-gr">
									<label>Khoảng giá</label>
									<div class="gia">
										<input type="number" name="mingia" id="mingia" require placeholder="Giá nhỏ nhất">
										<input type="number" name="maxgia" id="maxgia" require placeholder="Giá lớn nhất">
									</div>
								</div>
								<button type="button" name="searchnangcao" id="searchnangcao" onclick="searchNangcao()">SEARCH</button>
							</form>
						</div> 															    
					</form>
			    </div>
			    <div class="wrapp-cart">					
					<div class="cart-icon">
					<a href="?action=cart">
						<i class="ti-shopping-cart"></i>
					</a>
					</div>
					<div class="cart">
						<a href="" title="View my shopping cart" rel="nofollow">
								<span class="no_product">
									<?php
										if($checkLogin){
											$id = Session::get("customerid");
											$idCart = $cart->getId($id);
											$soluong = $chitietcart->getSoLuongSP($idCart);
											echo '<a class="product_cart">' . $soluong . '</a>';
										} else {
											echo '<a class="product_cart"> 0 </a>';	
										}
									?>
								</span>
						</a>
					</div>
			    </div>
				
					
					<div class="login">
						<?php
							if($checkLogin){
								echo "<a href='?action=logout'>Logout></a>";
							}else{
								echo "<a href='login.php'>Login</a> <i class='ti-user'></i>";
							}
						?>			
					</div>
					<?php
						if($checkLogin){
							$cusId =   Session::get('customerid');  
    						$cus = $customer->get_by_id($cusId);
							echo '<div class="hello_user">
									<span>
										'.$cus->fetch_assoc()["name"].'
									</span>
								</div>';
						}
					?>	
		 <div class="clear"></div>
	 	</div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="products.php">Category</a> 
	  	<ul>
			<?php
				$listCat = $cat->show_category();
				if($listCat){
					while ($catitem = $listCat->fetch_assoc()) {
											
			?>
				<li><a href="productbycat.php?catId=<?php echo $catitem['catId']?>"><?php echo $catitem['catName']?></a></li>
			<?php
				}
			}
			?>
    	</ul>
		</li>

	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php
		if($checkLogin == true){
			echo "<li><a href='donhang.php'>Ordered</a></li>";
	  		echo "<li><a href='profile.php'>Profile</a></li>";
		}else{
			echo "";
		}
	  ?>	  
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>
<?php
	ob_end_flush();
?>