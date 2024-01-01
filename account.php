<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'includes/functionsDb.php';
    require_once 'includes/dbh.php';

    require_once 'handlers/handleAcc.php';

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

    // Define $userId here, immediately after checking $isLoggedIn
    if ($isLoggedIn) {
        $userId = $_SESSION['userId'];
    }

    // Initialize or retrieve the display state
    if (!isset($_SESSION['displayState'])) {
        $_SESSION['displayState'] = 'profile'; // default to showing profile
    }

    // Toggle state on button press
    if (isset($_POST['toggleView'])) {
        $_SESSION['displayState'] = $_POST['toggleView'] === 'viewOrders' ? 'orders' : 'profile';
    }

    // Fetch user details or order history based on the state
    if ($isLoggedIn && $_SESSION['displayState'] === 'orders') {
        $orderHistory = getOrderHistory($conn, $userId);
    } else if ($isLoggedIn) {
        $user = getUserDetails($conn, $userId);
    }

    include 'includes/header.php'; 

    $products = getProducts();
    $towns = getTowns($conn);

?>


    <div class="account-container">
        <?php if (isset($_SESSION['displayState']) && $_SESSION['displayState'] === 'profile' && $isLoggedIn): 
            // Fetch user details from the database
            $userId = $_SESSION['userId'];
            $user = getUserDetails($conn, $userId);
            
            echo "<h2>User Profile</h2>" . "<br>";
            echo "Username: " . htmlspecialchars($user['username']) . "<br>" . "<br>";
            echo "Name: " . htmlspecialchars($user['firstName']) . " " . htmlspecialchars($user['lastName']) . "<br>" . "<br>";
            echo "Email: " . htmlspecialchars($user['email']) . "<br>" . "<br>";
            echo "Address: " . htmlspecialchars($user['houseNameNum']) . ", " . 
                htmlspecialchars($user['street']) . ", " . htmlspecialchars($user['townName']) . 
                ", " . htmlspecialchars($user['postCode']) . "<br>" . "<br>";
            
            // Button to view order history
            ?>
            <form action="account.php" method="post">
                <input type="hidden" name="toggleView" value="viewOrders">
                <button type="submit" class="btn btn-secondary">View Order History</button>
                <br>
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        <?php elseif (isset($_SESSION['displayState']) && $_SESSION['displayState'] === 'orders' && $isLoggedIn): 
            // Fetch order history
            $orderHistory = getOrderHistory($conn, $userId);

            if (count($orderHistory) > 0): ?>
                <h2>Order History</h2>
                <table class="table">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach ($orderHistory as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['orderDate']); ?></td>
                            <td><?php echo htmlspecialchars($order['totalPrice']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No order history found.</p>
            <?php endif; ?>

            <!-- Button to go back to profile -->
            <form action="account.php" method="post">
                <input type="hidden" name="toggleView" value="viewProfile">
                <button type="submit" class="btn btn-primary">Back to Profile</button>
            </form>
            <br>
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
                        <form action="handlers/handleAcc.php" method="post">
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