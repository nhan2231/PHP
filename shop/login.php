<?php
	include 'inc/header.php';
?>

<?php
    if(session::get('customer_login')){
        header('Location: index.php');
    }
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertCustomer = $cus->insert_customer($_POST);
    }
?>

<?php
    if(isset($_POST['login'])){
        $loginCustomer = $cus->login_customer($_POST);
    }
?>

 <div class="main">
    <div class="content">
		<?php
			// if(isset($insertCustomer)){
			// 	echo $insertCustomer;
			// }
		?>
		<div class="login_panel">
			<!-- <?php
				// if(isset($loginCustomer)){
				// 	echo $loginCustomer;
				// }
			?> -->
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="POST">
                	<input type="text" name="email" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
                    <input type="password" name="password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
                 	<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input class="greey" type="submit" name="login" value="Sign In"></div></div>
			</form>
		</div>

    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter Name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter City">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Enter Zip_Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter E-mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Address">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Enter Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input class="greey" type="submit" name="submit" value="Create Account"></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

	 <?php
		include 'inc/footer.php';
	 ?>

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


