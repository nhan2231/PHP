<?php include 'inc/header.php'?>
<?php 
	include 'inc/sidebar.php';
	include '../classes/brand.php';
?>

<?php
	$brand = new brand();
?>

<?php
	if(isset($_GET['delId'])){
		$delbrand = $brand->delete_brand($_GET['delId']);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>brandegory List</h2>
                <div class="block">      
					<?php
						if(isset($delbrand)){
							echo $delbrand;
						}
					?>  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand's Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($showBrand = $brand->show_brand()){
								$i = 0;
								while($result = $showBrand->fetch_assoc()){
									$i++;
						?>

						<tr class="odd gradeX">
							<td> <?php echo $i ?> </td>
							<td> <?php echo $result['brandName'] ?> </td>
							<td><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a> || 
								<a onclick="return confirm('Delete <?php echo $result['brandName'] ?> ')" href="?delId=<?php echo $result['brandId']?>" >Delete</a></td>
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

<?php include 'inc/footer.php'?>

