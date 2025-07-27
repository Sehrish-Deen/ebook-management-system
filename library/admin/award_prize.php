<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submission_id'])) {
    $submission_id = $_POST['submission_id'];

    // Perform prize awarding logic here, update database accordingly
    // Example: Update submissions table to mark this submission as awarded

    $_SESSION['msg'] = "Prize awarded successfully!";
    header('location: dashboard.php'); // Redirect back to the admin dashboard
    exit();
} else {
    $_SESSION['error'] = "Invalid request!";
    header('location: dashboard.php'); // Redirect back to the admin dashboard with an error message
    exit();
}
?>
