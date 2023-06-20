<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php

    $cat = new category();
    if(isset($_GET['catId']) && $_GET['catId']!=NULL){
        $id = $_GET['catId'];
    }else{
        echo "<script> window.location = 'catlist.php'</script>";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];

        $UpdateCat = $cat->Update_catgory($catName,$id);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 

                <?php
                    if(isset($UpdateCat)){
                        echo $UpdateCat;
                    }else{
                        echo "please Enter new Name:";
                    }
                    
                    $get_cate_name = $cat->getcatbyId($id);
                    if ($get_cate_name) {
                       while ($result = $get_cate_name->fetch_assoc()) {
                                                       
                ?>
                    <form action="" method = "post"> 
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['catName']?> " name="catName" placeholder="Enter Category Name..." class="medium" />
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