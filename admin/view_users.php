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

// Fetch all users
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($connection, $sql_users);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mbau Finders | User Management</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet" />
</head>

<body class="sub_page">
    <div class="hero_area">
        <header class="header_section">
            <!-- Include header as in your theme -->
        </header>
    </div>

    <section class="container">
        <h3>Welcome, <?php echo htmlspecialchars($name); ?>!</h3>
        <h4>Users Management</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_users)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <footer>
        <!-- Footer content as in your theme -->
    </footer>
</body>

</html>
