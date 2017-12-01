<!DOCTYPE>
<?php 

include("includes/db.inc.php");
if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
}
else {

if(isset($_GET['edit_pro'])){

	$get_id = $_GET['edit_pro']; 
	
	$get_product = "SELECT * FROM products WHERE product_id='$get_id'";
	
	$run_product = mysqli_query($con, $get_product); 
	
	
	$row_product=mysqli_fetch_array($run_product);
		
		$product_id = $row_product['product_id'];
		$product_title = $row_product['product_title'];
		$product_img = $row_product['product_img'];
		$product_price = $row_product['product_price'];
		$product_desc = $row_product['product_desc']; 
		$product_keyword = $row_product['product_keyword']; 
		$product_cat = $row_product['product_cat'];
		$product_author = $row_product['product_author'];
		
		$get_cat = "SELECT * FROM categories WHERE cat_id='$product_cat'";
		
		$run_cat=mysqli_query($con, $get_cat); 
		
		$row_cat=mysqli_fetch_array($run_cat); 
		
		$category_title = $row_cat['cat_title'];
		
}
?>




	<form action="" method="post" enctype="multipart/form-data"> 
		
		<table class="table" align="center">
			
			<tr align="center">
				<td colspan="7"><h2>Edit or Update product</h2></td>
			</tr>
			
			<tr>
				<td align="right"><b>product Title:</b></td>
				<td><input type="text" name="product_title" value="<?php echo $product_title;?>"/></td>
			</tr>
			
			<tr>
				<td align="right"><b>product Category:</b></td>
				<td>
				<select name="product_cat" >
					<option><?php echo $category_title; ?></option>
					<?php 
		$get_cats = "SELECT * FROM categories";
	
		$run_cats = mysqli_query($con, $get_cats);
	
		while ($row_cats=mysqli_fetch_array($run_cats)){
	
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
	
		echo "<option value='$cat_id'>$cat_title</option>";
	
	
	}
					
					?>
				
				
				</td>
			</tr>
	
			<tr>
				<td align="right"><b>product Author</b></td>
				<td><input type="text" value="<?php echo $product_author;?>" name="product_author"/></td>
			</tr>
				</td>
			</tr>
			<tr>
				<td align="right"><b>product img:</b></td>
				<td><input type="file" name="product_img" /><img src="product_img/<?php echo $product_img; ?>" width="50" height="50"/></td>
			</tr>
			
			<tr>
				<td align="right"><b>product Price:</b></td>
				<td><input type="number" name="product_price" value="<?php echo $product_price;?>"/></td>
			</tr>
			
			<tr>
				<td align="right"><b>product Description:</b></td>
				<td><textarea name="product_desc" cols="20" rows="6"><?php echo $product_desc;?></textarea></td>
			</tr>
			
			<tr>
				<td align="right"><b>product keyword:</b></td>
				<td><input type="text" name="product_keyword"  value="<?php echo $product_keyword;?>"/></td>
			</tr>
			
			<tr align="center">
				<td ><input class="btn btn-sm btn-dark" type="submit" name="update_product" value="Update product"/></td>
			</tr>
		
		</table>
	</form>


</body> 
</html>
<?php 

	if(isset($_POST['update_product'])){
	
		//getting the text data from the fields
		
		$update_id = $product_id;
		
		$product_title = $_POST['product_title'];
		$product_cat= $_POST['product_cat'];
		$product_author = $_POST['product_author'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keyword = $_POST['product_keyword'];
	
		//getting the img from the field
		$product_img = $_FILES['product_img']['name'];
		$product_img_tmp = $_FILES['product_img']['tmp_name'];
		
		move_uploaded_file($product_img_tmp,"product_img/$product_img");
	
		 $update_product = "UPDATE products SET product_cat='$product_cat',
         product_author='$product_author',product_title='$product_title',
         product_price='$product_price',product_desc='$product_desc',
         product_img='$product_img', product_keyword='$product_keyword'
          WHERE product_id='$update_id'";
		 
		 $run_product = mysqli_query($con, $update_product);
		 
		 if($run_product){
		 
		 echo "<script>alert('product has been updated!')</script>";
		 
		 echo "<script>window.open('index.php?view_products','_self')</script>";
		 
		 }
	}








?><?php } ?>