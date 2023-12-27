<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'includes/functionsDb.php';
    require_once 'includes/dbh.php'; // Adjust the path as needed


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] === 'createNewAcc') {
            // Extracting form data
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
            $firstName = $_POST['firstName'] ?? '';
            $lastName = $_POST['lastName'] ?? '';
            $houseNameNum = $_POST['houseNameNum'] ?? '';
            $street = $_POST['street'] ?? '';
            $townId = $_POST['town'] ?? '';
            $postCode = $_POST['postCode'] ?? '';

            // Check if username or email already exists
            if (usernameExists($conn, $username)) {
                echo "<script>alert('Username is already taken.');</script>";
            } elseif (emailExists($conn, $email)) {
                echo "<script>alert('An account with this email already exists.');</script>";
            } else {
                // Hash the password and create user
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userCreated = createUser($conn, $username, $hashedPassword, $email, $firstName, $lastName, $houseNameNum, $street, $townId, $postCode);
                if ($userCreated) {
                    echo "<script>alert('Account has been created.');</script>";
                } else {
                    echo "<script>alert('Error creating account. Please try again.');</script>";
                }
            }
        } elseif (isset($_POST['action']) && $_POST['action'] === 'logIn') {
            // Login logic
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userId = authenticateUser($conn, $username, $password);

            if ($userId) {
                $_SESSION['userId'] = $userId; // Store user ID in session
                header('Location: account.php'); // Redirect to account page
                exit();
            } else {
                echo "<script>alert('Invalid username or password');</script>";
            }
        }
    }
?>