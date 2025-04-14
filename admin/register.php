<?php
require_once "../db/config.php";


// Define variables and initialize with empty values
$first_name = $last_name= $email = $phone = $password = $confirm_password =  "";
$first_name_err = $last_name_err = $email_err = $phone_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign the form values to variables
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Check if email already exists
    $sql_check_email = "SELECT id FROM admin WHERE email = ?";
    if ($stmt_check = mysqli_prepare($connection, $sql_check_email)) {
        mysqli_stmt_bind_param($stmt_check, "s", $param_email);
        $param_email = $email;
        
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
        
        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            $email_err = "This email is already taken.";
        }
        
        mysqli_stmt_close($stmt_check);
    }

    // Validate password and confirm password match
    
    if ($password != $confirm_password) {
        $password_err = "Passwords do not match.";
        echo '<script>alert("Passwords do not match.")</script>';
    }
    


    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)) {
        $token = bin2hex(random_bytes(16)); // Generate a unique token

        // Prepare the SQL query
        $sql = "INSERT INTO admin (first_name,last_name ,email, phone, password) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $param_first_name,$param_last_name, $param_email, $param_phone, $param_password);
            
            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            

            // Debugging: Show the parameters before executing the query
            echo "first_name: $param_first_name<br>";
            echo "last_name: $param_last_name<br>";
            echo "Email: $param_email<br>";
            echo "Phone: $param_phone<br>";
            echo "Password: $param_password<br>";
            

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> Alert: Registration Successful </script>";
                header("location: login.php");
                    exit();

                           } else {
                echo "Error executing query: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing query: " . mysqli_error($connection);
        }
    }

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

    <title>Register</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />
    <style>
    /* Style the submit button with a specific background color etc */

    .login-box{
width: 300px;
position: relative;
/* top:0%; */
left: 50%;
transform: translate(-50%,2%);
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
    height:850px;
    width:550px;
    position: absolute;
    top:0.5px;
    left: 50%;
    transform: translate(-50%,5%);
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
    <h1 id="hl">Sign Up</h1>
        <div class="textbox <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Username</label> -->
                <input type="text" name="first_name" class="form-control" placeholder="Your First Name" value="<?php echo $first_name; ?>">
                <span class="help-block"><?php echo $first_name_err; ?></span>
            </div> 
            <br>  
            
        <div class="textbox <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Username</label> -->
                <input type="text" name="last_name" class="form-control" placeholder="Your Last Name" value="<?php echo $last_name; ?>">
                <span class="help-block"><?php echo $last_name_err; ?></span>
            </div> 
            <br>  
            
            <div class="textbox <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Username</label> -->
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <br>  

            <div class="textbox <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Username</label> -->
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $phone; ?>">
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div> 
            <br>  
            <div class="textbox <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Password</label> -->
                <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br>

            <div class="textbox <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Confirm it</label> -->
                <input type="password" name="confirm_password" class="form-control" placeholder="confirm password" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            
            <div >
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <p style="color: black;">Already have an account? <a href="login.php">Login here</a>.</p>
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