<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php

    $brand = new brand();
    if(isset($_GET['brandId']) && $_GET['brandId']!=NULL){
        $id = $_GET['brandId'];
    }else{
        echo "<script> window.lobrandion = 'brandlist.php'</script>";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $Updatebrand = $brand->Update_brand($brandName,$id);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit brand</h2>
               <div class="block copyblock"> 

                <?php
                    if(isset($Updatebrand)){
                        echo $Updatebrand;
                    }else{
                        echo "please Enter new Name:";
                    }
                    
                    $get_brand_name = $brand->getbrandbyId($id);
                    if ($get_brand_name) {
                       while ($result = $get_brand_name->fetch_assoc()) {
                                                       
                ?>
                    <form action="" method = "post"> 
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['brandName']?> " name="brandName" placeholder="Enter brand Name..." class="medium" />
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                
            <?php
                }
            }else{
                echo $id;
            }
            ?>


                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>