<?php
    session_start();
    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';

    // Redirect to login page if not logged in
    if (!isset($_SESSION['userId'])) {
        header('Location: account.php'); // Adjust if your login page has a different name
        exit();
    }

    include 'includes/header.php';

    $userId = $_SESSION['userId'];
    $wishlistItems = getUserWishlist($conn, $userId);
?>

    <div class="container my-4">
        <h1 class="mb-4">Wishlist</h1>
        <div class="cart-content-wrap">
            <?php if (count($wishlistItems) > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wishlistItems as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo htmlspecialchars($item['productImage']); ?>" alt="Game Name" style="width: 100px; height: auto;">
                                </td>
                                <td><?php echo htmlspecialchars($item['productName']); ?></td>
                                <td><?php echo htmlspecialchars("€" . $item['price']); ?></td>
                                <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="add_to_cart.php" method="post">
                                    <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                                    <button type="button" class="btn btn-success" onclick="addToCart(<?php echo $item['id']; ?>)">Add to Cart</button>
                                </form>
                                </div>
                                    
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="removeFromWishlist.php" method="post">
                                            <input type="hidden" name="productId" value="<?php echo $item['id']; ?>">
                                            <button type="submit" name="removeFromWishlist" class="btn btn-danger">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Your wishlist is empty.</p>
            <?php endif; ?>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>