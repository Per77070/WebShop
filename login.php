<?php 

include("includes/db.inc.php");
?>

<form method="post" action="" class="form-inline">
<label class="sr-only" for="inlineFormInputGroup">Email</label>
<div class="input-group mb-2 mr-sm-2 mb-sm-0">
  <div class="input-group-addon">@</div>
<label class="sr-only" for="inlineFormInput">Password</label>
<input required type="email" name="customer_email"class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Email">


<input required type="password" name="customer_pwd" class="form-control" id="inlineFormInputGroup" placeholder="Password">
</div>

<button type="submit" name="login" class="btn btn-primary">Log in</button>
<a href="register.php" style="text-decoration:none;"> Or Register Here</a>
</form>
<?php 
if(isset($_POST['login'])){ //loggin funktion som kollar att att mail matchar password
	
		$customer_email = $_POST['customer_email'];
		$customer_pwd = $_POST['customer_pwd'];
		
		$sel_customer = "SELECT * FROM customer WHERE customer_pwd='$customer_pwd' AND customer_email='$customer_email'";
		
		$run_customer = mysqli_query($con, $sel_customer);
		
		$check_customer = mysqli_num_rows($run_customer); 
		
		if($check_customer==0){
		
		echo "<script>alert('Password or email is incorrect!')</script>";
		exit();
		}
		$ip = getIp(); // denna hämtar ipadressen  på den som är inne så att två personer kan ha olika carts fast dem inte är inloggade så dem ändå kan ha olika carts
		
		$sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_customer>0 AND $check_cart==0){
		
		$_SESSION['customer_email']=$customer_email; 
		
		echo "<script>alert('You logged in successfully!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		$_SESSION['customer_email']=$customer_email; 
		
		echo "<script>alert('You logged in successfully!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
		
		
		}
	}
	
	
	?>
