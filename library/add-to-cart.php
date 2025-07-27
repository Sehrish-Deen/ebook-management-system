<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['book_id'])) {
        $book_id = intval($_POST['book_id']);

        // Fetch book details from database based on $book_id
        $sql = "SELECT id, BookName, BookPrice FROM tblbooks WHERE id = :book_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $query->execute();
        $book = $query->fetch(PDO::FETCH_ASSOC);

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
                    'quantity' => 1
                );
            }

            // Save cart details to the database
            $user_id = $_SESSION['StudentId']; // Assuming user_id is stored in session after login

            // Check if the book is already in the user's cart
            $checkCart = $dbh->prepare("SELECT * FROM cart WHERE book_id = :book_id AND user_id = :StudentId");
            $checkCart->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $checkCart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $checkCart->execute();
            $existingCart = $checkCart->fetch(PDO::FETCH_ASSOC);

            if ($existingCart) {
                // If the book is already in the cart, update the quantity
                $newQuantity = $existingCart['quantity'] + 1;
                $updateCart = $dbh->prepare("UPDATE cart SET quantity = :quantity WHERE book_id = :book_id AND user_id = :user_id");
                $updateCart->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
                $updateCart->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $updateCart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $updateCart->execute();
            } else {
                // If the book is not in the cart, insert a new record
                $insertCart = $dbh->prepare("INSERT INTO cart (book_id, user_id, name, price, quantity) VALUES (:book_id, :user_id, :name, :price, :quantity)");
                $insertCart->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $insertCart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insertCart->bindParam(':name', $book['BookName'], PDO::PARAM_STR);
                $insertCart->bindParam(':price', $book['BookPrice'], PDO::PARAM_STR);
                $insertCart->bindParam(':quantity', $_SESSION['cart'][$book_id]['quantity'], PDO::PARAM_INT);
                $insertCart->execute();
            }

            // Set success message
            $_SESSION['add_to_cart_msg'] = "Book '{$book['BookName']}' added to cart successfully!";
        } else {
            // Set error message if book not found
            $_SESSION['add_to_cart_error'] = "Book not found or unavailable!";
        }
    }
}

// Redirect back to the referring page (assuming this is where the form was submitted from)
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
