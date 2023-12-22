<?php
session_start();
include("dbinit.php");
$connection = new DatabaseConnection();
if ($_POST['cartID']) {
    if (isset($_SESSION['userid'])) {
        for ($i = 0; $i < count($_POST['cartID']); $i++) {
            $cartid = $_POST['cartID'][$i];
            $watchid = $_POST['watchID'][$i];
            $price = $_POST['price'][$i];
            $quantity = $_POST['quantity'][$i];

            $orderItemID[] = $connection->insert_orderitem($price, $quantity, $watchid, $cartid, $_SESSION['userid']);
        }
        $count  = count($orderItemID);
        header("location:checkout.php");
    }else{
        header("location:login.php");
    }
} else {
    header("location:product.php");
}
