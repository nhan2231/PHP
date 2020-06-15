<?php include 'inc/header.php';?>

<?php 
	include 'inc/sidebar.php';
	$filepath = realpath(dirname(__DIR__));
	require_once $filepath.'../classes/customer.php';
	require_once $filepath.'../helpers/format.php';
?>
<?php
    if(!isset($_GET['customerId']) || $_GET['customerId'] == null){
        echo "<script>window.location = 'inbox.php' </script>";
    }
    else {
        $id = $_GET['customerId'];
    }
    $cus = new customer();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];
        $updateCat = $cat->update_category($catName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Detail</h2>
                
               <div class="block copyblock"> 

               <?php
                    $getCustomer = $cus->show_customer($id);         
                    if($getCustomer){
                        while($result = $getCustomer->fetch_assoc()){
                ?>

                 <form action='' method='post'>
                    <table class="form">			
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cusName" readonly="readonly" Value="<?php echo $result['name'] ?>" />
                            </td>
                        </tr>
						<tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cusName" readonly="readonly" Value="<?php echo $result['phone'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cusName" readonly="readonly" Value="<?php echo $result['city'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cusName" readonly="readonly" Value="<?php echo $result['country'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cusName" readonly="readonly" Value="<?php echo $result['address'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cusName" readonly="readonly" Value="<?php echo $result['zipcode'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cusName" readonly="readonly" Value="<?php echo $result['email'] ?>" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                                        }
                                    } 
                ?>
                </div>

            </div>
        </div>
<?php include 'inc/footer.php';?>