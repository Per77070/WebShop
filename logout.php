<?php 

session_start(); 

session_destroy();  //avslutar sessions


echo "<script>window.open('index.php','_self')</script>";


?>