<?php
ob_start();
include("dbinit.php");
$connection = new DatabaseConnection();
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
    <?php include("navbar.php"); ?>

    <div class="container mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Login</h2>
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email" value="<?php if (isset($_COOKIE['email'])) {
                                                                                                                            echo $_COOKIE['email'];
                                                                                                                        } ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                echo $_COOKIE['password'];
                                                                                                                            } ?>">
                        </div>
                        <label for="remember">
                            <input id="remember" name="remember" type="checkbox">
                            Remember me
                        </label>
                        <p class="text-center">Don't have an account, <a href="register.php">register here</a>.</p>
                        <div class="text-center mt-4">
                            <input type="submit" class="btn btn-warning btn-block" id="loginBtn" name="loginBtn" value="Login" />
                            <a href="logout.php" class="btn btn-warning btn-block">Logout</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
<?php
if (isset($_POST['loginBtn'])) {
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $login_result = $connection->login_user($email, $password);
    $count = mysqli_num_rows($login_result);
    if ($count > 0) {
        while ($row = mysqli_fetch_array($login_result, MYSQLI_ASSOC)) {
            session_start();
            if (!empty($_POST['remember'])) {
                setcookie('email', $email, time() + (365 * 24 * 60 * 60));
                setcookie('password', $password, time() + (365 * 24 * 60 * 60));
            } else {
                setcookie('email', '');
                setcookie('password', '');
            }
            $_SESSION['userid'] = $row['id'];
            header('location:index.php');
        }
    }
}

?>

</html>