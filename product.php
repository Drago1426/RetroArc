<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_GET['status']) && $_GET['status'] === 'review_deleted') {
        echo "<script>alert('Review deleted successfully!');</script>";
    }

    if (isset($_GET['status']) && $_GET['status'] === 'review_updated') {
        echo "<script>alert('Review updated successfully!');</script>";
    }

    if (isset($_GET['status']) && $_GET['status'] === 'already_reviewed') {
        echo "<script>alert('You have already reviewed this product.');</script>";
    }

    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';
    

    // Check if user is logged in
    $isLoggedIn = isset($_SESSION['userId']);
    $currentUserId = $_SESSION['userId'] ?? null;

    // Get product ID from URL
    $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Fetch product and review details from database
    $product = getProductById($conn, $productId);
    $reviews = getReviewsByProductId($conn, $productId, $currentUserId);
    

    include 'includes/header.php'; 
    //echo "Product ID: " . $productId;
?>

    <div class="product-container">
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['productImage']); ?>" alt="<?php echo htmlspecialchars($product['productName']); ?>">
        </div>
        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['productName']); ?></h1>
            <h4 class="product-price">€<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></h4>
        </div>
        <div class="product-actions">
            <form action="handleCart.php" method="post">
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="<?php echo htmlspecialchars($product['quantity']); ?>" value="1">
                </div>

                <!-- Hidden field to pass the product ID -->
                <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['id']); ?>">

                <div class="row">
                    <div class="col">
                        <form action="add_to_cart.php" method="post">
                            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                            <button type="button" class="btn btn-primary" onclick="addToCart(<?php echo $productId; ?>)">Add to Cart</button>
                        </form>
                        <form action="add_to_wishlist.php" method="post">
                            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                            <button class="btn btn-secondary" type="button" onclick="addToWishlist(<?php echo $productId; ?>)">Add to Wishlist</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
        <div class="product-description">
            <h3>Description:</h3>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
        </div>
        <div class="mt-5">
            <?php if ($isLoggedIn): ?>
                <!-- Review Form for Logged In Users -->
                <h2>Write a Review</h2>
                <form action="submitReview.php" method="post">
                    <input type="hidden" name="productId" value="<?php echo htmlspecialchars($productId); ?>">
                    <div class="form-group">
                        <label for="review">Your Review:</label>
                        <textarea class="form-control" id="review" name="review" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select class="form-control" id="rating" name="rating" required>
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="2">2 Stars</option>
                            <option value="1">1 Star</option>
                        </select>
                    </div>
                    <button type="submit" name="submitReview" class="btn btn-primary">Submit Review</button>
                </form>
            <?php endif; ?>
            <h2>Customer Reviews</h2>
            <?php foreach ($reviews as $review): ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($review['userName']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($review['starRate']); ?> stars</h6>
                        <p class="card-text"><?php echo htmlspecialchars($review['review']); ?></p>
                        <p class="card-text"><small class="text-muted">Reviewed on: <?php echo date("F j, Y, g:i a", strtotime($review['reviewDate'])); ?></small></p>
                        <?php if ($review['userId'] == $currentUserId): ?>
                            <a href="editReview.php?reviewId=<?php echo htmlspecialchars($review['id']); ?>" class="btn btn-primary">Edit</a>
                            </br>
                            <form action="deleteReviewHandler.php" method="post" onsubmit="return confirm('Are you sure you want to delete this review?');" style="display: inline;">
                                <input type="hidden" name="reviewId" value="<?php echo htmlspecialchars($review['id']); ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>