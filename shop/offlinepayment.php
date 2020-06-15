<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
    if(!session::get('customer_login')){
        header('Location: login.php');
    }

    if(isset($_GET['orderId']) && $_GET['orderId'] == 'order'){
        $customer_id = session::get('customer_id');
        $insertOrder  = $cart->insert_order($customer_id);
        $delCart = $cart->del_all_data_cart();
        header('Location: success.php');
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
    .right {
        float: left;
        width: 47%;
        border: 1px solid grey;
        margin: 5px;
        padding: 5px;
    }
    .left{
        float: left;
        width: 50%;
        border: 1px solid gray;
        margin: 5px;
        padding: 5px
    }
    .order{
        margin-top: 15px;
        width: 100%;
        display: block;
        text-align: center;
    }
    .submitOrder {
        padding: 15px;
        font-size: 18px;
        background: orangered;
        color: white;
        border: 2px solid darksalmon;
        border-radius: 6px;
        box-shadow: 2px 2px 7px 0px black;
        cursor: pointer;
        margin-bottom: 20px;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">

            <div class="heading">
                <h3>PAYMENT METHOD</h3>
            </div>

            <div class="left">
                <h2>Your Cart</h2>
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                    </tr>

                    <?php
                        $cartItem = $cart->get_item();
                        $grandMoney = 0;
                        if($cartItem){
                            while($row = $cartItem->fetch_assoc()){
                    ?>

                    <tr>
                        <td><?php echo $row['productName'] ?></td>
                        <td><img src="<?php echo 'admin/uploads/'.$row['image'] ?>" alt=""/></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo $total = ($row['quantity'] * $row['price']); $grandMoney += $total;?></td>
                    </tr>
                    
                    <?php
                            }
                        }
                    ?>

                </table>
                <?php 
                    if($cartItem){ ?>
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td><?php 	echo $grandMoney . " $";
                                        Session::set('sum', $grandMoney);
                                ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td><?php echo ($tax = (($grandMoney / 100) * 10)) . " $";
                                ?></td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td><?php echo $grandMoney+$tax . " $"?></td>
                        </tr>
                    </table>
                <?php 
                    } 
                ?>
            </div>

            <div class = "right">
                <h2>Your Information</h2>
                <table class="tblone">
                    <?php
                        $id = session::get('customer_id');
                        $getCustomer = $cus->show_customer($id);
                        if($getCustomer){
                            while($row = $getCustomer->fetch_assoc()){
                    ?>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?php echo  $row['name']?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $row['address']?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $row['city']?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $row['country']?></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td>:</td>
                        <td><?php echo $row['zipcode']?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $row['phone']?></td>
                    </tr>
                    <?php
                             }
                            }                       
                    ?>
                    <tr>
                        <td colspan="3"><a href="profileedit.php?id=<?php echo $id ?>">Update Your Information</a></td>
                    </tr>
                    
                </table>
            </div>

            <div class="order">
                <form>
                    <a href="?orderId=order" class="submitOrder">Place Order</a>
                </form>
            </div>
        </div>
    </div>
</div>                       

	<?php
		include 'inc/footer.php';
	?>

