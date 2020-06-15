<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  	<?php
				  	$showFeatured = $pd->featured_product();
					if($showFeatured){
						while($row = $showFeatured->fetch_assoc()){
			  	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $row['productId']?>"><img src="<?php echo "admin/uploads/".$row['image']?>" alt="" /></a>
					 <h2><?php echo $row['productName']?></h2>
					 <p><?php echo $row['descr']?></p>
					 <p><span class="price"><?php echo '$'.$row['price']?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $row['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
						}
					}
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$newProduct = $pd->new_product();
					if($newProduct){
						while($row = $newProduct->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $row['productId']?>"><img src="<?php echo 'admin/uploads/'.$row['image']?>" alt="" /></a>
					 <h2><?php echo $row['productName']?></h2>
					 <p><span class="price"><?php echo '$'.$row['price']?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $row['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
						}
					}
				?>
			</div>
    </div>
 </div>

 <?php
	include 'inc/footer.php';
 ?>
