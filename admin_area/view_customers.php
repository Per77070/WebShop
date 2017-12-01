<?php 
	include("includes/db.inc.php");
if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
}
else { ?>
<table class="table" align="center" > 

	
	<tr align="center">
		<td colspan="6"><h2>View All Customers Here</h2></td>
	</tr>
	
	<tr align="center" >
		<th>#</th>
		<th>Name</th>
		<th>Email</th>
		<th>Delete</th>
	</tr>
	<?php 
	
	
	$get_c = "SELECT * FROM customer";
	
	$run_c = mysqli_query($con, $get_c); 
	
	$i = 0;
	
	while ($row_c=mysqli_fetch_array($run_c)){
		
		$c_id = $row_c['customer_id'];
		$c_name = $row_c['customer_name'];
		$c_email = $row_c['customer_email'];
		$c_image = $row_c['customer_img'];
		$i++;
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $c_name;?></td>
		<td><?php echo $c_email;?></td>
		<td><a href="delete_c.php?delete_c=<?php echo $c_id;?>">Delete</a></td>
	
	</tr>
	<?php } ?>




</table>
<?php } ?>