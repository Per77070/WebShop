<?php 
include("functions/functions.php");

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
          <a class="nav-link" href="api.php">--> JSON <--</a>
          </li>
            <form class="form-inline my-2 my-lg-0"method="GET" action="search.php" enctype="multipart/form-data" >
      <input class="form-control mr-sm-2" type="text" name="user_search"placeholder="Search" >
      <button class="btn btn-outline-inverse my-2 my-sm-0" name="search"type="submit">Search</button>
    </form>
          </ul>
        </div>
      </div>
    </nav>      <!-- Navigation END -->
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
<div id="wrap" class="row float-left">
        <div class="col-lg-3 d-none d-lg-block">
          <div class="list-group">
            <h4 class="my-4">Categories</h4>
            <?php getCats(); ?>


          </div>
        </div>

        <!-- Sidebar END -->
        <!-- jumbo carousel -->
        
            <?php
                if(isset($_GET['pro_id'])){
                    $product_id=$_GET['pro_id'];

                    $get_pro = "SELECT * FROM products WHERE product_id='$product_id'"; 
                    $run_pro = mysqli_query($con, $get_pro);
                    if (mysqli_num_rows($run_pro) > 0) {
                while($row_pro = mysqli_fetch_array($run_pro)){
                    
                    $pro_id = $row_pro['product_id'];
            
                    $pro_cat = $row_pro['product_cat'];
            
                    $pro_author = $row_pro['product_author'];
                    
                    $pro_title = $row_pro['product_title'];
                    
                    $pro_price = $row_pro['product_price'];
            
                    $pro_desc = $row_pro['product_desc'];
                    
                    $pro_img = $row_pro['product_img'];
            
                    $pro_key = $row_pro['product_keyword'];
            
                    
                    
                          echo '<div class="col-lg-9">
                                    <div class="card mt-4">
                                    <a href="#"><img class="card-img-top img-fluid" src="admin_area/product_img/'.$pro_img.'" alt=""></a>
                                     <div class="card-body">
                                      <h4 class="card-title">
                                      <a href="product.page.php?pro_id='.$pro_id.'">'.$pro_title.'</a>
                                      </h4>
                                      <h5>Price: '.$pro_price.':-</h5>
                                       <p class="card-text">'.$pro_desc.'</p>
                                      <h6>By '.$pro_author.'</h6>
                                     </div>
                                    <div class="card-footer">
                                    <a href="index.php?add_cart='.$pro_id.'"><span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                                    4.0 stars
                                  <button class="btn btn-outline-success my-2 my-sm-0 float-right" name="add_cart"type="submit">Add to cart</button></a>
                                  </div>';
            }
            
            
            }
            
            }
            ?>
            
            <div class="card card-outline-secondary my-4">
            <div class="card-header">
              Product Reviews
            </div>
            <div class="card-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
              <small class="text-muted">Posted by Anonymous on 3/1/17</small>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
              <small class="text-muted">Posted by Anonymous on 3/1/17</small>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
              <small class="text-muted">Posted by Anonymous on 3/1/17</small>
              <hr>
              <a href="#" class="btn btn-success">Leave a Review</a>
            </div>
          </div>
          </div>
        </div>
                
                <!-- /.col-lg-9 -->
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