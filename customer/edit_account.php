<?php 	
				include("includes/db.inc.php"); 
				
				$user = $_SESSION['customer_email'];
				
				$get_customer = "SELECT * FROM customer WHERE customer_email='$user'";
				
				$run_customer = mysqli_query($con, $get_customer); 
				
        $row_customer = mysqli_fetch_array($run_customer); 
        
				$c_id = $row_customer['customer_id'];
        $customer_name = $row_customer['customer_name'];
        $customer_lname = $row_customer['customer_lname'];
          $customer_email = $row_customer['customer_email'];
        $customer_pwd = $row_customer['customer_pwd'];
          $customer_adress = $row_customer['customer_adress'];
        $customer_postnr = $row_customer['customer_postnr'];
          $customer_postort = $row_customer['customer_postort'];
				
				
		?>
 

 
 <div class="col-lg-9">
  <form class="form" action="" method="POST" enctype="multipart/form-data">
  
    <h2 class="form-signin-heading">Update your account</h2>
 
    
    <input type="text" required  name="customer_name" id="fname" placeholder="Ange förnamn" class="form-control" autofocus>
    
    
    <input  type="text" required name="customer_lname" id="lname" placeholder="Ange efternamn" class="form-control" autofocus>
    
    
    <input  type="email" required  name="customer_email" id="email" placeholder="Ange e-post" class="form-control" autofocus>
    
    
    <input  type="password" required name="customer_pwd" id="pwd" placeholder="Ange lösenord"class="form-control">
 

    <input  type="text" required  name="customer_adress" id="uds" placeholder="Ange utdelningsadress" class="form-control" autofocus>
    
    
    <input  type="text" required name="customer_postnr" id="pnr" placeholder="Ange postnummer" class="form-control" autofocus>
    
    
    <input type="text" required  name="customer_postort" id="pot" placeholder="Ange postort" class="form-control" autofocus>
    
    
    <input class="btn btn-lg btn-primary btn-block" name="update" value="Update" type="submit"/>
  </form>
  
 
 
  </div>      
 </div>
 </div>
 
 
 <?php 
     if(isset($_POST['update'])){
     
       
         $ip = getIp();
 
        $customer_id = $c_id;

         $customer_name = $_POST['customer_name'];
         $customer_lname = $_POST['customer_lname'];
         $customer_email = $_POST['customer_email'];
         $customer_pwd = $_POST['customer_pwd'];
         $customer_adress = $_POST['customer_adress'];
         $customer_postnr = $_POST['customer_postnr'];
         $customer_postort = $_POST['customer_postort'];
       
        $update_customer = "UPDATE customer SET 
        customer_name= '$customer_name',
        customer_lname= '$customer_lname',
        customer_email= '$customer_email',
        customer_pwd= '$customer_pwd',
        customer_adress= '$customer_adress',
        customer_postnr= '$customer_postnr',
        customer_postort= '$customer_postort'
        WHERE customer_id='$customer_id'";
	

$run_update = mysqli_query($con, $update_customer); 

if($run_update){

echo "<script>alert('Your account is Updated')</script>";
echo "<script>window.open('my_account.php','_self')</script>";

}
}


       
 ?>
  

      