<?php
session_start();
include('includes/config.php');

// Check if the form is submitted for deleting a book from the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    if (isset($_POST['book_id'])) {
        $book_id = intval($_POST['book_id']);

        // Check if the book exists in the cart
        if (isset($_SESSION['cart'][$book_id])) {
            // Remove the book from the cart
            unset($_SESSION['cart'][$book_id]);

            // Set delete message
            $_SESSION['delete_cart_msg'] = "Book removed from cart successfully!";
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
    <title>Online Library Management System | View Cart</title>
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
                    <h4 class="header-line">Your Cart</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($_SESSION['delete_cart_msg'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo htmlentities($_SESSION['delete_cart_msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['delete_cart_msg']); ?>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Book Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($_SESSION['cart'] as $book_id => $details):
                                $book_total = $details['price'] * $details['quantity'];
                                $total += $book_total;
                            ?>
                            <tr>
                                <td><?php echo htmlentities($details['name']); ?></td>
                                <td>$<?php echo htmlentities($details['price']); ?></td>
                                <td><?php echo htmlentities($details['quantity']); ?></td>
                                <td>$<?php echo htmlentities($book_total); ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="book_id" value="<?php echo htmlentities($book_id); ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" align="right"><strong>Total</strong></td>
                                <td><strong>$<?php echo htmlentities($total); ?></strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="all-books.php" class="btn btn-primary">Continue Shopping</a>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                        </div>
                    </div>
                    <?php else: ?>
                    <p>Your cart is empty.</p>
                    <a href="all-books.php" class="btn btn-primary">Continue Shopping</a>
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
