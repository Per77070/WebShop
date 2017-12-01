<?php 
include("includes/db.inc.php"); 
if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=notloggedIn','_self')</script>";
}
else {
    ?>
<form class="form-group"action="" method="post">

<b>Insert a new category</b>
<input type="text" name="new_cat" placeholder="Ange kategori" required/> 
<input class="btn btn-sm btn-dark" type="submit" name="add_cat" value="Add Category" /> 

</form>

<?php

	if(isset($_POST['add_cat'])){
	
	$new_cat = $_POST['new_cat'];
	
	$insert_cat = "INSERT INTO categories (cat_title) VALUES ('$new_cat')";

	$run_cat = mysqli_query($con, $insert_cat); 
	
	if($run_cat){
	
	echo "<script>alert('Category has been inserted!')</script>";
	echo "<script>window.open('index.php?view_cats','_self')</script>";
	}
	}

?><?php } ?>