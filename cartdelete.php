<?php 
include("dbinit.php");

$cartID = $_GET['cartID'];

$connection = new DatabaseConnection();
$delete_cart_result = $connection->delete_cart($cartID);

if($delete_cart_result){
    header("location:cart.php");
}

?>