<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

if (!isset($_SESSION['userId'])) {
    echo "Please log in to add items to your wishlist.";
    exit;
}

$userId = $_SESSION['userId'];
$productId = $_POST['productId'] ?? '';

// Check if the product is already in the wishlist
$sqlCheck = "SELECT * FROM wishlist WHERE userId = ? AND productId = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $userId, $productId);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    header("Location: product.php?id=" . $productId . "&inWishlist=true");
    exit();
} else {
    $sqlInsert = "INSERT INTO wishlist (userId, productId) VALUES (?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("ii", $userId, $productId);
    $stmtInsert->execute();

    header("Location: product.php?id=" . $productId . "&wishlist=true");
    exit();
}
?>