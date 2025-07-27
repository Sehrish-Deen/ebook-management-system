<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['login'])==0) {   
    header('location:index.php');
    exit(); // Add exit after header redirect to prevent further execution
} else { 
    // Process form submission when Add to Cart button is clicked
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['book_id'])) {
            $book_id = intval($_POST['book_id']);

            // Fetch book details from database based on $book_id
            $sql = "SELECT id, BookName, BookPrice, cover_img, sub_id FROM tblbooks WHERE id = :book_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $query->execute();
            $book = $query->fetch(PDO::FETCH_ASSOC);

            // Fetch subscription details from database
            $sub_sql = "SELECT sub_name, charges FROM subscription WHERE sub_id = :sub_id";
            $sub_query = $dbh->prepare($sub_sql);
            $sub_query->bindParam(':sub_id', $book['sub_id'], PDO::PARAM_INT);
            $sub_query->execute();
            $subscription = $sub_query->fetch(PDO::FETCH_ASSOC);

            if ($book) {
                // Add book details to cart session variable
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array();
                }

                // Check if book already exists in cart, if yes, increase quantity
                if (isset($_SESSION['cart'][$book_id])) {
                    $_SESSION['cart'][$book_id]['quantity']++;
                } else {
                    // If book does not exist in cart, add it with initial quantity 1
                    $_SESSION['cart'][$book_id] = array(
                        'name' => $book['BookName'],
                        'price' => $book['BookPrice'],
                        'sub_price' => $subscription['charges'],
                        'quantity' => 1,
                        'image' => $book['cover_img']
                    );
                }

               

                // Insert cart details into the database
                $insert_sql = "INSERT INTO cart (studentId, name, price, sub_price, quantity, image) VALUES (:StudentId, :name, :price, :sub_price, :quantity, :image)";
                $insert_query = $dbh->prepare($insert_sql);
                $insert_query->bindParam(':StudentId', $studentId, PDO::PARAM_INT); // Ensure StudentId is properly bound
                $insert_query->bindParam(':name', $book['BookName'], PDO::PARAM_STR);
                $insert_query->bindParam(':price', $book['BookPrice'], PDO::PARAM_STR);
                $insert_query->bindParam(':sub_price', $subscription['charges'], PDO::PARAM_STR);
                $insert_query->bindParam(':quantity', $_SESSION['cart'][$book_id]['quantity'], PDO::PARAM_INT);
                $insert_query->bindParam(':image', $book['cover_img'], PDO::PARAM_STR);
                $insert_query->execute();

                // Set success message
                $_SESSION['add_to_cart_msg'] = "Book '{$book['BookName']}' added to cart successfully!";
            } else {
                // Set error message if book not found
                $_SESSION['add_to_cart_error'] = "Book not found or unavailable!";
            }

            // Redirect to view-cart.php after adding to cart
            header('Location: view-cart.php');
            exit();
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
    <title>Ebook Management System | All Books</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .card {
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            height: 250px;
            width: 100%;
            object-fit: contain; /* Ensure the whole image fits within the container */
        }
        .card-body {
            padding: 15px;
            text-align: center;
        }
        .card-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Latest Book Arrivals</h4>
                </div>
            </div>
            <div class="row">
                <?php
                // Display success message if set
                if (isset($_SESSION['add_to_cart_msg'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            '.$_SESSION['add_to_cart_msg'].'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                    unset($_SESSION['add_to_cart_msg']); // Clear message after displaying
                }

                // Display error message if set
                if (isset($_SESSION['add_to_cart_error'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            '.$_SESSION['add_to_cart_error'].'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                    unset($_SESSION['add_to_cart_error']); // Clear message after displaying
                }

                $sql = "SELECT tblbooks.id, tblbooks.BookName, tblauthors.AuthorName, tblbooks.BookPrice, tblbooks.cover_img, subscription.sub_name, subscription.charges 
                        FROM tblbooks 
                        JOIN tblauthors ON tblauthors.id=tblbooks.AuthorId
                        JOIN subscription ON subscription.sub_id=tblbooks.sub_id";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                if($query->rowCount() > 0) {
                    foreach($results as $result) { ?> 
                    <div class="col-md-4">
                        <div class="card">
                            <?php if($result->cover_img): ?>
                            <img class="card-img-top" src="admin/uploads/books/<?php echo htmlentities($result->cover_img);?>" alt="Book Cover">
                            <?php else: ?>
                            <img class="card-img-top" src="uploads/books/no_image.png" alt="No Cover">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlentities($result->BookName);?></h5>
                                <p class="card-text">By <?php echo htmlentities($result->AuthorName);?></p>
                                <p class="card-text">Price: $<?php echo htmlentities($result->BookPrice);?></p>
                                <p class="card-text">Subscription: <?php echo htmlentities($result->sub_name);?> (Charges: $<?php echo htmlentities($result->charges);?>)</p>
                                <form method="post" action="">
                                    <input type="hidden" name="book_id" value="<?php echo htmlentities($result->id); ?>">
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>

