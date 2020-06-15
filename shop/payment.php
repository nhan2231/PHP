<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['submit']))	{
		$addToCart = $cart->add_to_cart($_POST['quantity'],$id);
	}
?>
<style>
    .content_top {
        padding: 15px 20px;
        border: 1px solid #EBE8E8;
        border-radius: 3px;
        display: block;
    }
    .heading {
        float: left;
        margin-bottom: 20px;
        width: 100%;
        font-size: 30px;
    }
    .payment{
        text-align: center;
    }
    .payment a {
        text-decoration: none;
        border: 1px;
        border-color: black;
        padding: 15px;
        background: coral;
        color: black;
        font-size: 18px;
    }
    .payment a:hover{
        background-color: cornsilk;
        text-decoration: overline;
    }
    .payment h3 {
        margin-bottom: 15px;
        padding: 15px;
        font-size: 20px;
        text-decoration: underline;
        font-weight: bold;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="content_top">
                    <div class="heading">
                        <h3>PAYMENT METHOD</h3>
                    </div>
                    <div class="payment">
                        <h3>Choose your payment method</h3>
                        <a href="offlinepayment.php">Offline Payment</a>
                        <a href="onlinepayment.php">Online Payment</a>
                    </div>
                </div>
				
		</div>
    </div>
</div>

	<?php
		include 'inc/footer.php';
	 ?>

