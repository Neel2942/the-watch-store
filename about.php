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
                <img src="images/pexels-jonathan-petersson-404181.jpg" class="d-block  w-100" alt="sliderimg">
                <div class="carousel-caption d-flex align-items-center justify-content-center">
                    <div class="text-center text-white">
                        <h5 class="display-3">About The Watch Store</h5>
                        <p class="mt-4">This unique and customer-focused Watch Store was started by <br>four Conestoga College students.
                            Their enthusiasm for horology drives the store's success, as they <br>are committed to providing great watches
                            and exceptional customer service.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center mb-5">About Our Company</h2>
                <p>Welcome to The Watch Store, your one-stop shop for magnificent watches and fine craftsmanship. We take pleasure
                    in crafting an exclusive assortment of timepieces that exemplify elegance, precision, and flair.</p>
                <p>We provide a varied choice of famous brands and vintage classics to fit every lifestyle, with a passion for
                    horology and an eye for refinement. </p>
                <p>Explore our extensive collection, become immersed in the expertise of great watchmaking, and boost your style with
                    a timepiece that conveys your story.</p>
            </div>
            <div class="col-md-6">
                <img src="images/pexels-joey-nguyen-2113994.jpg" alt="Company Image" class="img-fluid">
            </div>
        </div>

        <div class="card mt-5 mb-5">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="images/pocket-watch-2036304_1280.jpg" class="img-fluid rounded-start" alt="ourmission">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">Our Mission</h4>
                        <p class="card-text">Our objective is to reimagine timekeeping by providing a carefully picked assortment
                            of watches that go beyond conventional utility. We are committed to supplying our consumers with
                            timepieces that represent workmanship, precision, and elegance.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">Our Vision</h4>
                        <p class="card-text">The Watch Store's mission is to be the pinnacle of quality in the world of horology.
                            We imagine a world where discerning individuals can find more than simply watches, but also
                            a representation of their personalities.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/watch-4638673_1280.jpg" class="img-fluid rounded-start" alt="ourvision">
                </div>
            </div>
        </div>

        <h2 class="text-center mb-5">Our Team</h2>
        <div class="text-center row mb-5 mt-5">
            <div class="card-group ml-5">
                <div class="card">
                    <img src="images/people.png" class="card-img-top" alt="ourteam">
                    <div class="card-body">
                        <h5 class="card-title">Neel Rajivkumar Patel</h5>
                        <p class="card-text">8877511</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/people.png" class="card-img-top" alt="ourteam">
                    <div class="card-body">
                        <h5 class="card-title">Lakshit Dineshbhai Gajera</h5>
                        <p class="card-text">8841808</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/people.png" class="card-img-top" alt="ourteam">
                    <div class="card-body">
                        <h5 class="card-title">Kushal Dharmesh Choksi</h5>
                        <p class="card-text">8867448</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/people.png" class="card-img-top" alt="ourteam">
                    <div class="card-body">
                        <h5 class="card-title">Gurjeet Singh</h5>
                        <p class="card-text">8857971</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Footer -->
    <?php include("footer.php") ?>
</body>

</html>