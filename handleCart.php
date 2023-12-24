<?php
// handleCart.php
session_start();
require_once 'includes/dbh.php'; // Your database connection file

if (isset($_POST['productId'], $_POST['quantity'], $_POST['action'])) {
    $productId = intval($_POST['productId']);
    $quantity = intval($_POST['quantity']);
    $action = $_POST['action'];

    switch ($action) {
        case 'addToCart':
            // Add product to cart logic
            break;
        case 'addToWishlist':
            // Add product to wishlist logic
            break;
        // Handle other actions if necessary
    }

    // Redirect back to product page or another appropriate page
    header('Location: product.php?id=' . $productId);
    exit;
}

// If not all required POST data is set, redirect back or handle error
header('Location: someErrorPage.php');
exit;
?>