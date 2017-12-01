<div class="col-lg-9">
  <form class="form" action="" method="POST">
  
    <h2 class="form-signin-heading">Change password</h2>


<input type="password" required name="customer_pwd" id="pwd" placeholder="Ange gammalt lösenord"class="form-control">

<input  type="password" required name="new_pwd" id="pwd" placeholder="Ange nytt lösenord"class="form-control">

<input type="password" required name="new_pwd_again" id="pwd" placeholder="Ange nytt lösenord igen"class="form-control">
<input class="btn btn-lg btn-primary btn-block" name="change_pwd" value="Change Password" type="submit"/>
  </form>
  <?php 

include("includes/db.inc.php"); 


	if(isset($_POST['change_pwd'])){
		
		$user = $_SESSION['customer_email']; 
	
		$current_pwd = $_POST['customer_pwd']; 
		$new_pwd = $_POST['new_pwd']; 
		$new_again = $_POST['new_pwd_again']; 
		
		$sel_pwd = "SELECT * FROM customer FROM customer_pwd='$current_pwd' AND customer_email='$user'";
		
		$run_pwd = mysqli_query($con, $sel_pwd); 
		
		$check_pwd = mysqli_num_rows($run_pwd); 
		
		if($check_pwd){
		
		echo "<script>alert('Your Current Password is wrong!')</script>";
		exit();
		}
		
		if($new_pwd!=$new_again){
		
		echo "<script>alert('New password do not match!')</script>";
		exit();
		}
		else {
		
		$update_pwd = "UPDATE customer SET customer_pwd='$new_pwd' WHERE customer_email='$user'";
		
		$run_update = mysqli_query($con, $update_pwd); 
		
		echo "<script>alert('Your password has been updated!')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		}
	
	}




?>
