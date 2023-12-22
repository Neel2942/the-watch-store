<?php
include_once("dbinit.php");

$connection = new DatabaseConnection();
$db = $connection->get_dbc();
$watch_category_result = $connection->get_watch_categories();
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
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/pexels-castorly-stock-3829448.jpg" class="d-block  w-100" alt="sliderimg">
                <div class="carousel-caption d-flex align-items-center justify-content-center">
                    <div class="text-center text-white">
                        <h5 class="display-3">Discover the luxurious Brands</h5>
                        <p class="mt-4">Enjoy the classic elegance of our finest timepieces. Discover superb workmanship and <br>
                            elegance in each timepiece.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php while ($row = mysqli_fetch_array($watch_category_result, MYSQLI_ASSOC)) { ?>
            <h2 class="text-center mt-5 mb-5"><?php echo $row['categoryName'] ?></h2>
            <?php
            $query = 'SELECT brand, description, c.categoryName, imageURL FROM watches w, categories c WHERE w.categoryID = c.categoryID AND c.categoryName = ?';

            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param(
                $stmt,
                's',
                $row['categoryName']
            );
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            ?>
            <div class=row>
                <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {  ?>
                    <div class="col-md-4 g-4">
                        <div class="col">
                            <div class="card">
                                <img src="<?php echo $row['imageURL'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['brand'] ?></h5>
                                    <p class="card-text"><?php echo $row['description'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="mb-5"></div>
        <?php
        } ?>
    </div>
    </div>
    <!-- Footer -->
    <?php include("footer.php") ?>
</body>

</html>