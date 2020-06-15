<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">

    	<div class="content_top">
    		<div class="heading">
    		<h3>Apple</h3>
    		</div>
    		<div class="clear"></div>
    	</div>

	      	<div class="section group">
			  	<?php
			 		$acerPro = $pd->list_by_brand('9');
						if($acerPro){
							while($row = $acerPro->fetch_assoc()){
			  	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $row['productId']?>"><img src="admin/uploads/<?php echo $row['image']?>" alt="" /></a>
					 <h2><?php echo $row['productName']?></h2>
					 <p><?php echo $row['descr']?></p>
					 <p><span class="price">$<?php echo $row['price']?></span></p>
				     <div class="button"><span><a href="preview.html" class="details.php?proId=<?php echo $row['productId']?>">Details</a></span></div>
				</div>
				<?php
						}
					}
				?>
			</div>

		<div class="content_bottom">
    		<div class="heading">
    		<h3>Samsung</h3>
    		</div>
    		<div class="clear"></div>
    	</div>

		<div class="section group">
			  	<?php
			 		$acerPro = $pd->list_by_brand('10');
						if($acerPro){
							while($row = $acerPro->fetch_assoc()){
			  	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $row['productId']?>"><img src="admin/uploads/<?php echo $row['image']?>" alt="" /></a>
					 <h2><?php echo $row['productName']?></h2>
					 <p><?php echo $row['descr']?></p>
					 <p><span class="price">$<?php echo $row['price']?></span></p>
				     <div class="button"><span><a href="preview.html" class="details.php?proId=<?php echo $row['productId']?>">Details</a></span></div>
				</div>
				<?php
						}
					}
				?>
			</div>

		<div class="content_bottom">
    		<div class="heading">
    			<h3>Sony</h3>
    		</div>
    		<div class="clear"></div>
    	</div>

		<div class="section group">
			  	<?php
			 		$acerPro = $pd->list_by_brand('7');
						if($acerPro){
							while($row = $acerPro->fetch_assoc()){
			  	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $row['productId']?>"><img src="admin/uploads/<?php echo $row['image']?>" alt="" /></a>
					 <h2><?php echo $row['productName']?></h2>
					 <p><?php echo $row['descr']?></p>
					 <p><span class="price">$<?php echo $row['price']?></span></p>
				     <div class="button"><span><a href="preview.html" class="details.php?proId=<?php echo $row['productId']?>">Details</a></span></div>
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


