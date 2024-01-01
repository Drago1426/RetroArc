<?php
require_once '../includes/dbh.php';
require_once '../includes/functionsDb.php';

session_start();

// Check if the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Admin') {
    header('Location: ../account.php');
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract and sanitize the inputs
    $productId = $_POST['id'] ?? null;
    $productName = $_POST['productName'] ?? '';
    $description = $_POST['description'] ?? '';
    $typeId = $_POST['typeId'] ?? null;
    $consoleId = $_POST['consoleId'] ?? null;
    $price = $_POST['price'] ?? null;
    $quantity = $_POST['quantity'] ?? null;
    $productImage = $_POST['productImage'] ?? '';

    // Validation would go here

    // Prepare the SQL statement
    $sql = "UPDATE product SET 
                productName = ?,
                description = ?,
                typeId = ?,
                consoleId = ?,
                price = ?,
                quantity = ?,
                productImage = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters to the statement
        $stmt->bind_param('ssiiiiss', 
            $productName, 
            $description, 
            $typeId, 
            $consoleId, 
            $price, 
            $quantity, 
            $productImage, 
            $productId
        );

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a confirmation page or back to the product list
            header('Location: ../index.php?update=success');
            exit();
        } else {
            // Handle errors, perhaps log them and show an error message
            die("Error updating product: " . $stmt->error);
        }
    } else {
        // Handle errors, perhaps log them and show an error message
        die("Error preparing statement: " . $conn->error);
    }
}
?>
