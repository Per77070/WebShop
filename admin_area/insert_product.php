<?php 


include("includes/db.inc.php"); 
if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
}
else {
?>

    <form class="form-group"action="insert_product.php" method="POST" enctype="multipart/form-data">
    <div class="container">
    <table class="table">
    <thead>
    <tr align="center">
		<td colspan="6"><h2>View All Products Here</h2></td>
	</tr>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Insert</th>
        <th scope="col">Product</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Title</td>
        <td><input required type="text" name="product_title"></td>
      </tr>
      <tr>
      <tr>
        <th scope="row">2</th>
        <td>Author</td>
        <td><input required type="text" name="product_author"></td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Category</td>
        <td><select required name="product_cat">
            <option value="Select category"></option>
            <?php
                $get_cats = "SELECT * FROM categories"; //select all categories
                $run_cats = mysqli_query($con,$get_cats);
            
            while($row_cats = mysqli_fetch_array($run_cats)){
                
                $cat_id = $row_cats['cat_id'];
                $cat_title = $row_cats['cat_title'];
 
                echo '<option value='.$cat_id.'>'.$cat_title.'</option>';
            
            }
            ?>
            </select>
        </td>
      </tr>

        <th scope="row">4</th>
        <td>Price</td>
        <td><input required type="number" name="product_price"></td>
      </tr>
      <tr>
        <th scope="row">5</th>
        <td>Keyword</td>
        <td><input required type="text" name="product_keyword"></td>
      </tr>
      <tr>
        <th scope="row">6</th>
        <td>Description</td>
        <td><textarea type="text" name="product_desc" cols="20" rows="5"></textarea></td>
      </tr>
      <tr>
        <th scope="row">7</th>
        <td>img</td>
        <td><input required class="btn btn-sm btn-light"  type="file" name="product_img"></td>
      </tr>
      <tr>
        <th scope="row"></th>
        <td></td>
        <td><input required class="btn btn-sm btn-dark" type="submit" name="insert_post" value="Insert now"></td>
      </tr>
    </tbody>
  </table>
  </div>
  


    </form>
    
    <?php
    include "../includes/footer.php";

            if (isset($_POST['insert_post'])) {
                
                $product_title = $_POST['product_title'];

                $product_author = $_POST['product_author'];
                
                $product_cat = $_POST['product_cat'];

                $product_price = $_POST['product_price'];
                
                $product_keyword = $_POST['product_keyword'];
                
                $product_desc = $_POST['product_desc'];
                
                //getting the img from the uppload field
                $product_img = $_FILES['product_img']['name'];
                $product_img_tmp = $_FILES['product_img']['tmp_name'];
                
                move_uploaded_file($product_img_tmp,"product_img/$product_img");
                
                 $insert_product = "INSERT INTO products
                (product_cat,product_author,product_title,product_price,product_desc,product_img,product_keyword)
          values('$product_cat','$product_author','$product_title','$product_price','$product_desc','$product_img','$product_keyword') ";
                
                $insert_pro = mysqli_query($con,$insert_product);
                if ($insert_pro) {
                    echo "<script> alert ('Product has been inserted!')</script>";
                    echo "<script> window.oped('insert_product.php','_self')</script>";
                }
        
        }



    ?><?php } ?>