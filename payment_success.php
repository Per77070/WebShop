<?php 
session_start();
?>



<html>
	<head>
		<title>Payment Successful!</title>
	</head>

<body>
<?php 
        include("includes/db.inc.php");
        include("functions/functions.php");
        
        //this is all for product details
        
        $total = 0;
        
        global $con;
        
        $ip = getIp();
        
        $sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
        
        $run_price = mysqli_query($con, $sel_price);
        
        while ($p_price=mysqli_fetch_array($run_price)) {
            $pro_id = $p_price['p_id'];
            
            $pro_price = "SELECT * FROM products WHERE product_id='$pro_id'";
            
            $run_pro_price = mysqli_query($con, $pro_price);
            
            while ($pp_price = mysqli_fetch_array($run_pro_price)) {

                $product_price = array($pp_price['product_price']);
            
                $product_id = $pp_price['product_id'];
            
                $pro_name = $pp_price['product_title'];
            
            
                $values = array_sum($product_price);
            
                $total +=$values;
            }
        }
        
            // räkan ut tptalpriset för produterna
            $get_qty = "SELECT * FROM cart WHERE p_id='$pro_id'";
            
            $run_qty = mysqli_query($con, $get_qty);
            
            $row_qty = mysqli_fetch_array($run_qty);
            
            $qty = $row_qty['qty'];
            
            if ($qty==0) {
                $qty=1;
            } else {
                $qty=$qty;
            
                $total = $total*$qty;
            }
            
            //hämta info om kunden
            $user = $_SESSION['customer_email'];
                
            $get_c = "SELECT * FROM customer WHERE customer_email='$user'";
                
            $run_c = mysqli_query($con, $get_c);
                
            $row_c = mysqli_fetch_array($run_c);
                
            $c_id = $row_c['customer_id'];
            $c_email = $row_c['customer_email'];
            $c_name = $row_c['customer_name'];
            
            //betalnings infor från paypal
            
            $amount = $_GET['amt'];
            
            $currency = $_GET['cc'];
            
            $trx_id = $_GET['tx'];

            $invoice = mt_rand();
                
                //skickar betalningen till payments table
                $insert_payment = "INSERT INTO payments (amount,customer_id,product_id,trx_id,currency,payment_date) values ('$amount','$c_id','$pro_id','$trx_id','$currency',NOW())";
                
                $run_payment = mysqli_query($con, $insert_payment);
                
                // skickar infor till orders table
                $insert_order = "INSERT INTO orders (p_id, c_id, qty, invoice_no,status, order_date) VALUES ('$pro_id','$c_id','$qty','$invoice','in Progress', NOW())";
                $run_order = mysqli_query($con, $insert_order);
                
                //ta bort produkter från cart
                $empty_cart = "DELETE FROM cart";
                $run_cart = mysqli_query($con, $empty_cart);
                
                
                
        if ($amount==$total) {
            echo "<h2>Welcome:" . $_SESSION['customer_email']. "<br>" . "Your Payment was successful!</h2>";
            echo "<a href='https://applikationsutveckling.000webhostapp.com/index.php'>Go to your Account</a>";
        } else {
            echo "<h2>Your Payment has failed</h2><br>";
            echo "<a href='https://applikationsutveckling.000webhostapp.com'>Go to Back to shop</a>";
        }
          
$headers = "Content-Type: text/plain; charset=utf-8\r\n";
$headers.= "MIME-Version: 1.0\r\n";
$headers.= "From: applikationsutveckling@gmail.com"."\r\n"." CC: somebodyelse@example.com";
    $subject = "Order confirmation";
    $message =
"Hej $c_name och tack för att du handlat hos oss!
    
Här kommer din orderspecifikation applikationsutveckling.000webhostapp.com

Produkten : $pro_name
Antal     : $qty
Pris      : $amount 
Faktura nr: $invoice

klicka här 
https://applikationsutveckling.000webhostapp.com 
för att gå till din sida
Välkommen åter

";
    
    mail($c_email, $subject, $message, $headers);
    
 

?>
</body>
</html>