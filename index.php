<?php
  require_once './assets/crud/connection.php';
          
  session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E3lnly</title>
    <script src="https://kit.fontawesome.com/7d670817b2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style/style.css">
    <!-- <link rel="icon" type="image/png" sizes="200x200" href="imgs/logo3.png"> -->
</head>
<body>

  <!-- calling navbar -->
  <?php 
      include "./assets/components/navbar.php";
    ?>
    <!-- start header -->
      <header>
        <div class="overlay"></div>
        <div class="container">
            <div class="searchbar">
                <h1 class="text-uppercase font-weight-bold text-center text-white mb-4">Move your advertisment to<br>the next level</h1>
                <div class="search-oo d-flex">
                    <select name="select" id="select1" class="px-3">
                        <option value="tv">Television</option>
                        <option value="Billboards">Billboards</option>
                        <option value="web">Web</option>
                    </select>
                    <input class="px-3" type="text" name="Search" placeholder="Search products" />
                    <a id="form-btn" href="./search.php" style="width:110px;" class="ml-3 btn btn-primary form-btn">Search</a>
                </div>
            </div>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active" data-interval="5000">
                <img src="./assets/imgs/header-billboard.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="./assets/imgs/header-tv-ads.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="./assets/imgs/header-webmarketing.jpg" class="d-block w-100" alt="...">
            </div>
            </div>
<!-- https://image.freepik.com/free-psd/billboard-mockup_37789-95.jpg
     https://storage.googleapis.com/twg-content/images/are-people-watching-my-tv-ads-australian-adve.width-1200.jpg
     https://icebergplus.net/wp-content/uploads/2019/04/webmarketing.jpg -->
        </div>

    </header>
    <section class="my-5">
    <div class="container">
        <div class="text-center">
            <h2 class="h1 font-weight-bold">Advertise</h2>
            <p class="h5 text-capitalize">with your best way anywhere anytime</p>
        </div>

        <div class="">
        <div class="row car-container w-100 d-flex justify-content-between my-5">
            <div class="col-12 col-lg-4">
                <div class="card border-0 mx-auto" style="width: 18rem;">
                    <img src="https://image.flaticon.com/icons/png/512/1101/1101202.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">TV Ads</h5>
                    <p class="card-text">Explore TV Ads commersials to show your ad content and with the highest trusted tv channals.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border-0 mx-auto" style="width: 18rem;">
                    <img src="https://i7.uihere.com/icons/874/1005/107/billboard-a2c03a1f93da1e5a8814ff11890017e7.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Billboards</h5>
                    <p class="card-text">Explore Billboards across the country with highly reach locations to promote within.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border-0 mx-auto" style="width: 18rem;">
                    <img src="https://cdn4.iconfinder.com/data/icons/media-and-advertising/49/45-512.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Web Ads</h5>
                    <p class="card-text">Explore web ad bannars to show your ad high reach websites to promote in.</p>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
    </section>
<hr>

