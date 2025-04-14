<?php
session_start();
require_once "../db/config.php";

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $imei_id = $_GET['id'];

    // Get current status
    $sql = "SELECT status FROM imei WHERE id = ?";
    if ($stmt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $imei_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $current_status);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Toggle status
    $new_status = ($current_status == 'pending') ? 'resolved' : 'pending';

    // Update the status
    $sql_update = "UPDATE imei SET status = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($connection, $sql_update)) {
        mysqli_stmt_bind_param($stmt, "si", $new_status, $imei_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("location: imei_report.php"); // Redirect back to the IMEI report page
}
