<?php 
session_start(); 

if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
}
else {

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin area</title>
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/7343a86b55.js"></script>
</head>
<body>
 
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-author" href="index.php">Admin area</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
           

          </ul>
        </div>
      </div>
    </nav> 
      <!-- Navigation END -->
<div class="container"> <!-- Main container -->

<div id="wrap"class="row float-left">
<div class="col-lg-3 d-none d-lg-block">
  <div class="list-group">
    <h4 class="my-4">Options</h4>
  <a class="list-group-item" href="index.php?insert_product">Insert New Product</a>
  <a class="list-group-item" href="index.php?view_products">View All Products</a>
  <a class="list-group-item" href="index.php?insert_cat">Insert New Category</a>
  <a class="list-group-item" href="index.php?view_cats">View All Categories</a>
  <a class="list-group-item" href="index.php?view_customers">View customers</a>
  <a class="list-group-item" href="index.php?view_orders">View Orders</a>
  <a class="list-group-item" href="index.php?view_payments">View Payments</a>
  <a class="list-group-item" href="logout.php">Admin Logout</a>
</div>
</div>


<div class="col-lg-9">
<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
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
          <div class="row justify-content-center text-center">
          <div class="col-lg-9">
         
          <?php 
		if(isset($_GET['insert_product'])){
		
		include("insert_product.php"); 
		
		}
		if(isset($_GET['view_products'])){
		
		include("view_products.php"); 
		
		}
		if(isset($_GET['edit_pro'])){
		
		include("edit_pro.php"); 
		
		}
		if(isset($_GET['insert_cat'])){
		
		include("insert_cat.php"); 
		
		}
		
		if(isset($_GET['view_cats'])){
		
		include("view_cats.php"); 
		
		}
		
		if(isset($_GET['edit_cat'])){
		
		include("edit_cat.php"); 
		
		}
		
		if(isset($_GET['insert_author'])){
		
		include("insert_author.php"); 
		
		}
		
		if(isset($_GET['view_authors'])){
		
		include("view_authors.php"); 
		
		}
		if(isset($_GET['edit_author'])){
		
		include("edit_author.php"); 
		
		}
		if(isset($_GET['view_customers'])){
		
		include("view_customers.php"); 
		
		}
		
		?>

             </div>    <!-- row end -->

        </div>
        <!-- col-lg-9 end-->

      </div>
      <!-- row end-->




</div><!-- Main container END-->
<nav id="footer" class="navbar fixed-bottom navbar-dark bg-dark">
    <p class="text-white">Copyright &copy 2017 </p>
  </nav>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } ?>