<?php
session_start();
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

if (isset($_POST['submitReview']) && isset($_SESSION['userId'])) {
    $productId = $_POST['productId'] ?? 0;
    $userId = $_SESSION['userId'];  // Assuming this is set upon user login
    $review = $_POST['review'] ?? '';
    $rating = $_POST['rating'] ?? 0;

    // Validate the input...

    // Insert the review into the database
    $success = insertReview($conn, $userId, $productId, $review, $rating);
    if ($success) {
        echo "<script>alert('Review submitted successfully.'); window.location.href='product.php?id=$productId';</script>";
    } else {
        echo "<script>alert('Error submitting review.'); window.location.href='product.php?id=$productId';</script>";
    }
} else {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}
?>