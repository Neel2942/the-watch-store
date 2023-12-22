<?php
ob_start();
session_start();
include("dbinit.php");

$connection = new DatabaseConnection();
$db = $connection->get_dbc();
if (isset($_SESSION['userid'])) {
    $user_result = $connection->get_user_by_id($_SESSION['userid']);
    $watch_checkout_result = $connection->get_watch_for_checkout($_SESSION['userid']);
} else {
    header("location:login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Watch Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <?php include("navbar.php") ?>
    <!-- Main -->
    <div class="container">
        <h2 class="mb-5 text-center">Checkout Form</h2>
        <form class="row g-3" method="POST" action="insertorderproduct.php">
            <?php
            while ($row = mysqli_fetch_array($user_result, MYSQLI_ASSOC)) {
            ?>
                <div class="col-md-6 mb-3">
                    <label for="inputFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" value="<?php echo $row['firstname'] ?>" placeholder="Enter your first name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="inputLastName" name="inputLastName" value="<?php echo $row['lastname'] ?>" placeholder="Enter your last name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $row['email'] ?>" placeholder="Enter your email">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputPhone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="inputPhone" name="inputPhone" value="<?php echo $row['phone'] ?>" placeholder="Enter your phone number">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="<?php echo $row['address'] ?>" placeholder="Enter your Address">
                </div>
                <?php
                $query = 'SELECT provinceName FROM province WHERE provinceID = ?;';
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param(
                    $stmt,
                    'i',
                    $row['provinceID']
                );

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $province = mysqli_fetch_array($result, MYSQLI_ASSOC);
                ?>
                <div class="col-md-6">
                    <label for="inputProvince" class="form-label">Province</label>
                    <input type="text" class="form-control" id="inputProvince" name="inputProvince" value="<?php echo $province['provinceName'] ?>">
                </div>
                <?php
                $query = 'SELECT cityName FROM city WHERE cityID = ?;';
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param(
                    $stmt,
                    'i',
                    $row['cityID']
                );

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $city = mysqli_fetch_array($result, MYSQLI_ASSOC);
                ?>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity" value="<?php echo $city['cityName'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputPostalCode" class="form-label">PostalCode</label>
                    <input type="text" class="form-control" id="inputPostalCode" name="inputPostalCode" value="<?php echo $row['postalcode'] ?>">
                </div>


                <div class="col-12 mb-3 text-center mt-5">
                    <h3>Payment Details</h3>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputCardName" class="form-label">Name on Card</label>
                    <input type="text" class="form-control" id="inputCardName" name="inputCardName" placeholder="Enter name on card">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputCardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="inputCardNumber" name="inputCardNumber" placeholder="Enter card number">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputExpiration" class="form-label">Expiration Date</label>
                    <input type="text" class="form-control" id="inputExpiration" name="inputExpiration" placeholder="MM/YY">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputCVV" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="inputCVV" name="inputCVV" placeholder="Enter CVV">
                </div>


                <div class="col-12 text-center mb-3 mt-5">
                    <h3>Order Total Summary</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="product_name">Watch</th>
                                            <th class="product_price">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        while ($row = mysqli_fetch_array($watch_checkout_result, MYSQLI_ASSOC)) {
                                            $total=$total+($row['orderProductPrice']*$row['orderProductQuantity'] ); ?>
                                            <tr>
                                                <td><?php echo $row['brand'] ?> <strong> × <?php echo $row['orderProductQuantity'] ?></strong></td>
                                                <td><?php echo $row['price'] ?></td>
                                            <?php }
                                        $taxAmount = number_format(($total * 0.13), 2);
                                        $grandTotal = number_format($total + $taxAmount, 2);
                                            ?>
                                            </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="total" name="total" value="<?php echo $total ?>"/>
                                <input type="hidden" id="tax" name="tax" value="<?php echo $taxAmount ?>"/>
                                <input type="hidden" id="grandTotal" name="grandTotal" value="<?php echo $grandTotal ?>"/>
                                <p>Sub Total : $<?php echo $total ?></p>
                                <p>Tax : $<?php echo $taxAmount ?></p>
                                <p>Grand Total : $<?php echo $grandTotal ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 text-center mb-5 mt-3">
                <button type="submit" class="btn btn-warning">PLACE ORDER</button>
            </div>
        </form>
    </div>
    <!-- Footer -->
    <?php include("footer.php") ?>
</body>

</html>