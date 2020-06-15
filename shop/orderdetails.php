<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
    $loginCheck = session::get('customer_login');
    if($loginCheck == false){
        header('Location: login.php');
    }
?>

<style>
    .content{
        text-align: center;
    }
    .heading {
        float: left;
        margin-right: 10%;
        width: 100%;
    }   
    .left{
        width: 100%;
        margin: 5px;
        padding: 5px;
        text-align: center;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">

            <div class="heading">
                <h3>ORDERED PRODUCTS</h3>
            </div>

            <div class="left">
                <h2>Your Cart</h2>
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="10%">Date</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Status</th>
                    </tr>

                    <?php
                        $orderItem = $cart->get_ordered_item();
                        $grandMoney = 0;
                        if($orderItem){
                            while($row = $orderItem->fetch_assoc()){
                    ?>

                    <tr>
                        <td><?php echo $row['productName'] ?></td>
                        <td><img src="<?php echo 'admin/uploads/'.$row['image'] ?>" alt=""/></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php echo $total = ($row['quantity'] * $row['price']); $grandMoney += $total;?></td>
                        <td><?php if($row['status'] == 0){
                                    echo 'Pending';
                                }
                                else{
                                    echo 'Done';
                                }
                             ?>
                        </td>
                    </tr>
                    
                    <?php
                            }
                        }
                    ?>

                </table>

                <?php 
                    // if($orderItem){ ?>
                    <!-- <table class="tbl" style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td><?php 	//echo $grandMoney . " $";
                                        //Session::set('sum', $grandMoney);
                                ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td><?php //echo ($tax = (($grandMoney / 100) * 10)) . " $";
                                ?></td>
                        </tr>
                        <tr>
                            <th>Total :</th>
                            <td><?php //echo $grandMoney+$tax . " $"?></td>
                        </tr>
                    </table> -->
                <?php 
                    // } 
                ?>
            </div>
        </div>
    </div>
</div>
                
	<?php
		include 'inc/footer.php';
	?>

