<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'includes/dbh.php'; // Database connection file

    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $typeId = $_POST['typeId'];
    $consoleId = $_POST['consoleId'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $productImage = $_POST['productImage'];

    // Validation logic here...

    // SQL to insert data into products table
    $sql = "INSERT INTO product (productName, description, typeId, consoleId, price, quantity, productImage) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiids", $productName, $description, $typeId, $consoleId, $price, $quantity, $productImage);

    if ($stmt->execute()) {
        echo "<script>
                alert('Product added successfully.');
                window.location.href='addProduct.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
