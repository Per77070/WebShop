<?php 
	include("includes/db.inc.php"); 
	if(!isset($_SESSION['user_email'])){
		
		echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
	}
	else {
	
	if(isset($_GET['delete_c'])){
	
	$delete_id = $_GET['delete_c'];
	
	$delete_c = "DELETE FROM customer WHERE customer_id='$delete_id'"; 
	
	$run_delete = mysqli_query($con, $delete_c); 
	
	if($run_delete){
	
	echo "<script>alert('A customer has been deleted!')</script>";
	echo "<script>window.open('index.php?view_customers','_self')</script>";
	}
	
	}





?>
	<?php } ?>
