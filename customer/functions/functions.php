<?php 
//connect
$dbHost="localhost";
$dbUser="id3791242_applikationsutveckling";
$dbPass="Newton1234";
$dbName="id3791242_webshop";
$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)
or die("Failed to connect");


//copy paste för att hämta IP från besökaren
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
// skapa cart funktionen och koppla ihop besökarens IP 
function cart(){
    if (isset($_GET['add_cart'])) {
        global $con;

        $ip=getIp();

        $pro_id= $_GET['add_cart'];

        $check_pro= "SELECT * FROM cart WHERE ip_add='$ip'AND p_id='$pro_id'";

        $run_check = mysqli_query($con,$check_pro);
        
        if(mysqli_num_rows($run_check)>0){ //hindrar dubbla beställningar 
            echo "";
        }
        else{
            $insert_pro = "INSERT INTO cart (p_id,ip_add) VALUES ('$pro_id','$ip')";

            $run_pro = mysqli_query($con, $insert_pro);
            
            echo "<script> window.open('index.php','self')</script>"; 
        }
    }
}
//hämta totala produkter
function total_items(){
    
    if (isset($_GET['add_cart'])) { //visa kundvagnen när det finns varor i den
    
        global $con;
        $ip = getIp();
        
        $get_items="SELECT * FROM cart WHERE ip_add='$ip'"; 
        
        $run_items= mysqli_query($con, $get_items); 

        $count_items= mysqli_num_rows($run_items);

     } else {                           //visa kundvagnen när den är tom
        global $con;
        
        $get_items="SELECT * FROM cart WHERE ip_add='$ip'";
        
        $run_items= mysqli_query($con, $get_items); 

        $count_items= mysqli_num_rows($run_items);
        }

        echo $count_items;
        
    }

//hämta totala priset för produkterna
function total_price(){
    
    if (isset($_GET['add_cart'])) { //visa kundvagnen när det finns varor i den
        
        $total=0;

        global $con;

        $ip = getIp();
        
        $get_price="SELECT * FROM cart WHERE ip_add='$ip'"; 
        
        $run_price= mysqli_query($con, $get_price); 

        while ($p_price = mysqli_fetch_array($run_price)) {
            
            $pro_id = $p_price['p_id'];

            $pro_price = "SELECT * FROM products WHERE product_id='$pro_id'";

            $run_pro_price = mysqli_query($con,$pro_price);

            while ($pp_price = mysqli_fetch_array($run_pro_price)) { //räkna ut totala priset

                $product_price=array($pp_price['product_price']);

                $values= array_sum($product_price);

                $total+=$values;
        }
        
    }    
    
    }
    echo $total;
}
//hämta kategorierna
function getCats(){
    global $con;

    $get_cats = "SELECT * FROM categories"; //hämta alla 
    $run_cats = mysqli_query($con,$get_cats);

while($row_cats = mysqli_fetch_array($run_cats)){
    
    $cat_id = $row_cats['cat_id'];
    $cat_title = $row_cats['cat_title'];

    echo '<a href="index.php?cat='.$cat_id.'" class="list-group-item">'.$cat_title.'</a>';

}

}
//hämta och visa författare
function getAuthors(){
    global $con;

    $get_authors = "SELECT * FROM author"; //select all
    $run_authors = mysqli_query($con,$get_authors);

while($row_authors = mysqli_fetch_array($run_authors)){
    
    $author_id = $row_authors['author_id'];
    $author_name = $row_authors['author_name'];

    echo '<a href="index.php?author='.$author_name.'" class="list-group-item">'.$author_name.'</a>';

}

}
// Hämta produkter

