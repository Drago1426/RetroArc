<?php
require_once '../includes/dbh.php';
require_once '../includes/functionsDb.php';

session_start();

// Redirect if not logged in
if (!isset($_SESSION['userId'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewId = $_POST['reviewId'];
    $userId = $_SESSION['userId'];
    $reviewContent = $_POST['review'];
    $rating = $_POST['rating'];
    $currentReview = getReviewById($conn, $reviewId);
    $productId = $currentReview['productId'];
    
    if (!$currentReview) {
        die("Review not found.");
    }

    // Update the review
    $sql = "UPDATE review SET review = ?, starRate = ? WHERE id = ? AND userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siii', $reviewContent, $rating, $reviewId, $userId);

    if ($stmt->execute()) {
        // Redirect to a confirmation page or back to the product page
        header('Location: ../product.php?id=' . $productId . '&status=review_updated');
        exit();
    } else {
        die("Error updating review: " . $stmt->error);
    }
}
?>
