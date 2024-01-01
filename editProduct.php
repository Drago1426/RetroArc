<?php
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

// Make sure only an admin can access this page
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

// Get the product ID from the URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = getProductById($conn, $productId);
$types = getAllTypes($conn);
$consoles = getAllConsoles($conn);

include 'includes/header.php';
?>

<div class="account-container">
    </br>
    <h1>Edit Product</h1>
    <form action="handlers/updateProductHandler.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

        <div class="form-field">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" value="<?php echo htmlspecialchars($product['productName']); ?>" required>
            </div>
            <div class="form-field">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-field">
                <label for="typeId">Type:</label>
                <select id="typeId" name="typeId" required>
                    <option value="">Select a Type</option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?php echo htmlspecialchars($type['id']); ?>" <?php echo ($type['id'] == $product['typeId']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($type['type']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-field">
                <label for="consoleId">Console:</label>
                <select id="consoleId" name="consoleId" required>
                    <option value="">Select a Console</option>
                    <?php foreach ($consoles as $console): ?>
                        <option value="<?php echo htmlspecialchars($console['id']); ?>" <?php echo ($console['id'] == $product['consoleId']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($console['console']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-field">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" min = 0 value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="form-field">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min = 0 value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
            </div>
            <div class="form-field">
                <label for="productImage">Product Image Path:</label>
                <input type="text" id="productImage" name="productImage" value="<?php echo htmlspecialchars($product['productImage']); ?>" required>
            </div>
            <div class="form-main">
                <button type="submit" name="submit" class="btn btn-primary">Update Product</button>
            </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
