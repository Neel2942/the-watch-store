<?php 
include("dbinit.php");

$connection = new DatabaseConnection();
$categoryID = $_REQUEST['categoryID'];

$filter_product_result = $connection->sort_watches_by_categories($categoryID);

while ($row = mysqli_fetch_array($filter_product_result, MYSQLI_ASSOC)) { ?>
    <div class="col mb-5">
        <div class="card">
            <img src="<?php echo $row['imageURL'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['brand'] ?></h5>
                <p class="card-text"><?php echo $row['description'] ?></p>
                <p class="card-text">Price: $<?php echo $row['price'] ?></p>
                <div class="text-center">
                    <a href="cartinsert.php?watchID=<?php echo $row['watchID'] ?>" class="btn btn-warning">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>