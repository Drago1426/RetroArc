<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';

    if (!isset($_SESSION['userId'])) {
        header('Location: account.php'); // Redirect to login if not logged in
        exit();
    }

    $userId = $_SESSION['userId'];
    $cartItems = getCartItems($conn, $userId);
    $total = calculateCartTotal($cartItems);

    // Handle post request for removing items from cart or checking out
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Removal from cart
        if (isset($_POST['removeFromCart'])) {
            $productId = $_POST['productId'];
            removeFromCart($conn, $userId, $productId);
        }
        // Checkout
        if (isset($_POST['checkout'])) {
            checkoutCart($conn, $userId);
        }
    }

    include 'includes/header.php';
?>

    <div class="container my-4">
        <h1 class="mb-4">Cart</h1>
        <div class="cart-content-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars($item['productImage']); ?>" alt="Game Name" style="width: 100px; height: auto;">
                        </td>
                        <td><?php echo htmlspecialchars($item['productName']); ?></td>
                        <td>€<?php echo htmlspecialchars($item['price']); ?></td>
                        <td><?php echo htmlspecialchars($item['cartQuantity']); ?></td>
                        <td>€<?php echo htmlspecialchars($item['subtotal']); ?></td>
                        <td>
                            <form action="handlers/updateCartQuantity.php" method="post">
                                <input type="hidden" name="productId" value="<?php echo $item['productId']; ?>">
                                 <input type="number" name="quantity" value="<?php echo $item['cartQuantity']; ?>" min="1" max="<?php echo $item['availableQuantity']; ?>">
                                <button type="submit" name="updateQuantity" class="btn btn-secondary">Update</button>
                            </form>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="productId" value="<?php echo $item['productId']; ?>">
                                <button type="submit" name="removeFromCart" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-right"><h5>Total</h5></td>
                        <td>€<?php echo htmlspecialchars($total); ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- Only display if the user is logged in and the cart is not empty -->
            <?php if (isset($_SESSION['userId']) && !empty($cartItems)): ?>
                <form action="handlers/handleCheckout.php" method="post">
                    <button type="submit" class="btn btn-success">Checkout</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>