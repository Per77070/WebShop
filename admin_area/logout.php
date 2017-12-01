<?php 

session_start(); 

session_destroy(); 

echo "<script>window.open('login.php?logged_out=loggedout','_self')</script>";




?> 