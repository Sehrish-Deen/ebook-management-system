<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect to login page if user is not logged in
if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
    exit();
}

// Get the student ID from session
$sid = $_SESSION['stdid'];

// Fetch orders from the database for the logged-in student
$orders_query = "SELECT * FROM orders WHERE StudentId = :sid ORDER BY placed_on DESC";
$query = $dbh->prepare($orders_query);
$query->bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$orders = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ebook Management System | Placed Orders</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Placed Orders</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Order ID: <?php echo htmlentities($order->id); ?>
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>Student ID:</strong> <?php echo htmlentities($order->StudentId); ?></p>
                                        <p><strong>Placed On:</strong> <?php echo date('d-M-Y', strtotime($order->placed_on)); ?></p>
                                        <p><strong>Name:</strong> <?php echo htmlentities($order->name); ?></p>
                                        <p><strong>Number:</strong> <?php echo htmlentities($order->number); ?></p>
                                        <p><strong>Email:</strong> <?php echo htmlentities($order->email); ?></p>
                                        <p><strong>Address:</strong> <?php echo htmlentities($order->address); ?></p>
                                        <p><strong>Payment Method:</strong> <?php echo htmlentities($order->method); ?></p>
                                        <p><strong>Your Orders:</strong> <?php echo htmlentities($order->total_products); ?></p>
                                        <p><strong>Total Price:</strong> $<?php echo htmlentities($order->total_price); ?>/-</p>
                                        <p><strong>Payment Status:</strong> <?php echo htmlentities($order->payment_status); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">No orders placed yet.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
