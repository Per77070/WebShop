<?php 
session_start();
include("functions/functions.php");
include("includes/db.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webshop</title>
        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/7343a86b55.js"></script>
</head>
<body>
 
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-author" href="index.php">Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="allproducts.php">Products
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php 
          if(!isset($_SESSION['customer_email'])){
            echo "";
          
          
          }
          else {
            echo "<a class='nav-link' href='customer/my_account.php'>My Account</a>";
          }
          ?>
        <li class="nav-item">
        <?php 
        if(!isset($_SESSION['customer_email'])){
        
        echo "<a class='nav-link' href='checkout.php' >Login</a>";
        
        }
        else {
        echo "<a class='nav-link' href='logout.php' >Logout</a>";
        }
        ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="api.php"> JSON </a>
        </li>
          <form class="form-inline my-2 my-lg-0"method="GET" action="search.php" enctype="multipart/form-data" >
    <input class="form-control mr-sm-2" type="text" name="user_search"placeholder="Search" >
    <button class="btn btn-outline-inverse my-2 my-sm-0" name="search"type="submit">Search</button>
  </form>
        </ul>
      </div>
    </div>
  </nav> 
      <!-- Navigation END -->
<div class="container"> <!-- Main container -->
        <!-- Sidebar -->
        <?php cart(); ?>
        <div class="float-right"><small class="text-muted">
        <?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>    
        
       <a href="cart.php" >
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>  <?php total_items(); ?>  
          <i class="fa fa-money" aria-hidden="true"></i> <?php total_price(); ?>:-</a>
          <?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='checkout.php' >Login</a>";
					
					}
					else {
					echo "<a href='logout.php' >Logout</a>";
					}
					
					
					
					?></small></div>

<div id="wrap"class="row float-left">
        <div class="col-lg-3 d-none d-lg-block">
          <div class="list-group">
            <h4 class="my-4">Categories</h4>
            <?php getCats(); ?>

          </div>
        </div>
        <!-- Sidebar END -->
        <!-- jumbo carousel -->
        <div class="col-lg-9">
        
                  <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                      <div class="carousel-item active">
                        <img class="d-block img-fluid" src="img/t1.jpg" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block img-fluid" src="img/t2.jpg" alt="Second slide">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
 <!-- jumbo carousel end-->
 
 <div id="reg" class="row">
 
 <div class="col-lg-9">
  <form class="form-signin" action="" method="POST">
  
    <h2 class="form-signin-heading">Register here</h2>
 
    <label for="customer_name" class="sr-only">First</label>
    <input type="text" required  name="customer_name" id="fname" placeholder="Ange förnamn" class="form-control" autofocus>
    
    <label for="customer_lname" class="sr-only">Last</label>
    <input type="text" required name="customer_lname" id="lname" placeholder="Ange efternamn" class="form-control" autofocus>
    
    <label for="customer_email" class="sr-only">Email</label>
    <input type="email" required  name="customer_email" id="email" placeholder="Ange e-post" class="form-control" autofocus>
    
    <label for="customer_pwd" class="sr-only">Password</label>
    <input type="password" required name="customer_pwd" id="pwd" placeholder="Ange lösenord"class="form-control">
 
    <label for="customer_adress" class="sr-only">Utdelningsadress</label>
    <input type="text" required  name="customer_adress" id="uds" placeholder="Ange utdelningsadress" class="form-control" autofocus>
    
    <label for="customer_postnr" class="sr-only">Postnummer</label>
    <input type="text" required name="customer_postnr" id="pnr" placeholder="Ange postnummer" class="form-control" autofocus>
    
    <label for="customer_postort" class="sr-only">Postort</label>
    <input type="text" required  name="customer_postort" id="pot" placeholder="Ange postort" class="form-control" autofocus>
    
    
    <input class="btn btn-lg btn-primary btn-block" name="signup" value="Sign up" type="submit"/>
  </form>
  
 
 
  </div>      
 </div>
 </div>
 
 
 <?php 
     if(isset($_POST['signup'])){
     
       
         $ip = getIp();
       
         $customer_name = $_POST['customer_name'];
       $customer_lname = $_POST['customer_lname'];
         $customer_email = $_POST['customer_email'];
       $customer_pwd = $_POST['customer_pwd'];
         $customer_adress = $_POST['customer_adress'];
       $customer_postnr = $_POST['customer_postnr'];
         $customer_postort = $_POST['customer_postort'];
       
        $insert_customer = "INSERT INTO customer (customer_ip,customer_name,customer_lname,customer_email,customer_pwd,customer_adress,customer_postnr,customer_postort)
         values ('$ip','$customer_name','$customer_lname','$customer_email','$customer_pwd','$customer_adress','$customer_postnr','$customer_postort')";
     
       $run_customer = mysqli_query($con, $insert_customer); 
       
         $sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
       
       $run_cart = mysqli_query($con, $sel_cart); 
       
         $check_cart = mysqli_num_rows($run_cart); 
       
       if($check_cart==0){
       
       $_SESSION['customer_email']=$customer_email; 
       
       echo "<script>alert('Sign up succesfull!')</script>";
 
         echo "<script>window.open('customer/my_account.php','_self')</script>";
       
       }
       else {
       
       $_SESSION['customer_email']=$customer_email; 
       
       echo "<script>alert('Sign up successfull!')</script>";
       
         echo "<script>window.open('checkout.php','_self')</script>";
       
       
       }
     }
   
 ?>
  
</div>
          <!-- row end -->

        </div>
        <!-- col-lg-9 end-->

      </div>
      <!-- row end-->




</div><!-- Main container END-->
<nav id="footer" class="navbar fixed-bottom navbar-dark bg-dark">
    <p class="text-white">Copyright &copy 2017 </p>
  </nav>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>