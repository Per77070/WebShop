

<div class="col-lg-9">
<h2 style="text-align:center; ">Do you want to DELETE this account?</h2>
  <form class="form-signin" action="" method="POST">

<br>
<input type="submit" name="yes" value="Yes" /> 
<input type="submit" name="no" value="No" />


</form>
<?php 
include("includes/db.inc.php"); 

	$user = $_SESSION['customer_email']; 
	
	if(isset($_POST['yes'])){
	
	$delete_customer = "DELETE FROM customer WHERE customer_email='$user'";
	
	$run_customer = mysqli_query($con,$delete_customer); 
	
	echo "<script>alert('Your account has been deleted!')</script>";
	echo "<script>window.open('../index.php','_self')</script>";
	}
	if(isset($_POST['no'])){
	
	echo "<script>alert('Welcome back to your account')</script>";
	echo "<script>window.open('my_account.php','_self')</script>";
	
	}
	


?>
