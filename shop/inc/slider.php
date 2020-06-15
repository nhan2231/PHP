<div class="header_bottom">
		<div class="header_bottom_left">
			
			<?php
				$hotProduct = $pd->hot_product();
				if($hotProduct){
					$i = 0;
					while($row = $hotProduct->fetch_assoc()){
						$i++;
						if($i % 2 != 0){
			?>
				<div class="section group">
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proId=<?php echo $row['productId']?>"><img src="<?php echo "admin/uploads/".$row['image']?>" alt=""  ></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $row['productName']?></h2>
							<p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
							<div class="button"><span><a href="details.php?proId=<?php echo $row['productId']?>">Add to cart</a></span></div>
						</div>
					</div>
				<?php
						}
						else{
				?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proId=<?php echo $row['productId']?>"><img src="<?php echo "admin/uploads/".$row['image']?>" alt=""  ></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $row['productName']?></h2>
							<p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
							<div class="button"><span><a href="details.php?proId=<?php echo $row['productId']?>">Add to cart</a></span></div>
						</div>
					</div>
				</div>
				<?php
						}
					}
				}
			?>
			

			<!-- <div class="section group">

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="images/pic3.jpg" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
						<div class="button"><span><a href="details.php">Add to cart</a></span></div>
				   </div>
			   </div>	

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php"><img src="images/pic1.png" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
						  <div class="button"><span><a href="details.php">Add to cart</a></span></div>
					</div>
				</div>
			</div> -->

		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>