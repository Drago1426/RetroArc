<?php
session_start();
require_once 'includes/dbh.php';

if (isset($_POST['updateQuantity'])) {
    $productId = $_POST['productId'];
    $newQuantity = $_POST['quantity'];
    $userId = $_SESSION['userId']; // Assuming user ID is stored in session

    // Update the quantity in the cart
    $sql = "UPDATE cart SET quantity = ? WHERE productId = ? AND userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $newQuantity, $productId, $userId);
    $stmt->execute();

    // Redirect back to the cart page
    header('Location: cart.php');
    exit();
}
?>
