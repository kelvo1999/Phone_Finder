<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect them to dashboard
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: dashboard.php");
  exit;
}
 
// Include config file
require_once "db/config.php";
 
// Define variables and initialize with empty values
$input = $password = "";
$input_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if input is empty
    if(empty(trim($_POST["input"]))){
        $input_err = "Please enter your email.";
    } else {
        $input = trim($_POST["input"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($input_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_input);
            
            // Set parameters
            $param_input = $input;
             
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username or email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            // $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            
                            // Redirect user to report page
                            header("location: dashboard.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username or email doesn't exist
                    $input_err = "No account found with that username or email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($connection);
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

    <title>Login</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <style>
    /* Style the submit button with a specific background color etc */

    .login-box{
width: 300px;
position: absolute;
top:0%;
left: 50%;
transform: translate(-50%,20%);
color: black;
/* display: ; */

}
.textbox{
	width: 100%;
	overflow: hidden;
	font-size: 20px;
	padding:8px 0;
	margin: 8px 0;
	border-bottom:1px solid; 
}

.textbox i{
	width: 26px;
	float: left;text-align: center;
}

.textbox input{
	border: none;
	outline: none;
	background: none;
}
.btn{
	width: 100%;
	background: none;
	border: 2px solid black;
	color: red;  
	padding: 5px;
	font-size: 18px;
	cursor: pointer;
	margin: 12px;
}
.login-box #hl{

	float: left;
	font-size: 40px;
	border-bottom: 6px solid #4caf50;
	margin-bottom: 1px;
	padding: 13px 0;

}
input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    /* When moving the mouse over the submit button, add a darker green color */
    input[type=submit]:hover {
    background-color: #45a049;
    }
    /* Style the submit button with a specific background color etc */
    input[type=reset] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    /* When moving the mouse over the submit button, add a darker green color */
    input[type=reset]:hover {
    background-color: #45a049;
    }
    /* Add a background color and some padding around the form */
    .contaner {
    border-radius: 5px;
    background-color: #f2f2f2;
    /* padding: 20px; */
    height:500px;
    width:550px;
    position: absolute;
    top:0.5px;
    left: 50%;
    transform: translate(-50%,20%);
    color: white;
    
    }/* CSS Document */
    
    </style>
</head>
<body>
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
    <div class="contaner">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="login-box">
        <h1 id="hl">Sign In</h1>
        
        <div class="textbox <?php echo (!empty($input_err)) ? 'has-error' : ''; ?>">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="email" name="input" placeholder="Email" value="<?php echo $input; ?>">
            <span class="help-block"><?php echo $input_err; ?></span>
        </div>
        
        <div class="textbox <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="password" placeholder="Password">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        
        <input type="submit" class="btn btn-primary" value="Login">
        <p>Don't have an account? <a href="register.php">Register</a></p>
        <p>Forgot password? <a href="mailto:example@example.com?subject=Password Reset">Reset</a></p>
    </div>
</form>
    </div>
   

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
</html>