<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	if(!isset($_GET['catId']) && !isset($_GET['catName'])){
		header('Location: index.php');
	}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<h3><?php echo $_GET['catName'] ?></h3>
    		</div>
    		<div class="clear">
			</div>
    	</div>
	      <div class="section group">
			  <?php  
				 	$list = $pd->list_category($_GET['catId']);
				  	if($list){
						  while($row = $list->fetch_assoc()){
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $row['productId']?>"><img src="admin/uploads/<?php echo $row['image']?>" alt="" /></a>
					 <h2><?php echo $row['productName']?></h2>
					 <p><?php echo $row['descr']?></p>
					 <p><span class="price">$<?php echo $row['price']?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $row['productId']?>" class="details">Details</a></span></div>
				</div>
			<?php
						}
					}
			?>
			</div>
		</div>

 	</div>
</div>
   
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>

	<?php
		include 'inc/footer.php';
	?>

