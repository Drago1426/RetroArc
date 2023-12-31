<?php 
    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';

    include 'includes/header.php'; 
?>

<?php
    // Check if the 'type' and 'brand' query parameters are set
    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $brand = isset($_GET['brand']) ? $_GET['brand'] : null;

    // Fetch products
    $products = getProductsByTypeAndBrand($conn, $type, $brand);
    // Now you can use $type and $brand to change your header content dynamically
?>

    <!-- Example: Changing the page title dynamically -->
    <title>
        <?php echo ucfirst($brand) . " " . ucfirst($type); ?> - RetroArc
    </title>

<div class="main-container">
    <div class="content">
        <?php if($type && $brand): ?>
            <h2><?php echo ucfirst($brand) . " " . ucfirst($type); ?></h2>
            <div class="content-wrap">
                <div class="container mt-4">
                    <div class="row">
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="<?php echo htmlspecialchars($product['productImage']); ?>" class="card-img-top card-img-custom" alt="<?php echo htmlspecialchars($product['productName']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['productName']); ?></h5>
                                        <p class="card-price">$<?php echo htmlspecialchars($product['price']); ?></p>
                                        <div class="card-actions">
                                            <!-- Other buttons like 'Buy' can go here as well -->
                                            <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary">Buy</a>

                                            <!-- Buttons only for admin -->
                                            <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'Admin'): ?>
                                                <a href="editProduct.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-warning">Edit</a>
                                                <form action="deleteProductHandler.php" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['id']); ?>">
                                                    <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Default content if no type/brand is selected -->
        <?php endif; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>