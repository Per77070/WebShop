<?php

$dbHost="localhost";
$dbUser="id3791242_applikationsutveckling";
$dbPass="Newton1234";
$dbName="id3791242_webshop";

$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)
or die("Failed to connect");

$products = "SELECT * FROM products";
$row = mysqli_query($con, $products); 
$rows = array();

while($r = mysqli_fetch_assoc($row)) {
   $rows[] = $r;
}
echo json_encode($rows);

?>