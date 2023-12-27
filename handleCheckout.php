<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    // Redirect to login or show an error message
    echo "Please log in to proceed with checkout.";
    exit;
}

$userId = $_SESSION['userId'];

// Create a new order
$orderCreated = checkoutCart($conn, $userId); // This handles order creation and orderproducts insertion

if ($orderCreated) {
    // Additional code to handle post-checkout actions (like emptying the cart)
    // ...

    echo "<script>alert('Order placed successfully.'); window.location.href='index.php';</script>";
} else {
    echo "An error occurred while placing the order.";
}
?>
