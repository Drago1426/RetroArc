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

?>