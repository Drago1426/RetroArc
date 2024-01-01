<?php
session_start();
require_once '../includes/dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username']) && $_SESSION['username'] === 'Admin' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // SQL to delete the product from the database
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        // Redirect to the products page or display a success message
        header("Location: ../products.php"); // Replace with the actual URL of your products page
        exit();
    } else {
        die("Error deleting product: " . $conn->error);
    }
} else {
    // Redirect to the login page or display an error
    header("Location: ../account.php"); // Redirect to the login page if not admin
    exit();
}
?>
