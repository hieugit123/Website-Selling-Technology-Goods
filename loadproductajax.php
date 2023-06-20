
<?php
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


    if(isset($_GET["id"])){
        $test = $_GET["id"][4];
        
    }

		$listproduct = $pro->get_pro_page($test);
        if($listproduct){
            while ($product = $listproduct->fetch_assoc()) {
                    
    ?>
        <div class="grid_1_of_4 images_1_of_4">
                <a href="preview-3.php"><img style="height:220px" src="admin/uploads/<?php echo $product['image']?>" alt="" /></a>
                <h2><?php echo $product['productName']; ?> </h2>
                <?php echo $fm->textShorten($product['productDesc'],30); ?>
                <p><span class="price"><?php echo $product['price']; ?> .đ</span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $product['productId']; ?>" class="details">Details</a></span></div>
        </div>
    <?php
            }
        }else {
            echo "<h3>No products were found!</h3>";
        }

    
?>
