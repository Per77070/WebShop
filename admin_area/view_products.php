<?php 
include("includes/db.inc.php");
if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
}
else { ?>
<table class="table"align="center"> 

	
	<tr align="center">
		<td colspan="6"><h2>View all products</h2></td>
	</tr>
	
	<tr>
		<th>#</th>
		<th>Title</th>
		<th>Img</th>
		<th>Price</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	
	
	$get_pro = "SELECT * FROM products";
	
	$run_pro = mysqli_query($con, $get_pro); 
	
	$i = 0;
	
	while ($row_pro=mysqli_fetch_array($run_pro)){
		
		$pro_id = $row_pro['product_id'];
		$pro_title = $row_pro['product_title'];
		$pro_img = $row_pro['product_img'];
		$pro_price = $row_pro['product_price'];
		$i++;
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $pro_title;?></td>
		<td><img src="product_img/<?php echo $pro_img;?>" width="50" height="50"/></td>
		<td><?php echo $pro_price;?></td>
		<td><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edit</a></td>
		<td><a href="delete_pro.php?delete_pro=<?php echo $pro_id;?>">Delete</a></td>
	
	</tr>
	<?php } ?>
</table>

<?php } ?>