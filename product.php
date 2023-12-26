<?php 
    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';

    // Get product ID from URL
    $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Fetch product and review details from database
    $product = getProductById($conn, $productId);
    $reviews = getReviewsByProductId($conn, $productId);

    include 'includes/header.php'; 
    //echo "Product ID: " . $productId;
?>

    <div class="product-container">
        <div class="product-image">
            <!-- Dynamically load product image -->
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
            <!-- Dynamically load product description -->
            <h3>Description:</h3>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <!-- ... -->
        </div>
        <div class="mt-5">
            <!-- Review Form Here -->
            <form action="submitReview.php" method="post">
                <!-- Form content here -->
            </form>
            <!-- ... -->
            <h2>Customer Reviews</h2>
            <?php foreach ($reviews as $review): ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($review['userName']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($review['starRate']); ?> stars</h6>
                        <p class="card-text"><?php echo htmlspecialchars($review['review']); ?></p>
                        <p class="card-text"><small class="text-muted">Reviewed on: <?php echo date("F j, Y, g:i a", strtotime($review['reviewDate'])); ?></small></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>



                