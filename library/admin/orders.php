<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'library');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    $sql_update = "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'";
    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['message'] = 'Payment status has been updated!';
    } else {
        $_SESSION['message'] = 'Failed to update payment status: ' . mysqli_error($conn);
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql_delete = "DELETE FROM `orders` WHERE id = '$delete_id'";
    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['message'] = 'Order deleted successfully!';
    } else {
        $_SESSION['message'] = 'Failed to delete order: ' . mysqli_error($conn);
    }
    header('location: orders.php');
    exit();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Placed Orders</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-body {
            padding: 15px;
        }

        .card-body p {
            margin-bottom: 10px;
        }

        .btn {
            margin-top: 10px;
        }
    </style>
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
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            '.$_SESSION['message'].'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                    unset($_SESSION['message']);
                }

                // Fetch orders from `orders` table
                $select_orders = mysqli_query($conn, "SELECT id, StudentId, name, number, email, total_products, total_price, placed_on, payment_status FROM `orders`") or die(mysqli_error($conn));
                if (mysqli_num_rows($select_orders) > 0) {
                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>Student ID: <span><?php echo $fetch_orders['StudentId']; ?></span></p>
                            <p>Name: <span><?php echo $fetch_orders['name']; ?></span></p>
                            <p>Number: <span><?php echo $fetch_orders['number']; ?></span></p>
                            <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
                            <p>Total Products: <span><?php echo $fetch_orders['total_products']; ?></span></p>
                            <p>Total Price: <span>$<?php echo $fetch_orders['total_price']; ?>/-</span></p>
                            <p>Placed On: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                            <p>Payment Status: <span><?php echo $fetch_orders['payment_status']; ?></span></p>
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                                <select name="update_payment">
                                    <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                                <input type="submit" value="Update" name="update_order" class="btn update-btn btn-info">
                            </form>
                            <form action="" method="get" style="display:inline;">
                                <input type="hidden" name="delete" value="<?php echo $fetch_orders['id']; ?>">
                                <button type="submit" onclick="return confirm('Delete this order?');" class="btn delete-btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="col-md-12"><p class="empty">No orders placed yet!</p></div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
