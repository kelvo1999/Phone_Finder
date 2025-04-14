<?php
// Initialize the session
session_start();
require_once "../db/config.php";

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Fetch user name using the email from session
$email = $_SESSION["email"];
$name = "";

$sql = "SELECT first_name FROM users WHERE email = ?";
if ($stmt = mysqli_prepare($connection, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Mbau Finders</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="index.html">
                        <img src="images/logo.png" alt="" />
                        <span>
              Mbau Finders
            </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="about.html"> About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="work.html">Work </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="category.html"> Category </a>
                            </li>
                        </ul>
                        <div class="user_option">
                            <a href="login.php">
                                <span>
                  Login
                </span>
                            </a>
                            <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <div class="custom_menu-btn ">
                            <button>
                <span class=" s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
                        </div>
                    </div>

                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>


    <!-- experience section -->

    <section class="experience_section layout_padding-top layout_padding2-bottom">
        <div class="container">
        <h3 style="color: black; text-align: center;">
        Welcome, <?php echo htmlspecialchars($name); ?>!

    </h3>
            <div class="row">
                <div class="col-md-5">
                    <div class="img-box">
                        <img src="images/experience-img.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Best Experinced Phone Trackers in Nairobi and beyond
                            </h2>
                        </div>
                        <p>
                            We know it is painfull and stressfull to loose your phone and have nowhere to get help from, that is where we come in and help you with the hassle and tassle of finding it.
                        </p>
                        <p>Enter your phone IMEI code below</p>
                        <div class="btn-box">
                            <a href="imei.php" class="btn-1">
                IMEI Code
              </a>
                            <a href="history.php" class="btn-2">   
                HIstory
              </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- end experience section -->


    <!-- about section -->

    <!-- <section class="about_section layout_padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-9 mx-auto">
                    <div class="img-box">
                        <img src="images/about-img.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="detail-box">
                <h2>
                    About Mbau Finders
                </h2>
                <p>
                    In this centuary a computer or a phone is a powerul tool that one does posses and loosing it might be really stressing. The process of recovering the phone via the security agencies might also be stressfull them being not open to charging the people that
                    have incurred losses. At Mbau we help you with all these as we have trained professionals who track the device and with the help of the police recover it and bring joy to you once more.</p>
                <p>All this is done at an affordable price and even help you press charges incase you want to be refunded for any damages caused.</p>
                <a href="">
      Read More
    </a>
            </div>
        </div>
    </section> -->

    <!-- end about section -->

    <!-- info section -->

    <section class="info_section ">
        <div class="info_container layout_padding-top">
            <div class="container">
                <div class="info_top">
                    <div class="info_logo">
                        <img src="images/logo.png" alt="" />
                        <span>
              Mbau Finders
            </span>
                    </div>
                    <div class="social_box">
                        <a href="#">
                            <img src="images/fb.png" alt="">
                        </a>
                        <a href="#">
                            <img src="images/twitter.png" alt="">
                        </a>
                        <a href="#">
                            <img src="images/linkedin.png" alt="">
                        </a>
                        <a href="#">
                            <img src="images/instagram.png" alt="">
                        </a>
                        <a href="#">
                            <img src="images/youtube.png" alt="">
                        </a>
                    </div>
                </div>

                <div class="info_main">
                    <div class="row">
                        <div class="col-md-3 col-lg-2">
                            <div class="info_link-box">
                                <h5>
                                    Useful Link
                                </h5>
                                <ul>
                                    <li class=" active">
                                        <a class="" href="index.html">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="">
                                        <a class="" href="about.html">About </a>
                                    </li>
                                    <li class="">
                                        <a class="" href="work.html">Work </a>
                                    </li>
                                    <li class="">
                                        <a class="" href="category.html">Category </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <h5>
                                Offices
                            </h5>
                            <p>
                                Readable content of a page when looking at its layoutreadable content of a page when looking at its layout
                            </p>
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-1">
                            <h5>
                                Information
                            </h5>
                            <p>
                                Readable content of a page when looking at its layoutreadable content of a page when looking at its layout
                            </p>
                        </div>

                        <div class="col-md-3  offset-lg-1">
                            <div class="info_form ">
                                <h5>
                                    Newsletter
                                </h5>
                                <form action="">
                                    <input type="email" placeholder="Email">
                                    <button>
                    Subscribe
                  </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-10 mx-auto">
                        <div class="info_contact layout_padding2">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="#" class="link-box">
                                        <div class="img-box">
                                            <img src="images/location.png" alt="">
                                        </div>
                                        <div class="detail-box">
                                            <h6>
                                                Location
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" class="link-box">
                                        <div class="img-box">
                                            <img src="images/mail.png" alt="">
                                        </div>
                                        <div class="detail-box">
                                            <h6>
                                                demo@gmail.com
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-5">
                                    <a href="#" class="link-box">
                                        <div class="img-box">
                                            <img src="images/call.png" alt="">
                                        </div>
                                        <div class="detail-box">
                                            <h6>
                                                Call +01 1234567890
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- end info section -->

    <!-- footer section -->
    <footer class="container-fluid footer_section ">
        <div class="container">
            <p>
                &copy; <span id="displayDate"></span> All Rights Reserved By
                <a href="#">Mbau Finders</a>
            </p>
        </div>
    </footer>
    <!-- end  footer section -->


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>


</body>
</body>

</html>