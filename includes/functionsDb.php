<?php

function getProducts($limit = 3) {
    // Assuming $conn is your database connection variable
    global $conn;

    $sql = "SELECT id, productName, productImage, price FROM Product LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->close();
    
    return $products;
}

function getProductsByTypeAndBrand($conn, $type, $brand) {
    $sql = "SELECT p.id, p.productName, p.productImage, p.price, p.consoleId, p.typeId
            FROM product AS p
            JOIN consoles AS c ON p.consoleId = c.id
            JOIN productType AS t ON p.typeId = t.id
            WHERE c.console = ? AND t.type = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $brand, $type);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // No products found
        echo "No products found for the selected type and brand.";
        return [];
    }

    $products = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->close();
    
    return $products;
}

function getProductById($conn, $productId) {
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    $stmt->close();

    return $product;
}

function getReviewsByProductId($conn, $productId) {
    $sql = "SELECT r.userId, r.productId, r.review, r.starRate, r.reviewDate, u.userName 
            FROM review AS r 
            JOIN user AS u ON r.userId = u.id
            WHERE r.productId = ? 
            ORDER BY r.reviewDate DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getTowns($conn) {
    $sql = "SELECT * FROM town";
    $result = $conn->query($sql);

    $towns = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $towns[] = $row;
        }
    }
    return $towns;
}

function usernameExists($conn, $username) {
    $sql = "SELECT COUNT(*) FROM user WHERE username = ?";  // Replace 'users' with your actual table name
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // 's' indicates the type of the parameter (string)
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    // If count is more than 0, username exists
    return $row[0] > 0;
}

function emailExists($conn, $email) {
    $sql = "SELECT COUNT(*) FROM user WHERE email = ?";  // Replace 'users' with your actual table name
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    // If count is more than 0, email exists
    return $row[0] > 0;
}

function createUser($conn, $username, $password, $email, $firstName, $lastName, $houseNameNum, $street, $townId, $postCode) {
    $sql = "INSERT INTO user (username, password, email, firstName, lastName, houseNameNum, street, townId, postCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Debugging: Output the values being bound
    error_log("Creating user: $username, $password, $email, $firstName, $lastName, $houseNameNum, $street, $townId, $postCode");

    $stmt->bind_param("sssssssss", $username, $password, $email, $firstName, $lastName, $houseNameNum, $street, $townId, $postCode);

    // Execute the prepared statement
    if (!$stmt->execute()) {
        // If execution fails, output the error
        error_log("Error in createUser: " . $stmt->error);
        return false;
    }

    return $stmt->affected_rows > 0;
}

function authenticateUser($conn, $username, $password) {
    $sql = "SELECT id, password FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user['id'];  // Return user's ID if password is correct
        }
    }
    return false;
}

function getUserDetails($conn, $userId) {
    $sql = "SELECT u.username, u.firstName, u.lastName, u.email, u.houseNameNum, u.street, t.townName, u.postCode 
            FROM user u
            LEFT JOIN town t ON u.townId = t.id 
            WHERE u.id = ?"; // Specify 'u.id' instead of just 'id'
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


//Wish List Page

function isProductInWishlist($conn, $userId, $productId) {
    $sql = "SELECT COUNT(*) FROM wishlist WHERE userId = ? AND productId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    return $row[0] > 0;
}

function getUserWishlist($conn, $userId) {
    $sql = "SELECT p.* FROM wishlist w 
            JOIN product p ON w.productId = p.id 
            WHERE w.userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function removeFromWishlist($conn, $userId, $productId) {
    // SQL to remove the item from the wishlist
    $sql = "DELETE FROM wishlist WHERE userId = ? AND productId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userId, $productId);

    return $stmt->execute();
}


//Cart Page

function getCartItems($conn, $userId) {
    $sql = "SELECT productId, productImage, SUM(c.quantity) AS totalQuantity, 
            SUM(c.quantity) * p.price AS subtotal, productName, price
            FROM cart c
            JOIN product p ON c.productId = p.id
            WHERE userId = ?
            GROUP BY productId";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function calculateCartTotal($cartItems) {
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['subtotal'];
    }
    return $total;
}

function removeFromCart($conn, $userId, $productId) {
    $sql = "DELETE FROM cart WHERE userId = ? AND productId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();

    // Redirect back to the same page
    header("Location: cart.php"); // Replace 'cart.php' with the actual name of your cart page
    exit();
}

function checkoutCart($conn, $userId) {
    $conn->begin_transaction();

    // Fetch cart items before calculating total
    $cartItems = getCartItems($conn, $userId);
    $orderStatusId = 1;
    $totalPrice = calculateCartTotal($cartItems);

    // Insert into orders table
    $orderSql = "INSERT INTO orders (userId, orderDate, totalPrice, statusId) VALUES (?, NOW(), ?, ?)";
    $orderStmt = $conn->prepare($orderSql);
    $orderStmt->bind_param("idd", $userId, $totalPrice, $orderStatusId);
    $orderStmt->execute();
    if ($orderStmt->affected_rows === 0) {
        // Order insertion failed
        $conn->rollback();
        return false;
    }
    $orderId = $conn->insert_id;  // Retrieve the orderId

    // Debugging: Output the orderId to check its value
    error_log("Retrieved orderId: " . $orderId);

    // Check if orderId is valid
    if ($orderId <= 0) {
        $conn->rollback();
        return false;
    }

    foreach ($cartItems as $item) {
        // Insert each item into orderproducts
        if (!insertOrderProduct($conn, $orderId, $item['productId'], $item['totalQuantity'])) {
            // If insertion fails, rollback and return false
            $conn->rollback();
            return false;
        }
    }

    // Clear the cart
    $clearCartSql = "DELETE FROM cart WHERE userId = ?";
    $clearCartStmt = $conn->prepare($clearCartSql);
    $clearCartStmt->bind_param("i", $userId);
    $clearCartStmt->execute();

    $conn->commit();
    return $orderId; // Return the orderId on successful completion
}

function insertOrderProduct($conn, $orderId, $productId, $quantity) {
    $sql = "INSERT INTO orderproducts (orderId, productId, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $orderId, $productId, $quantity);

    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error inserting order product: " . $stmt->error);
        return false;
    }
}

function getOrderHistory($conn, $userId) {
    $sql = "SELECT o.*, status.status 
            FROM orders o
            LEFT JOIN status ON o.statusId = status.id
            WHERE o.userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
    return $orders;
}

function insertReview($conn, $userId, $productId, $review, $rating) {
    $sql = "INSERT INTO review (userId, productId, starRate, review, reviewDate) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return false;
    }
    $stmt->bind_param("iiis", $userId, $productId, $rating, $review);

    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        return false;
    }
    return true;
}
?>