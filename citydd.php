<?php
include('dbinit.php');
$connection = new DatabaseConnection();
$provinceID = $_REQUEST['provinceid'];
$city_result = $connection->get_city($provinceID);
?>

<label for="inputCity" class="form-label">City</label>
<select class="form-control" id="inputCity" name="inputCity">
    <option>Select</option>
    <?php
    while($row = mysqli_fetch_array($city_result,MYSQLI_ASSOC)){
    ?>
    <option value="<?php echo $row['cityID'] ?>"><?php echo $row['cityName'] ?></option>
    <?php } ?>
</select>
