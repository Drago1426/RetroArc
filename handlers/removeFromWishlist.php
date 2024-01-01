<?php
session_start();
require_once '../includes/dbh.php'; // or your database connection file
require_once '../includes/functionsDb.php'; // or your functions file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $userId = $_SESSION['userId']; // Assuming you store the user's ID in the session

    // Function to remove the product from wishlist
    if(removeFromWishlist($conn, $userId, $productId)) {
        // If the removal is successful, redirect back to the wishlist page
        header('Location: ../wishlist.php');
        exit();
    } else {
        // Handle error, could log this error, or display a message to the user
        echo "Error removing item from wishlist.";
        // Redirect back to wishlist or display error
        header('Location: ../wishlist.php?error=unabletoremove');
        exit();
    }
} else {
    // Redirect to home or wishlist page if accessed without a POST request
    header('Location: ../wishlist.php');
    exit();
}
?>