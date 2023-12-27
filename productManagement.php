<?php 
    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';

    include 'includes/header.php';

    $types = getAllTypes($conn); // You might need to create this function
    $consoles = getAllConsoles($conn); // You might need to create this function
?>

    <div class="account-container">
        <h1 class="main-title">Add New product</h1>
        <form action="addProductHandler.php" method="post">
            <div class="form-field">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>
            </div>
            <div class="form-field">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-field">
                <label for="typeId">Type:</label>
                <select id="typeId" name="typeId" required>
                    <option value="">Select a Type</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo htmlspecialchars($type['id']); ?>">
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
                            <option value="<?php echo htmlspecialchars($console['id']); ?>">
                                <?php echo htmlspecialchars($console['console']); ?>
                            </option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="form-field">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" min = 0 required>
            </div>
            <div class="form-field">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min = 0 required>
            </div>
            <div class="form-field">
                <label for="productImage">Product Image Path:</label>
                <input type="text" id="productImage" name="productImage" required>
            </div>
            <div class="form-main">
                <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
            </div>
        </form>
    </div>
<?php include 'includes/footer.php'; ?>