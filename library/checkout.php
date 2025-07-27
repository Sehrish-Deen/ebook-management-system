<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'library');

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit();
}

// Fetch user ID from session
$studentId = $_SESSION['stdid'];

// Initialize variables to store form data
$name = $number = $email = $method = $address = $total_products = $placed_on = '';
$total_price = 0; // Initialize total price

// Calculate total_price based on items in cart
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $book_id => $details) {
        $sub_total = $details['price'] * $details['quantity'];
        $total_price += $sub_total;
        $total_products .= $details['name'] . ' (' . $details['quantity'] . '), ';
    }
    $total_products = rtrim($total_products, ', '); // Remove trailing comma and space
} else {
    // Handle case where cart is empty
    $error_message = "Your cart is empty. Please add items before checking out.";
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_btn'])) {
    // Sanitize and validate input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $placed_on = date('Y-m-d H:i:s'); // Current datetime for placed_on field

    // Insert order into database if cart is not empty
    if (!empty($total_products)) {
        $insert_order_query = "INSERT INTO orders (studentId, name, number, email, method, address, total_products, total_price, placed_on, payment_status)
                               VALUES ('$studentId', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price', '$placed_on', 'pending')";

        if (mysqli_query($conn, $insert_order_query)) {
            // Order placed successfully, clear cart
            unset($_SESSION['cart']);
            $message = 'Order placed successfully!';
            // Reset total products and total price after order
            $total_products = '';
            $total_price = 0;
        } else {
            $error_message = 'Failed to place order. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Checkout</title>
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
                    <h4 class="header-line">Checkout</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <?php if (isset($message)): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="studentId">Student ID:</label>
                            <input type="text" class="form-control" id="studentId" name="studentId" value="<?php echo htmlentities($studentId); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Your Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Your Number:</label>
                            <input type="text" class="form-control" id="number" name="number" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="method">Payment Method:</label>
                            <select class="form-control" id="method" name="method">
                                <option value="credit card">Credit Card</option>
                                <option value="paypal">Paypal</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Total Products:</label>
                            <p><?php echo htmlentities($total_products); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Total Price:</label>
                            <p>$<?php echo htmlentities($total_price); ?></p>
                        </div>
                        <button type="submit" class="btn btn-success" name="order_btn">Place Order</button>
                    </form>
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
