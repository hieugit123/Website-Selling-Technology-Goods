<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>

<?php
    $pd = new product();
    if(isset($_GET['productId']) && $_GET['productId']!=NULL){
        $id = $_GET['productId'];
    }else{
        echo "<script> window.location = 'productlist.php'</script>";
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

        $updateProduct = $pd->Update_pro($_POST,$_FILES,$id);
    }
    
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
                <?php
                    if(isset($updateProduct)){
                        echo $updateProduct;
                    }
                    
                ?>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <?php
               $pro = $pd->getProById($id);
                    if($pro){
                        while ($result_pro = $pro->fetch_assoc()) {

               ?>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_pro['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">                       
                            <option>Select Category</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();

                                if($catlist){
                                    while ($result = $catlist->fetch_assoc()) {
                                                                       
                            ?>
                                <option
                                <?php
                                    if($result['catId']== $result_pro['catId']){
                                        echo 'selected';
                                    }
                                ?>   
                                value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>
                            <?php
                                    }
                                }                          
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Select Brand</option>
                            <?php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();

                                if($brandlist){
                                    while ($brandresult = $brandlist->fetch_assoc()) {
                                                                       
                            ?>
                                <option
                                <?php
                                    if($brandresult['brandId']== $result_pro['brandId']){
                                        echo 'selected';
                                    }
                                ?>                           
                                value="<?php echo $brandresult['brandId']?>"><?php echo $brandresult['brandName']?></option>
                            <?php
                                    }
                                }                          
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="productDesc" ><?php echo $result_pro['productDesc']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_pro['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_pro['image']; ?> " alt="" width= '50px'>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                                if($result_pro['type'] == 1){
                                    echo '<option selected value="1">Featured</option>';
                                    echo '<option value="0">Non-Featured</option>';
                                }else{
                                    echo '<option value="1">Featured</option>';
                                    echo '<option selected value="0">Non-Featured</option>';
                                }                       
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
                <?php
                                            
                        }
                    }
                ?>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


