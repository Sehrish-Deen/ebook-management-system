<?php
session_start();
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'library');

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = "DELETE FROM `message` WHERE id = '$delete_id'";
    if(mysqli_query($conn, $delete_query)) {
        $_SESSION['message'] = "Message deleted successfully!";
    } else {
        $_SESSION['message'] = "Failed to delete message!";
    }
    header('location: message.php');
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
                    <h4 class="header-line">Messages</h4>
                </div>
            </div>
            <div class="row">
                <?php
                if(isset($_SESSION['message'])){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            '.$_SESSION['message'].'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                    unset($_SESSION['message']);
                }
                ?>

                <?php
                $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                if(mysqli_num_rows($select_message) > 0){
                    while($fetch_message = mysqli_fetch_assoc($select_message)){
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p> User id : <span><?php echo $fetch_message['id']; ?></span> </p>
                            <p> Name : <span><?php echo $fetch_message['name']; ?></span> </p>
                            <p> Number : <span><?php echo $fetch_message['number']; ?></span> </p>
                            <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
                            <p> Message : <span><?php echo $fetch_message['message']; ?></span> </p>
                            <a href="message.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="btn btn-danger delete-btn">Delete message</a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">You have no messages!</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        // Redirect to dashboard.php after displaying the success message
        <?php if (isset($_SESSION['message'])): ?>
            setTimeout(function() {
                window.location.href = 'dashboard.php';
            }, 3000); // 3 seconds delay
        <?php endif; ?>
    </script>
</body>
</html>
