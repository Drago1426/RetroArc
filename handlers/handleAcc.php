<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../includes/functionsDb.php';
    require_once '../includes/dbh.php';


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
                header('Location: ../account.php?usernameTaken=true'); // Redirect to account page
            } elseif (emailExists($conn, $email)) {
                header('Location: ../account.php?emailExists=true'); // Redirect to account page
            } else {
                // Hash the password and create user
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userCreated = createUser($conn, $username, $hashedPassword, $email, $firstName, $lastName, $houseNameNum, $street, $townId, $postCode);
                if ($userCreated) {
                    header('Location: ../account.php?accCreated=true');
                } else {
                    header('Location: ../account.php?accNotCreated=true');
                }
            }
        } elseif (isset($_POST['action']) && $_POST['action'] === 'logIn') {
            // Login logic
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userId = authenticateUser($conn, $username, $password);

            if ($userId) {
                $_SESSION['userId'] = $userId; // Store user ID in session
                $_SESSION['username'] = $username;
                header('Location: ../account.php?loggedIn=true'); // Redirect to account page
            } else {
                header('Location: ../account.php?invalidCred=true');
            }
        }
    }
?>