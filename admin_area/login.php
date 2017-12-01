<?php 
session_start();

?>
<html lang="en">
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
<div>
	
	
<h1>Admin Login</h1>
<form method="post" action="login.php">
	<input type="text" name="email" placeholder="Eamil" required="required" />
	<input type="password" name="password" placeholder="Password" required="required" />
	<button type="submit" class="btn btn-primary btn-large" name="login">Login</button>
</form>
</div>


</body>
</html>
<?php 

include("includes/db.inc.php"); 

if(isset($_POST['login'])){

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$pass = mysqli_real_escape_string($con, $_POST['password']);

$sel_user = "SELECT * FROM admins WHERE user_email='$email' AND user_pass='$pass'";

$run_user = mysqli_query($con, $sel_user); 

 $check_user = mysqli_num_rows($run_user); 

if($check_user==1){

$_SESSION['user_email']=$email; 

echo "<script>window.open('index.php?logged_in=loggedIn!','_self')</script>";

}
else {

echo "<script>alert('Password or Email is wrong')</script>";

}


}
	
	
	
	
	








?>