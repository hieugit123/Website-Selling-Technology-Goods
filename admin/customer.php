<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/customer.php';?>

<?php

    $cus = new customer();
    if(isset($_GET['cusId']) && $_GET['cusId']!=NULL){
        $id = $_GET['cusId'];
    }else{
        echo "<script> window.location = 'catlist.php'</script>";
    }
    $get_by_id = $cus->get_by_id($id);


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer infromation</h2>
               <div class="block copyblock"> 

                     <table class="tblone">
                <?php
                    if ($get_by_id) {
                       while ($info = $get_by_id->fetch_assoc()) {                         
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
                <?php
                        }
                    }
                ?>
            </table>
                


                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>