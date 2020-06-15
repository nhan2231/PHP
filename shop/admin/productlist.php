<?php include 'inc/header.php';?>
<?php 
	include 'inc/sidebar.php';
	include '../classes/category.php';
    include '../classes/brand.php';
	include '../classes/product.php';
	require_once '../helpers/format.php';
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
		<?php
			$pd = new product;
			if(isset($_GET['delId'])){
				$delPro = $pd->delete_pro($_GET['delId']);
			}
		?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>PName</th>
					<th>Price</th>
					<th>Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$fm = new Format;
					$pdList = $pd->show_product();

					if($pdList){
						$i = 0;
						while($row = $pdList->fetch_assoc()){
							$i++;
				?>
				<tr class="gradeX">
					<td ><?php echo $i?></td>
					<td ><?php echo $row['productName']?></td>
					<td ><?php echo $row['price']?></td>
					<td><img style=" margin-top: 20px" src="<?php echo 'uploads/'. $row['image']?>" width="70";/></td>
					<td><?php 
							$getCat = $pd->get_cat_byproId($row['catId']);
							if($getCat){
								while($result = $getCat->fetch_assoc()){
									echo $result['catName'];
								}
							}
					 	?>
					 </td>
					<td ><?php 
							$getBrand = $pd->get_brand_byproId($row['brandId']);
							if($getBrand){
								while($result = $getBrand->fetch_assoc()){
									echo $result['brandName'];
								}
							}
					 	?>
					</td>
					<td ><?php echo $fm->textShorten($row['descr'], 15)?></td>
					<td class="center" >
						<?php 
							if($row['type'] == 0){
								echo 'Non-Featured';
							}
							else echo 'Featured';
						?>
					</td>
					<td ><a href="productedit.php?proId=<?php echo $row['productId']?>">Edit</a> || <a onclick='return confirm("Are you sure you want to delete <?php echo $row["productName"] ?>?")' href="?delId=<?php echo $row['productId']?>">Delete</a></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
