<?php include 'inc/header.php'?>
<?php 
	include 'inc/sidebar.php';
	include '../classes/category.php';
?>

<?php
	$cat = new category();
?>

<?php
	if(isset($_GET['delId'])){
		$delcat = $cat->delete_category($_GET['delId']);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">      
					<?php
						if(isset($delcat)){
							echo $delcat;
						}
					?>  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($showCat = $cat->show_category()){
								$i = 0;
								while($result = $showCat->fetch_assoc()){
									$i++;
						?>

						<tr class="odd gradeX">
							<td> <?php echo $i ?> </td>
							<td> <?php echo $result['catName'] ?> </td>
							<td><a href="catedit.php?catId=<?php echo $result['catId'] ?>">Edit</a> || 
								<a onclick="return confirm('Delete <?php echo $result['catName'] ?> ?')" href="?delId=<?php echo $result['catId']?>" >Delete</a></td>
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

