<?php 
	include("includes/db.inc.php");
	if(!isset($_SESSION['user_email'])){
		
		echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
	}
	else { ?>
<table class="table" align="center" > 

	
	<tr align="center">
		<td colspan="6"><h2>View all orders here</h2></td>
	</tr>
	
	<tr align="center">
		<th>#</th>
		<th>customer</th>
		<th>Products</th>
		<th>Quantity</th>
		<th>Invoice No/Date</th>
		
		
	</tr>
	<?php 
	
	
	$get_order = "SELECT * FROM orders";
	
	$run_order = mysqli_query($con, $get_order); 
	
	$i = 0;
	
	while ($row_order=mysqli_fetch_array($run_order)){
		
		$order_id = $row_order['order_id'];
		$qty = $row_order['qty'];
		$pro_id = $row_order['p_id'];
		$c_id = $row_order['c_id'];
		$invoice_no = $row_order['invoice_no'];
		$order_date = $row_order['order_date'];
		
		$i++;
		
		$get_pro = "SELECT * FROM products WHERE product_id='$pro_id'";
		$run_pro = mysqli_query($con, $get_pro); 
		
		$row_pro=mysqli_fetch_array($run_pro); 
		
		$pro_image = $row_pro['product_img']; 
		$pro_title = $row_pro['product_title'];
		
		$get_c = "SELECT * FROM customer WHERE customer_id='$c_id'";
		$run_c = mysqli_query($con, $get_c); 
		
		$row_c=mysqli_fetch_array($run_c); 
		
		$c_email = $row_c['customer_email'];
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $c_email; ?><br>
		<a href="index.php?confirm_order=<?php echo $order_id; ?>">Complete Order</a></td>
		<td>
		<?php echo $pro_title;?><br>
		<img src="product_img/<?php echo $pro_image;?>" width="50" height="50" />
		</td>
		<td><?php echo $qty;?></td>
		<td><?php echo $invoice_no;?><br>
		<?php echo $order_date;?></td>
		
	
	</tr>
	<?php } ?>
</table>
<?php }

?>