<?php 
    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';

    include 'includes/header.php'; 

    $products = getProducts();


    if (isset($_GET['update']) && $_GET['update'] === 'success') {
        echo "<script>alert('Product updated successfully!');</script>";
    }

?>


    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/banner1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/images/banner2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/images/banner4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<div class="main-container">
    <h2>New Arrivals</h2>
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
                                    <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary">Buy</a>

                                    <!-- Buttons only for admin -->
                                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'Admin'): ?>
                                        <a href="editProduct.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-warning">Edit</a>
                                        <form action="handlers/deleteProductHandler.php" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
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

    <h2>Popular Items</h2>
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
                                    <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary">Buy</a>

                                    <!-- Buttons only for admin -->
                                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'Admin'): ?>
                                        <a href="editProduct.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-warning">Edit</a>
                                        <form action="handlers/deleteProductHandler.php" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
</div>
        
<?php include 'includes/footer.php'; ?>