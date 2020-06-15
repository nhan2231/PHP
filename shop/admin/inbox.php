<?php include 'inc/header.php';?>
<?php 
	include 'inc/sidebar.php';
	$filepath = realpath(dirname(__DIR__));
	require_once $filepath.'../classes/cart.php';
	require_once $filepath.'../helpers/format.php';
?>
<style>
	tr.even {
    background-color: white;
}
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
							$cart = new cart;
							$fm = new format;
							$getInbox = $cart->get_inbox_cart();
							if($getInbox){
								$i = 0;
								while($result = $getInbox->fetch_assoc()){
									$i++;
						?>
						<tr class="">
							<td><?php echo $i ?></td>
							<td><?php echo $fm->formatDate($result['date'])?></td>
							<td><?php echo $result['productName']?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price'] ?></td>
							<td><a href="customer.php?customerId=<?php echo $result['customer_id'] ?>">View Address</a></td>
							<td>
								<?php
									if($result['status']==0){
								?>
									<a href="?shiftId=<?php echo $result['id']?>?price=<?php echo $result['price']?>&time=
										<?php echo $result['date']?>">Pending</a>
								
								<?php	}
									else{
								?>
									<a href="?shiftId=<?php echo $result['id']?>?price=<?php echo $result['price']?>&time=
										<?php echo $result['date']?>">Remove</a>
								<?php
									}
								?>
							</td>
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
