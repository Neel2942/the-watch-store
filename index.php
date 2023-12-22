<?php
include_once("dbinit.php");
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
                <img src="images/pocket-watch-560937_1280.jpg" class="d-block  w-100" alt="sliderimg">
                <div class="carousel-caption d-flex align-items-center justify-content-center">
                    <div class="text-center text-white">
                        <h5 class="display-3">Introducting The Watch Store</h5>
                        <p class="mt-4">The Watch Store is your one-stop shop for high-quality timepieces.<br>
                            Explore our amazing assortment of watches, which includes traditional and innovative designs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="text-center mb-5">What We Offer</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card text-bg-dark">
                    <img src="images/wrist-watch-2159351_1280.jpg" class="card-img card-offer" alt="offer1">
                    <div class="card-img-overlay d-flex flex-column justify-content-center">
                        <h4 class="card-title text-center">SPECIAL DISCOUNT</h4>
                        <p class="card-text text-center mt-4">Save 20% on select premium timepieces. This is a limited-time promotion.
                            Explore our exclusive selection right away!</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-dark">
                    <img src="images/analog-watch-1869928_1280.jpg" class="card-img card-offer" alt="offer2">
                    <div class="card-img-overlay d-flex flex-column justify-content-center">
                        <h4 class="card-title text-center">SPECIAL OFFER</h4>
                        <p class="card-text text-center mt-4">Get one free when you buy one! Purchase any classic timepiece and receive
                            a free second one of your choosing.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 mt-5">
        <h2 class="text-center mb-5">Most Popular Brands</h2>
        <div class="card-group">
            <div class="card">
                <img src="images/wristwatch-407096_1280.jpg" class="card-img-top" alt="brand1">
                <div class="card-body">
                    <h5 class="card-title">Rolex</h5>
                    <p class="card-text">Explore our one-of-a-kind Rolex watch collection. Discover the perfect timepiece to complete your ensemble and your style.</p>
                    <div class="text-center">
                        <a href="brand.php" class="btn btn-warning px-5">See More</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="images/time-3091031_1280.jpg" class="card-img-top" alt="brand2">
                <div class="card-body">
                    <h5 class="card-title">Omega</h5>
                    <p class="card-text">Discover the elegance and accuracy of Omega timepieces. Explore our collection of traditional and contemporary designs.</p>
                    <div class="text-center">
                        <a href="brand.php" class="btn btn-warning px-5">See More</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="images/hands-1866619_1280.jpg" class="card-img-top" alt="brand3">
                <div class="card-body">
                    <h5 class="card-title">Seiko</h5>
                    <p class="card-text">Discover your ideal Seiko watch from our extensive assortment. Quality and elegance come together.</p>
                    <div class="text-center">
                        <a href="brand.php" class="btn btn-warning px-5">See More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/pocket-watch-2569573_1280.jpg" class="d-block w-100" alt="sliderimg">
                <div class="subscribe-caption d-flex align-items-center justify-content-center">
                    <div class="text-center text-white">
                        <h5 class="display-3">Subscribe for latest updates and new arrivals</h5>
                        <form class="mt-5">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control p-4" placeholder="Enter your email" aria-label="Recipient's email" aria-describedby="button-addon2">
                                <button class="btn btn-warning bg-subtle pr-5 pl-5 " type="button" id="button-addon2">SUBSCRIBE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 mt-5">
        <h2 class="text-center mb-5">Our classic Collection</h2>
        <div class="card-group">
            <div class="card text-bg-dark">
                <img src="images/clock-3179167_1280.jpg" class="card-img card-offer" alt="offer1">
                <div class="card-img-overlay d-flex flex-column justify-content-center">
                    <h4 class="card-title text-center">Omega Seamaster</h4>
                    <p class="card-text text-center mt-4">Timeless elegance and durability in a classic design that embodies refined
                        style and resilience.</p>
                </div>
            </div>
            <div class="card mr-4 ml-4 text-bg-dark">
                <img src="images/watch-4638673_1280.jpg" class="card-img card-offer" alt="offer1">
                <div class="card-img-overlay d-flex flex-column justify-content-center">
                    <h4 class="card-title text-center">Rolex Datejust</h4>
                    <p class="card-text text-center mt-4">The Datejust is the pinnacle of luxury horology, exuding ageless sophistication and unsurpassed
                        precision while embracing status and legacy.!</p>
                </div>
            </div>
            <div class="card text-bg-dark">
                <img src="images/time-2980690_1280.jpg" class="card-img card-offer" alt="offer1">
                <div class="card-img-overlay d-flex flex-column justify-content-center">
                    <h4 class="card-title text-center">Longines Conquest</h4>
                    <p class="card-text text-center mt-4">The Conquest effortlessly blends vintage attractiveness with modern functionality,
                        capturing the spirit of lasting charm and modern usefulness.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include("footer.php") ?>
</body>

</html>