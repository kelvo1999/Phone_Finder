<?php
session_start();
require_once "db/config.php";

// Check login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$email = $_SESSION["email"];
$name = "";

// Fetch user name
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
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Mbau Finders</title>

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- Header -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="index.html">
                        <img src="images/logo.png" alt="" />
                        <span>Mbau Finders</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item active"><a class="nav-link" href="about.html">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="work.html">Work</a></li>
                            <li class="nav-item"><a class="nav-link" href="category.html">Category</a></li>
                        </ul>

                        <div class="user_option ml-auto d-flex align-items-center">
                            <span class="mr-3">Hi, <?php echo htmlspecialchars($name); ?> 👋</span>
                            <a href="db/logout.php" class="btn btn-danger btn-sm">Logout</a>
                        </div>
                    </div>

                    <div class="custom_menu-btn">
                        <button>
                            <span class="s-1"></span>
                            <span class="s-2"></span>
                            <span class="s-3"></span>
                        </button>
                    </div>
                </nav>
            </div>
        </header>
    </div>

    <!-- Experience Section -->
    <section class="experience_section layout_padding-top layout_padding2-bottom">
        <div class="container">
            <h3 class="text-center" style="color: black;">Welcome, <?php echo htmlspecialchars($name); ?>!</h3>
            <div class="row">
                <div class="col-md-5">
                    <div class="img-box">
                        <img src="images/experience-img.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>Top Phone Trackers in Nairobi and Beyond</h2>
                        </div>
                        <p>We know how painful and stressful it is to lose your phone with no one to help. That’s where we come in — we’ll help you find it hassle-free.</p>
                        <p>Here is your history:</p>
                        <?php
// Fetch user's IMEI records
$query = "SELECT imei, phone_type FROM imei WHERE email = ?";
if ($stmt = mysqli_prepare($connection, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    mysqli_stmt_bind_result($stmt, $imei, $phone_type);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead><tr><th>IMEI Code</th><th>Phone Type</th><th>Status</th></tr></thead><tbody>";

        while (mysqli_stmt_fetch($stmt)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($imei) . "</td>";
            echo "<td>" . htmlspecialchars($phone_type) . "</td>";
            echo "<td>Pending</td>";
            echo "</tr>";
        }

        echo "</tbody></table></div>";
    } else {
        echo "<p>No IMEI records found.</p>";
    }

    mysqli_stmt_close($stmt);
}
?>
                        <div class="btn-box">
                            <a href="imei.php" class="btn-1">Report another</a>
                            <!-- <a href="history.php" class="btn-2">View History</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info_section">
        <div class="info_container layout_padding-top">
            <div class="container">
                <div class="info_top">
                    <div class="info_logo">
                        <img src="images/logo.png" alt="" />
                        <span>Mbau Finders</span>
                    </div>
                    <div class="social_box">
                        <a href="#"><img src="images/fb.png" alt=""></a>
                        <a href="#"><img src="images/twitter.png" alt=""></a>
                        <a href="#"><img src="images/linkedin.png" alt=""></a>
                        <a href="#"><img src="images/instagram.png" alt=""></a>
                        <a href="#"><img src="images/youtube.png" alt=""></a>
                    </div>
                </div>

                <div class="info_main">
                    <div class="row">
                        <div class="col-md-3 col-lg-2">
                            <div class="info_link-box">
                                <h5>Useful Links</h5>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="work.html">Work</a></li>
                                    <li><a href="category.html">Category</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Offices</h5>
                            <p>We're available in Nairobi, and our services extend nationwide.</p>
                        </div>
                        <div class="col-md-3 col-lg-2 offset-lg-1">
                            <h5>Information</h5>
                            <p>We recover lost phones and help you press charges if needed.</p>
                        </div>
                        <div class="col-md-3 offset-lg-1">
                            <div class="info_form">
                                <h5>Newsletter</h5>
                                <form>
                                    <input type="email" placeholder="Email">
                                    <button>Subscribe</button>
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
                                        <div class="img-box"><img src="images/location.png" alt=""></div>
                                        <div class="detail-box"><h6>Location</h6></div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" class="link-box">
                                        <div class="img-box"><img src="images/mail.png" alt=""></div>
                                        <div class="detail-box"><h6>demo@gmail.com</h6></div>
                                    </a>
                                </div>
                                <div class="col-md-5">
                                    <a href="#" class="link-box">
                                        <div class="img-box"><img src="images/call.png" alt=""></div>
                                        <div class="detail-box"><h6>Call +01 1234567890</h6></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="container-fluid footer_section">
        <div class="container">
            <p>&copy; <span id="displayDate"></span> All Rights Reserved By <a href="#">Mbau Finders</a></p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
