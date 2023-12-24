<?php
    session_start();
    require_once 'includes/dbh.php';
    require_once 'includes/functionsDb.php';
    require_once 'handleAcc.php';

    // Check if the logout button has been pressed
    if (isset($_POST['logout'])) {
        // Unset all of the session variables
        $_SESSION = array();

        // Destroy the session.
        session_destroy();

        // Set $isLoggedIn to false
        $isLoggedIn = false;
    } else {
        // Check if user is logged in
        $isLoggedIn = isset($_SESSION['userId']);
    }

    include 'includes/header.php'; 

    $products = getProducts();
    $towns = getTowns($conn);

?>


    <div class="account-container">
        <?php if ($isLoggedIn): 
            $userId = $_SESSION['userId'];
            // Fetch user details from the database
            $user = getUserDetails($conn, $userId);
            
            echo "<h2>User Profile</h2>" . "<br>";
            echo "Username: " . htmlspecialchars($user['username']) . "<br>" . "<br>";
            echo "Name: " . htmlspecialchars($user['firstName']) . " " . htmlspecialchars($user['lastName']) . "<br>" . "<br>";
            echo "Email: " . htmlspecialchars($user['email']) . "<br>" . "<br>";
            echo "Address: " . htmlspecialchars($user['houseNameNum']) . ", " . 
                htmlspecialchars($user['street']) . ", " . htmlspecialchars($user['townName']) . 
                ", " . htmlspecialchars($user['postCode']) . "<br>" . "<br>";
        ?>
        <form action="account.php" method="post">
            <button type="submit" name="logout" class="btn btn-primary">Logout</button>
        </form>
        <?php else: ?>
            <div class="create-account-content-wrap">
                <div class="account-container">
                    <h1 class="main-title">Create new account</h1>
                    <form action="#" method="post">
                        <div class="form-field">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-field">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-field">
                            <label for="confirmPassword">Confirm password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <div class="form-field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-field">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-field">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-field">
                            <label for="houseNameNum">House name/number</label>
                            <input type="text" id="houseNameNum" name="houseNameNum" required>
                        </div>
                        <div class="form-field">
                            <label for="street">Street</label>
                            <input type="text" id="street" name="street" required>
                        </div>
                        <div class="form-field">
                            <label for="town">Town</label>
                            <select id="town" name="town" required>
                                <option value="">Select a Town</option>
                                <?php foreach ($towns as $town): ?>
                                    <option value="<?php echo htmlspecialchars($town['id']); ?>">
                                        <?php echo htmlspecialchars($town['townName']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="postCode">Post Code</label>
                            <input type="text" id="postCode" name="postCode" required>
                        </div>
                        <div class="form-main">
                            <button type="submit" name="action" value="createNewAcc" class="btn btn-primary w-100">Create Account</button>
                        </div>
                        <div class="form-actions">
                            <button id="showLogin" class="toggle-button">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="login-content-wrap">
                <!-- Your Log In Form Here -->
                <div class="login-content-wrap">
                    <div class="login-container">
                        <h1 class="main-title">Log In</h1>
                        <form action="#" method="post">
                            <div class="form-field">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" required>
                            </div>
                            <div class="form-field">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="form-main">
                                <button type="submit" name="action" value="logIn" class="btn btn-primary w-100">Log In</button>
                            </div>
                            <div class="form-actions">
                                <button id="showCreateAccount" class="toggle-button">Create New Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php include 'includes/footer.php'; ?>