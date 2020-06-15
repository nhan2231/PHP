<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
    if(!isset($_GET['proId']) || $_GET['proId'] == null){
        echo "<script>window.location = '404.php' </script>";
    }
    else {
        $id = $_GET['proId'];
	}
	
	$getDetail = $pd->get_detail($id);
	if($getDetail){
		while($row = $getDetail->fetch_assoc()){
?>

<?php
	if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['submit']))	{
		$addToCart = $cart->add_to_cart($_POST['quantity'],$id);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="<?php echo 'admin/uploads/'.$row['image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $row['productName'] ?></h2>
					<p><?php echo $row['descr'] ?></p>					
					<div class="price">
						<p>Price: <span><?php echo '$'.$row['price']?></span></p>
						<p>Category: <span><?php echo $row['catName'] ?></span></p>
						<p>Brand:<span><?php echo $row['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min='1'/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	    </div>
				
		<?php
				}
			}
		?>

	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					<?php
						$getCat = $cat->show_category();
							if($getCat){
								while($row = $getCat->fetch_assoc()){
					?>

				    	<li><a href="productbycat.php?catId=<?php echo $row['catId']?>&catName=<?php echo $row['catName']?>"><?php echo $row['catName'] ?></a></li>
						
					<?php
														}
													}
					?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>

	<?php
		include 'inc/footer.php';
	 ?>

