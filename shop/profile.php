<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['submit']))	{
		$addToCart = $cart->add_to_cart($_POST['quantity'],$id);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="content_top">
                    <div class="heading">
                        <h3>Profile Customer</h3>
                    </div>
                </div>
				
                <table class="tblone">
                    <?php
                        $id = session::get('customer_id');
                        $getCustomer = $cus->show_customer($id);
                        if($getCustomer){
                            while($row = $getCustomer->fetch_assoc()){
                    ?>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?php echo  $row['name']?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $row['address']?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $row['city']?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $row['country']?></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td>:</td>
                        <td><?php echo $row['zipcode']?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $row['phone']?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $row['email']?></td>
                    </tr>
                    <?php
                             }
                            }                       
                    ?>
                    <tr>
                        <td colspan="3"><a href="profileedit.php?id=<?php echo $id ?>">Update Your Information</a></td>
                    </tr>
                    
                </table>
				
		</div>
    </div>
</div>

	<?php
		include 'inc/footer.php';
	 ?>

