<?php
session_start(); 
include("dbinit.php");

$watchID = $_GET['watchID'];
$price = $_GET['price'];

$connection = new DatabaseConnection();

if(isset($_SESSION['userid'])){
    $insert_cart_result = $connection->insert_cart($watchID,$price,$_SESSION['userid']);
}else{
    $insert_cart_result = $connection->insert_cart($watchID,$price,0);
}

if($insert_cart_result){
    header("location:cart.php");
}
?>