<?php
include("dbinit.php");

$connection = new DatabaseConnection();
$watch_result = $connection->get_watches();
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
                <img src="images/pexels-matej-1034426.jpg" class="d-block  w-100" alt="sliderimg">
                <div class="carousel-caption d-flex align-items-center justify-content-center">
                    <div class="text-center text-white">
                        <h5 class="display-3">Explore the most exciting watches</h5>
                        <p class="mt-4">The Watch Store is your one-stop shop for high-quality timepieces.<br>
                            Explore our amazing assortment of watches, which includes traditional and innovative designs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center mt-5 mb-5">Explore out watches</h2>
        <div class="mb-5">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="brandFilter" class="form-label">Filter by Categorie:</label>
                        <select class="form-select" id="brandFilter" name="brandFilter" onchange="categoryfilterdropdown(this.value);">
                            <option value="allwatch">All Categories</option>
                            <?php while ($row = mysqli_fetch_array($watch_category_result, MYSQLI_ASSOC)) { ?>
                                <option value=<?php echo $row['categoryID'] ?>><?php echo $row['categoryName'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 mt-5 mb-5 row-cols-md-3 g-4" id="watchdiv">
            <?php while ($row = mysqli_fetch_array($watch_result, MYSQLI_ASSOC)) { ?>
                <div class="col mb-5">
                    <div class="card">
                        <img src="<?php echo $row['imageURL'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['brand'] ?></h5>
                            <p class="card-text"><?php echo $row['description'] ?></p>
                            <p class="card-text">Price: $<?php echo $row['price'] ?></p>
                            <div class="text-center">
                                <a href="cartinsert.php?watchID=<?php echo $row['watchID'] ?>&price=<?php echo $row['price'] ?>" class="btn btn-warning">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include("footer.php") ?>
    <!--jquery min js-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- AJAX to filter watch by category -->
    <script>
    function categoryfilterdropdown(val){
        $.ajax({
            type: "POST",
            url: "productfilter.php",
            data: "categoryID=" + val,
            success: function(data){
                $('#watchdiv').html(data);
            }
        });
    }
    </script>
</body>

</html>