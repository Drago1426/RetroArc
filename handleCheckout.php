<?php
session_start();
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    // Redirect to login or show an error message
    echo "Please log in to proceed with checkout.";
    exit;
}

$userId = $_SESSION['userId'];

// Fetch cart items
$cartItems = getCartItems($conn, $userId);

// Create a new order
$orderCreated = checkoutCart($conn, $userId); // This function should insert into 'orders' and return the new order ID

if ($orderCreated) {
    $orderId = $conn->insert_id; // Get the last inserted order ID

    // Loop through cart items and insert into orderproducts
    foreach ($cartItems as $item) {
        $productId = $item['productId'];
        $quantity = isset($item['quantity']) && $item['quantity'] ? $item['quantity'] : 1;

        // Insert into orderproducts
        insertOrderProduct($conn, $orderId, $productId, $quantity);
    }

    // Additional code to handle post-checkout actions (like emptying the cart)
    // ...

    echo "An error occurred while placing the order.";

    
} else {
    echo "<script>alert('Order placed successfully.'); window.location.href='index.php';</script>";
}
?>
