<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

if (!isset($_SESSION['userId'])) {
    echo "Please log in to add items to your cart.";
    exit;
}

$userId = $_SESSION['userId'];
$productId = $_POST['productId'] ?? '';
$quantity = $_POST['quantity'] ?? 1; // Default quantity is 1 if not specified

// Check if the product is already in the cart
$sqlCheck = "SELECT * FROM cart WHERE userId = ? AND productId = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $userId, $productId);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    // Product is already in cart, update quantity
    $existingItem = $resultCheck->fetch_assoc();
    $newQuantity = $existingItem['quantity'] + $quantity;

    $sqlUpdate = "UPDATE cart SET quantity = ? WHERE userId = ? AND productId = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("iii", $newQuantity, $userId, $productId);
    $stmtUpdate->execute();

    echo "Product quantity updated in cart.";
} else {
    // Product is not in cart, add as new entry
    $sqlInsert = "INSERT INTO cart (userId, productId, quantity) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("iii", $userId, $productId, $quantity);
    $stmtInsert->execute();

    echo "Product added to cart.";
}

?>