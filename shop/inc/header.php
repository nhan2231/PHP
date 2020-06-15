<?php
	require_once 'libs/session.php';
    Session::init();
?>

<?php
	require_once 'libs/database.php';
	require_once 'helpers/format.php';
	// Function tu dong include cac class
	spl_autoload_register(function($className){
		include_once "classes/".$className.".php";
	});

	$db = new Database;
	$fm = new Format;
	$cart = new Cart;
	$cus = new Customer;
	$user = new User;
	$cat = new category;
	$pd = new product;
?>

<?php
	header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    header("Cache-Control: max-age=2592000");
?>

<?php
	if(isset($_POST['key'])){
		$key = $_POST['key'];
		$pd->find_product($key);
	}
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});

	$('#key').keyup(function(){
			$.ajax({
				url : "search.php",
				type : "post",
				dataType:"text",
				data : {
						key : $('#key').val()
				},
				success : function (result){
					$('#find').html(result);
				}
			});
	})

  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input id="key" type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
					<h6 id="find"><?php ?></h6>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php  
										if($cart->get_item()){ 
											$sum = Session::get('sum');
											echo $sum . '$';
										}
										else{
											echo 'empty';
										}
									?>
								</span>
							</a>
						</div>
			      </div>

				  <?php
				 	if(isset($_GET['customerId'])){
						 $delCart = $cart->del_all_data_cart();
						 session::destroy();
					 } 
				  ?>
		   <div class="login">
				<?php
				   	if(session::get('customer_login')){
						echo '<a href="?customerId="'.session::get('customer_id').'>Logout</a>';
					   }
					else{
						echo '<a href="login.php">Login</a>';
					}
				?>
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <!-- <li><a href="products.php">Products</a> </li> -->
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <li><a href="cart.php">Cart</a></li>
	  <?php
	  		$loginCheck = session::get('customer_login');
			if($loginCheck == false){
				echo '';
			} 
			else{
				echo '<li><a href="profile.php">Profile</a></li>';
			}
	  ?>
	  <?php
	  		$checkOrder = $cart->order_check();
			if($checkOrder == false){
				echo '';
			} 
			else{
				echo '<li><a href="orderdetails.php">Order</a></li>';
			}
	  ?>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>