function getPro(){
    if (!isset($_GET['cat'])) {
        
        if (!isset($_GET['author'])){
    global $con;
    
        $get_pro = "SELECT * FROM products ORDER BY RAND()
        LIMIT 3"; 
        $run_pro = mysqli_query($con, $get_pro);
        
    while($row_pro = mysqli_fetch_array($run_pro)){
        
        $pro_id = $row_pro['product_id'];

        $pro_cat = $row_pro['product_cat'];

        $pro_author = $row_pro['product_author'];
        
        $pro_title = $row_pro['product_title'];
        
        $pro_price = $row_pro['product_price'];

        $pro_desc = $row_pro['product_desc'];
        
        $pro_img = $row_pro['product_img'];

        $pro_key = $row_pro['product_keyword'];

        
        
              echo '<div class="col-lg-4 col-md-6 mb-4">
                      <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="admin_area/product_img/'.$pro_img.'" alt=""></a>
                         <div class="card-body">
                          <h5 class="card-title">
                          <a href="product.page.php?pro_id='.$pro_id.'">'.$pro_title.'</a>
                          </h5>
                          <h6>Price: '.$pro_price.':-</h6>
                          <p class="card-text">'.$pro_author.'</p>
                         </div>
                        <div class="card-footer">
                        <a href="index.php?add_cart='.$pro_id.'">
                      <button class="btn btn-outline-success my-2 my-sm-0" name="add_cart"type="submit">Add to cart</button></a>
                      </div>
                    </div>
                  </div>';
}

        }
}

}



// getting the products

function getCatPro(){
    if (isset($_GET['cat'])) {
        
        $cat_id = $_GET['cat'];
    global $con;
    
        $get_cat_pro = "SELECT * FROM products where product_cat='$cat_id'"; 

        $run_cat_pro = mysqli_query($con, $get_cat_pro);
        
    while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){
        
        $pro_id = $row_cat_pro['product_id'];

        $pro_cat = $row_cat_pro['product_cat'];

        $pro_author = $row_cat_pro['product_author'];
        
        $pro_title = $row_cat_pro['product_title'];
        
        $pro_price = $row_cat_pro['product_price'];

        $pro_desc = $row_cat_pro['product_desc'];
        
        $pro_img = $row_cat_pro['product_img'];

        $pro_key = $row_cat_pro['product_keyword'];

        
        
              echo '<div class="col-lg-4 col-md-6 mb-4">
                      <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="admin_area/product_img/'.$pro_img.'" alt=""></a>
                         <div class="card-body">
                          <h5 class="card-title">
                          <a href="product.page.php?pro_id='.$pro_id.'">'.$pro_title.'</a>
                          </h5>
                          <h6>'.$pro_price.':-</h6>
                          <p class="card-text">'.$pro_author.'</p>
                         </div>
                        <div class="card-footer">
                        <a href="index.php?add_cart='.$pro_id.'">
                      <button class="btn btn-outline-success my-2 my-sm-0" name="add_cart"type="submit">Add to cart</button></a>
                      </div>
                    </div>
                  </div>';
}

        }
}

function getAuthorPro(){
    if (isset($_GET['author'])) {
        
        $author_name = $_GET['author'];
    global $con;
    
        $get_author_pro = "SELECT * FROM products where product_author='$author_name'"; 

        $run_author_pro = mysqli_query($con, $get_author_pro);
        
    while($row_author_pro = mysqli_fetch_array($run_author_pro)){
        
        $pro_id = $row_author_pro['product_id'];

        $pro_cat = $row_author_pro['product_cat'];

        $pro_author = $row_author_pro['product_author'];
        
        $pro_title = $row_author_pro['product_title'];
        
        $pro_price = $row_author_pro['product_price'];

        $pro_desc = $row_author_pro['product_desc'];
        
        $pro_img = $row_author_pro['product_img'];

        $pro_key = $row_author_pro['product_keyword'];

        
        
              echo '<div class="col-lg-4 col-md-6 mb-4">
                      <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="admin_area/product_img/'.$pro_img.'" alt=""></a>
                         <div class="card-body">
                          <h5 class="card-title">
                          <a href="product.page.php?pro_id='.$pro_id.'">'.$pro_title.'</a>
                          </h5>
                          <h6>'.$pro_price.':-</h6>
                          <p class="card-text">'.$pro_author.'</p>
                         </div>
                        <div class="card-footer">
                        <a href="index.php?add_cart='.$pro_id.'">
                      <button class="btn btn-outline-success my-2 my-sm-0" name="add_cart"type="submit">Add to cart</button></a>
                      </div>
                    </div>
                  </div>';
}

        }
}


?>