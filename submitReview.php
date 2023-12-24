<?php
// submitReview.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $productId = /* ... */;
    $userName = /* ... */;
    $rating = /* ... */;
    $reviewText = /* ... */;

    // Insert the review into the database
    $sql = "INSERT INTO reviews (productId, userName, rating, reviewText) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isis", $productId, $userName, $rating, $reviewText);
    $stmt->execute();

    // Redirect back to the product page or handle errors
    header('Location: product.php?id=' . $productId);
    exit;
}