<!-- Television advertisment details-->
<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card mt-3 border-0" style="width: 100%;">
                    <img src="./assets/imgs/download.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">TV Ads</h5>
                    <p class="card-text text-capitalize">put your ads in the most trusted channals.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <h3>Explore TV Ads commersials to show your ad</h3>
                <p>with collection of high trusted tv channals.</p>
                <div class="row">
                    <div class="col-3">
                        <div class="card" style="width: 100%;">
                            <img src="https://thumbs.dreamstime.com/b/black-mix-icon-television-ads-technology-marketing-advertising-advertisement-broadcast-157707658.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">BBC NEWS</h5>
                              <p class="card-text">BBC</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 100%;">
                            <img src="https://thumbs.dreamstime.com/b/black-mix-icon-television-ads-technology-marketing-advertising-advertisement-broadcast-157707658.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">MBC MASR</h5>
                              <p class="card-text">MBC</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 100%;">
                            <img src="https://thumbs.dreamstime.com/b/black-mix-icon-television-ads-technology-marketing-advertising-advertisement-broadcast-157707658.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">FOX NEWS</h5>
                              <p class="card-text">FOX GROUP</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3">
                        <div class="card border-0" style="width: 100%;top: calc(50% - 39px);">
                            <div class="card-body text-center">
                              <a href="search.php" class="btn btn-primary stretched-link">More</a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-5">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-12 col-lg-3">
                <div class="card mt-3 border-0" style="width: 100%;">
                    <img src="https://cdn3.iconfinder.com/data/icons/digital-marketing-2/200/vector_395_18-512.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Billboards</h5>
                    <p class="card-text text-capitalize">chose the best location and time</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <h3>Explore Billboards across the country</h3>
                <p>with collection of high reach locations to promote within</p>
                <div class="row flex-row-reverse">
                    <div class="col-3 pr-0">
                        <div class="card" style="width: 100%;">
                            <img src="https://cdn2.iconfinder.com/data/icons/digital-and-internet-marketing-1-1/50/2-512.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">42 Gleem</h5>
                              <p class="card-text">Alexandria</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3 pr-0">
                        <div class="card" style="width: 100%;">
                            <img src="https://cdn2.iconfinder.com/data/icons/digital-and-internet-marketing-1-1/50/2-512.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">13 Mohram-bek</h5>
                              <p class="card-text">Alexandria</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3 pr-0">
                        <div class="card" style="width: 100%;">
                            <img src="https://cdn2.iconfinder.com/data/icons/digital-and-internet-marketing-1-1/50/2-512.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">40 Maadi</h5>
                              <p class="card-text">Cairo</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3 pr-0">
                        <div class="card border-0" style="width: 100%;top: calc(50% - 39px);">
                            <div class="card-body text-center">
                              <a href="search.php" class="btn btn-primary stretched-link">More</a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card mt-3 border-0" style="width: 100%;">
                    <img src="https://cdn1.iconfinder.com/data/icons/seo-search-engine-optimize-1/512/Advertising-ads-online-web-website-banner-512.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Web Ads</h5>
                    <p class="card-text text-capitalize">put your ads in Where it deserve.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <h3>Explore web ad bannars to show your ad</h3>
                <p>with collection of high reach websites to promote in</p>
                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="card" style="width: 100%;">
                            <img src="https://image.freepik.com/free-vector/www-icon_23-2147934922.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Website 30*40</h5>
                              <p class="card-text">wwww.google.com</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3 pr-0">
                        <div class="card" style="width: 100%;">
                            <img src="https://image.freepik.com/free-vector/www-icon_23-2147934922.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Website 30*40</h5>
                              <p class="card-text">wwww.google.com</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3 pr-0">
                        <div class="card" style="width: 100%;">
                            <img src="https://image.freepik.com/free-vector/www-icon_23-2147934922.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Website 30*40</h5>
                              <p class="card-text">wwww.google.com</p>
                              <a href="search.php" class="btn btn-primary stretched-link float-right">View</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-3 pr-0">
                        <div class="card border-0" style="width: 100%;top: calc(50% - 39px);">
                            <div class="card-body text-center">
                              <a href="#" class="btn btn-primary stretched-link">More</a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>

<section class="promotion mt-5">
    <div class="container text-center">
        <div class="text-center mb-5">
            <h2 class="h1 font-weight-bold">Promote Now</h2>
            <p class="h5 text-capitalize">advertising its easier than ever</p>
        </div>

            <div class="row justify-content-between">
                <div class="col-12 col-lg-4 mx-auto">
                    <div class="card bg-light" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Bronze</h5>
                          <h5 class="card-title2">50EGP</h5>
                          <p class="text-muted">per month</p>
                          <p class="card-text">Ad channal will normally
                            reach<br> use client but
                            with<br> less priority.</p>
                          <a href="#" class="btn btn-primary">Join</a>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card bg-light" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Premium</h5>
                          <h5 class="card-title2">1000EGP</h5>
                          <p class="text-muted">per month</p>
                          <p class="card-text">Ad channal will be
                            seen first by client and
                            will be given
                            <br>highest priority.</p>
                          <a href="#" class="btn  btn-primary">Join</a>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card bg-light" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Silver</h5>
                          <h5 class="card-title2">250EGP</h5>
                          <p class="text-muted">per month</p>
                          <p class="card-text">Ad channal will normally reach<br> use client but with<br> higher priorit.</p>
                          <a href="#" class="btn btn-primary">Join</a>
                        </div>
                      </div>
                </div>
            </div>
    </div>
</section>


<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding bg-light pt-5">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                   <div class="single-footer-caption mb-50">
                     <div class="single-footer-caption mb-30">
                          <!-- logo -->
                         <div class="footer-logo">
<a href="index.php"><img src="./assets/imgs/logo.png" alt=""></a>                         </div>
                         <div class="footer-tittle">
                             <div class="footer-pera">
                                 <p>Always in your help to Move your advertisment to the next level</p>
                            </div>
                         </div>
                     </div>
                   </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Quick Links</h4>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#"> Offers & Discounts</a></li>
                                <li><a href="#"> Special Order</a></li>
                                <li><a href="#">  Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Agency</h4>
                            <ul>
                                <li><a href="#">Social media</a></li>
                                <li><a href="#">Plans</a></li>
                                <li><a href="#"> Promotions</a></li>
                                <li><a href="#"> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Support</h4>
                            <ul>
                             <li><a href="#">Frequently Asked Questions</a></li>
                             <li><a href="#">Terms & Conditions</a></li>
                             <li><a href="#">Privacy Policy</a></li>
                             <li><a href="#">Report a Payment Issue</a></li>
                         </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer bottom -->
            </div>
        </div>

        <div class="footer-copy-right bg-dark text-white text-right py-2">
            <div class="container">
                <p class="my-auto">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved<i class="ti-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Bug Squashers</a>
            </div>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./script/custom.js"></script>

</body>
</html>