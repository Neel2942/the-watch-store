<?php
session_start();
include("dbinit.php");

$connection = new DatabaseConnection();

$firstName = $_POST['inputFirstName'];
$lastName = $_POST['inputLastName'];
$phone = $_POST['inputPhone'];
$address = $_POST['inputAddress'];
$postalCode = $_POST['inputPostalCode'];
$province = $_POST['inputProvince'];
$city = $_POST['inputCity'];
$email = $_POST['inputEmail'];
$total = $_POST['total'];
$grandTotal = $_POST['grandTotal'];

$order_product_result = $connection->insert_orderproduct($_SESSION['userid'],$firstName,$lastName,$email,$phone,$address,$province,$city,$postalCode,$total,$grandTotal);

if($order_product_result){
    header("location:userinvoice.php?orderProductID=$order_product_result");
}

