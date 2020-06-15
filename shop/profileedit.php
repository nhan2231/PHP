<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['submit'])){
        $id = $_GET['id'];
        $updateCustomer = $cus->update_customer($_POST, $id);
    }
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="content_top">
                    <div class="heading">
                        <h3>Edit Customer Info</h3>
                    </div>
                </div>
                <?php
                    if(isset($updateCustomer)){
                        echo $updateCustomer;
                    }
                ?>
                <table class="tblone">
                    <?php
                        $id = $_GET['id'];
                        $getCustomer = $cus->show_customer($id);
                        if($getCustomer){
                            while($row = $getCustomer->fetch_assoc()){
                    ?>
                    <form action="" method='post'>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" name="name" value="<?php echo  $row['name']?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" name="address" value="<?php echo  $row['address']?>"></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><input type="text" name="city" value="<?php echo  $row['city']?>"></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><input type="text" name="country" value="<?php echo  $row['country']?>"></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td><input type="text" name="zipcode" value="<?php echo  $row['zipcode']?>"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="text" name="phone" value="<?php echo  $row['phone']?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" name="email" value="<?php echo  $row['email']?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input class="grey" type="submit" name="submit"?></td>
                        </tr>
                    </form>
                    <?php
                                }
                                }                       
                    ?>
                </table>
				
		</div>
    </div>

	<?php
		include 'inc/footer.php';
	 ?>

