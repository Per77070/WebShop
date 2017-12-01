<?php 
		include("includes/db.inc.php"); 
		
		$total = 0;
		
		global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
		
		$run_price = mysqli_query($con, $sel_price); 
		
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			
			$pro_price = "SELECT * FROM products WHERE product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			
			$product_name = $pp_price['product_title'];
			
			$values = array_sum($product_price);
			
			$total +=$values;
			
}
}
			// getting Quantity of the product 
			$get_qty = "SELECT * FROM cart WHERE p_id='$pro_id'";
			
			$run_qty = mysqli_query($con, $get_qty); 
			
			$row_qty = mysqli_fetch_array($run_qty); 
			
			$qty = $row_qty['qty'];
			
			if($qty==0){
			
			$qty=1;
			}
			else {
			
			$qty=$qty;
			
			}
?>
<h4>Choose Paypal as payment option </h4>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

	<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="kiribaty88-facilitator@gmail.com">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
    <input type="hidden" name="item_number" value="<?php echo $pro_id; ?>">
    <input type="hidden" name="amount" value="<?php echo $total; ?>">
    <input type="hidden" name="quantity" value="<?php echo $qty; ?>">
	<input type="hidden" name="currency_code" value="SEK">
	
	<input type="hidden" name="return" value="https://applikationsutveckling.000webhostapp.com/payment_success.php"/>
<input type="hidden" name="cancel_return" value="https://applikationsutveckling.000webhostapp.com/payment_failed.php"/>

  <input class="justify-content-right" type="image"
    src="https://www.braintreepayments.com/images/features/paypal/paypal-button@2x-69b78052.png" width="350" alt="Buy Now">
  <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif"
    width="1" height="1">
</form>