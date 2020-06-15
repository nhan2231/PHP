<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'";
	}

	if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['submit']))	{
		$cartId = mysqli_real_escape_string($db->link, $_POST['cartId']);
		$updateCart = $cart->update_cart($_POST['quantity'],$cartId);
	}

	if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['del'])){
		$cart->del_cart($_POST['delId']);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php
								$cartItem = $cart->get_item();
								$grandMoney = 0;
								if($cartItem){
									while($row = $cartItem->fetch_assoc()){
							?>

							<tr>
								<td><?php echo $row['productName'] ?></td>
								<td><img src="<?php echo 'admin/uploads/'.$row['image'] ?>" alt=""/></td>
								<td><?php echo $row['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $row['cartId']?>"/>
										<input type="number" name="quantity" min="1" value="<?php echo $row['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php echo $total = ($row['quantity'] * $row['price']); $grandMoney += $total;?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="delId" value="<?php echo $row['cartId']?>"> 
										<input onclick="return confirm('Delete <?php echo $row['productName']?>?')" type="submit" name="del" value="Xóa" />
									</form>
								</td>
							</tr>
							
							<?php
									}
								}
							?>

						</table>
						<?php 
							if($cartItem){ ?>
							<table style="float:right;text-align:left;" width="40%">
								<tr>
									<th>Sub Total : </th>
									<td><?php 	echo $grandMoney . " $";
												Session::set('sum', $grandMoney);
										?></td>
								</tr>
								<tr>
									<th>VAT : </th>
									<td><?php echo ($tax = (($grandMoney / 100) * 10)) . " $";
										?></td>
								</tr>
								<tr>
									<th>Grand Total :</th>
									<td><?php echo $grandMoney+$tax . " $"?></td>
								</tr>
							</table>
						<?php 
							} 
						?>
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<?php 
							if($cartItem != false){
						?>
						<div class="shopright" >
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
						<?php
							}
						?>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
	include 'inc/footer.php';
 ?>