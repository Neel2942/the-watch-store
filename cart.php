<?php
session_start();
include("dbinit.php");
$connection = new DatabaseConnection();
$db = $connection->get_dbc();
if (isset($_SESSION['userid'])) {
    $get_cart_result = $connection->get_cart_by_user($_SESSION['userid']);
} else {
    $get_cart_result = $connection->get_cart();
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
        <form enctype="multipart/form-data" action="insertorderitem.php" method="POST">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product_remove">Delete</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Watch</th>
                                    <th class="product_price">Price</th>
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                while ($row = mysqli_fetch_array($get_cart_result, MYSQLI_ASSOC)) {
                                    $total = $total + ($row['price'] * $row['productQuantity']) ; ?>
                                    <input type="hidden" name="cartID[]" value="<?php echo $row['cartID']; ?>">
                                    <input type="hidden" name="watchID[]" value="<?php echo $row['watchID']; ?>">
                                    <input type="hidden" name="price[]" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" name="quantity[]" value="<?php echo $row['productQuantity']; ?>">
                                    <tr>
                                        <td class="product_remove"><a href="cartdelete.php?cartID=<?php echo $row['cartID'] ?>" class="btn btn-danger btn-sm">X</a></td>
                                        <?php
                                        $query = 'SELECT brand,imageURL FROM watches WHERE watchID = ?';

                                        $stmt = mysqli_prepare($db, $query);
                                        mysqli_stmt_bind_param(
                                            $stmt,
                                            'i',
                                            $row['watchID']
                                        );
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        while ($img = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        ?>
                                            <td class="product_thumb"><a><img src="<?php echo $img['imageURL'] ?> " class="img-thumbnail" style="width: 100px; height: 100px; border: none;" alt=""></a></td>
                                            <td class="product_name"><?php echo $img['brand'] ?></td>
                                        <?php } ?>
                                        <td class="product_price">$<?php echo $row['price'] ?></td>
                                        <td class="product_quantity"><?php echo $row['productQuantity'] ?></td>
                                        <td class="product_total">$<?php echo $row['price'] * $row['productQuantity'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="coupon_area">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code right">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">Cart Totals</h3>
                                </div>
                                <div class="card-body">
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Total : $<?php echo $total ?></p>
                                        </div>
                                        <div class="text-center mb-3 mt-3">
                                            <input type="submit" class="btn btn-warning" value="Checkout" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    <!-- Footer -->
    <?php include("footer.php") ?>
</body>

</html>