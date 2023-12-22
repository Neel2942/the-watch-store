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
                <img src="images/pexels-vojta-kovarik-3243090.jpg" class="d-block  w-100" alt="sliderimg">
                <div class="carousel-caption d-flex align-items-center justify-content-center">
                    <div class="text-center text-white">
                        <h5 class="display-3">Contact The Watch Store</h5>
                        <p class="mt-4">If you have any questions or would want to contact us, please do so via our website.
                            You may also use the Google Map given below to find our locations.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 mt-5">
        <h2 class="mb-5 text-center">Find Our Locations</h2>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control mb-3" placeholder="Enter postal location or find dealer">
                <div class="scrollable-locations" style="max-height: 250px; overflow-y: auto;">
                    <div class="location">
                        <h3>Conestoga College Kitchener - Doon Campus</h3>
                        <p>299 Doon Valley Dr, Kitchener, ON N2G 4M4</p>
                    </div>
                    <div class="location">
                        <h3>Conestoga College Waterloo Campus</h3>
                        <p>108 University Ave, Waterloo, ON N2J 2W2</p>
                    </div>
                    <div class="location">
                        <h3>Conestoga College - Kitchener Downtown</h3>
                        <p>49 Frederick St, Kitchener, ON N2H 6M7</p>
                    </div>
                    <div class="location">
                        <h3>IELTS Milton Conestoga College, IELTS Canada</h3>
                        <p>775 Main St E, Milton, ON L9T 3Z3</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2899.385609069657!2d-80.40735372413475!3d43.389869069422964!2
                    m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b9018e9e89adf%3A0x2043c24369ede07e!2sConestoga%20College%20Kitchener%20-%20Do
                    on%20Campus!5e0!3m2!1sen!2sca!4v1691255551433!5m2!1sen!2sca" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="mb-5 text-center">Contact Form</h2>
        <form class="row g-3">
            <div class="col-md-6 mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email">
            </div>
            <div class="col-md-6 mb-3">
                <label for="inputPhone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="inputPhone" placeholder="Enter your phone number">
            </div>
            <div class="col-12 mb-3">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Enter your Address">
            </div>
            <div class="col-12 mb-3">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Enter your Address 2">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">state</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="col-12 text-center mb-5 mt-5">
                <button type="submit" class="btn btn-warning">SUBMIT</button>
            </div>
        </form>
    </div>
    <!-- Footer -->
    <?php include("footer.php") ?>
</body>

</html>