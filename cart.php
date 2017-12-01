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
          if (!isset($_SESSION['customer_email'])) {
              echo "";
          } else {
              echo "<a class='nav-link' href='customer/my_account.php'>My Account</a>";
          }
          ?>
        <li class="nav-item">
        <?php 
        if (!isset($_SESSION['customer_email'])) {
            echo "<a class='nav-link' href='checkout.php' >Login</a>";
        } else {
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
                    if (isset($_SESSION['customer_email'])) { //dynamisk välkomst meddelande
                        echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b>Your</b>" ;
                    } else {
                        echo "<b>Welcome Guest:</b>";
                    }
                    ?>    
        
       <a href="cart.php" > 
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>  <?php total_items(); ?>  
          <i class="fa fa-money" aria-hidden="true"></i> <?php total_price(); ?>:-</a>
          
          <?php 
                    if (!isset($_SESSION['customer_email'])) { // ifsat som kollar om man inte är inloggad
                    
                        echo "<a href='checkout.php' >Login</a>";
                    } else {
                        echo "<a href='logout.php' >Logout</a>";
                    }
                    
                    
                    
                    ?></small>
      </div>
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
 
 <div class="row float-none justify-content-center">
 <div class=" ">
 <form action="" method="POST" enctype="multipart/form-data">
 <table class="table justify-content-center">
    <thead class="thead-light">
     <tr>
      <th scope="col-">Products</th>
       <th class="d-none d-lg-block" scope="col-">img</th>
        <th scope="col-">Price</th>
       <th class="text-center" scope="col-">#</th>
      <th class="text-left"scope="col-">Remove</th>
    </tr>
  </thead>
<tbody>
      
<?php
            $total=0;
    
            global $con;
    
            $ip = getIp(); //ger oss besökarens ip adress och lagrar det in variabeln
            
            $get_price="SELECT * FROM cart WHERE ip_add='$ip'"; //skapa variable av mysql kommando som hämtar priser för allt som besökaren med denna specifika IP adress lagt i sin kundvagn
            
            $run_price= mysqli_query($con, $get_price); //connecta och hämta priser
    
            while ($p_price = mysqli_fetch_array($run_price)) {
                $pro_id = $p_price['p_id'];
    
                $pro_price = "SELECT * FROM products WHERE product_id='$pro_id'"; //hämta all info från alla produkter där id matchar
    
                $run_pro_price = mysqli_query($con, $pro_price);
    
                while ($pp_price = mysqli_fetch_array($run_pro_price)) {
                    $product_price=array($pp_price['product_price']); //array av alla produkters priser
                    
                    $product_title=$pp_price['product_title'];
                    
                    $product_img=$pp_price['product_img'];
                    
                    $single_price=$pp_price['product_price'];

                    $values= array_sum($product_price); //adderar värdet av en array av priser
    
                    $total+=$values; ?>    
          
       <tr><td><?php echo $product_title?></td>
         <td class="d-none d-lg-block"><img src="admin_area/product_img/<?php echo $product_img; ?>" width="40" height="40" alt=""></td>
          <td><?php echo $single_price?>:-</td>
        <td class="text-center"> <input type="text" size="3" name="qty" value="<?php echo $_SESSION['qty']; ?>"></td>
      <td class="text-center"><input type="checkbox" value="<?php echo $pro_id?>" name="remove[]"></td></tr>
    <?php
                }
            }
      ?>        <?php
      //
      if (isset($_POST['update'])) { //uppdaterar pris och qvantitet
        
        $quantity =$_POST['qty']; // lagra värdet från formuläret i temp variable

          $update_quantity = "UPDATE cart SET qty='$quantity'"; //sätter qty i db till samma värde som får temp variable och lagrar denna i update_quantity

          $run_quantity= mysqli_query($con, $update_quantity); //excekverar connection och uppdateringen

          $_SESSION ['qty']=$quantity; //skapar session med värdet från db som lagrar detta i temp var

          $total = $total*$quantity;
      }
      ?>
      <tr>
        <td><button type="submit" name="continue" class="btn btn-sm btn-primary">Continue Shopping</button></td>
        <td class="d-none d-lg-block"></td>
        <td><?php echo $total; ?>:-</td>
        <td class="text-left"><a href=""></a><button type="submit" name="update"class="btn btn-sm btn-primary">Update</button></td>
        <td class="text-center"><button type="submit" name="checkout"class="btn btn-sm btn-success"><a href="checkout.php">Buy</a></button></td></tr>
        </table>
        </form>
        

<!-- Delete funktion -->
          <?php
              function updateCart()
              {
                  global $con;
                  $ip = getIp();

                  if (isset($_POST['update'])) {
                      foreach ($_POST['remove'] as $remove_id) { //för varje remove checkbox

                          $delete_product = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip'"; //skapa variable av mysql kommande från kundvagn efter att man matchar produkt id med motsavarande checkbox

                          $run_delete = mysqli_query($con, $delete_product); //connecta och radera

                          if ($run_delete) {
                              echo "<script>window.open('cart.php','_self')</script>"; //js för att återgå till samma sida
                          }
                      }
                  }
                  //continue shopping
              if (isset($_POST['continue'])) { //om man trycker på continue shopping
                
                echo "<script>window.open('index.php','_self')</script>"; //så kommmer man till index
              }
              } echo @$update_cart = updateCart(); // buggar pga att updateknappen kan radera/lägga till samtidigt :(
          ?>
        </div> 
      </div>     <!-- row end -->
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