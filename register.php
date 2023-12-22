<?php
ob_start();
include("dbinit.php");

$connection = new DatabaseConnection();
$state_result = $connection->get_all_province();
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
    <?php include("navbar.php") ?>

    <div class="container mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Registration</h2>
                    <hr>
                    <h3 class="text-center mb-4">Personal Information</h3>
                    <form method="POST" action="register.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="inputFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="Enter your first name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Enter your last name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputPhone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="Enter your phone number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Enter your Address">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputPostalCode" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" id="inputPostalCode" name="inputPostalCode" placeholder="Enter your PostalCode">
                            </div>
                            <div class="col-md-6">
                                <label for="inputProvince" class="form-label">Province</label>
                                <select class="form-control" id="inputProvince" name="inputProvince" onchange="provincedropdown(this.value);">
                                    <option>Select</option>
                                    <?php
                                    while ($row = mysqli_fetch_array($state_result, MYSQLI_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $row['provinceID'] ?>"><?php echo $row['provinceName'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div id="citydropdown">
                                    <label for="inputCity" class="form-label">City</label>
                                    <select class="form-control" id="inputCity" name="inputCity">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 mb-3 text-center mt-5">
                                <hr>
                                <h3>Credentials</h3>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="inputEmail">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                            </div>
                        </div>
                        <p class="text-center">Already have an account, <a href="login.php">Login</a>.</p>
                        <div class="col-12 text-center mt-4">
                            <input type="submit" class="btn btn-warning btn-block" id="registerBtn" name="registerBtn" value="Regsiter" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include("footer.php") ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        function provincedropdown(val) {
            $.ajax({
                type: "POST",
                url: "citydd.php",
                data: "provinceid=" + val,
                success: function(data) {
                    $('#citydropdown').html(data);
                }
            });
        }
    </script>
</body>
<?php
if (isset($_POST['registerBtn'])) {
    $firstName = $_POST['inputFirstName'];
    $lastName = $_POST['inputLastName'];
    $phone = $_POST['inputPhone'];
    $address = $_POST['inputAddress'];
    $postalCode = $_POST['inputPostalCode'];
    $provinceID = $_POST['inputProvince'];
    $cityID = $_POST['inputCity'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $email_check_result = $connection->check_email($email);
    if ($email_check_result) {
        echo "Email already exists";
    } else {
        $registration_result = $connection->register_user($firstName, $lastName, $phone, $address, $postalCode, $provinceID, $cityID, $email, $password);
        if ($registration_result) {
            header("location:login.php");
        } else {
            echo "some error in inserting";
        }
    }
}

?>

</html>