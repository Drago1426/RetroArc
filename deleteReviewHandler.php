<?php
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

session_start();

// Check if the user is logged in and the reviewId POST variable is set
if (!isset($_SESSION['userId']) || !isset($_POST['reviewId'])) {
    // Redirect to the login page or show an error
    header('Location: account.php');
    exit();
}

$userId = $_SESSION['userId'];
$reviewId = $_POST['reviewId'];

// Fetch the review to check if the user trying to delete it is the owner of the review
$review = getReviewById($conn, $reviewId);

if ($review && $review['userId'] == $userId) {
    // The user is the owner, proceed with deletion
    $sql = "DELETE FROM review WHERE id = ? AND userId = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ii', $reviewId, $userId);
        if ($stmt->execute()) {
            // Successfully deleted the review
            // Redirect to a page to show success message
            header('Location: product.php?id=' . $review['productId'] . '&status=review_deleted');
            exit();
        } else {
            die("Error deleting review: " . $stmt->error);
        }
    } else {
        die("Error preparing statement: " . $conn->error);
    }
} else {
    // The review does not exist or the user does not have permission to delete it
    die("You do not have permission to delete this review.");
}
?>