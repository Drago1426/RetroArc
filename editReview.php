<?php
require_once 'includes/dbh.php';
require_once 'includes/functionsDb.php';

session_start();

// Redirect if not logged in or no reviewId is provided
if (!isset($_SESSION['userId']) || !isset($_GET['reviewId'])) {
    header('Location: login.php');
    exit();
}

$reviewId = $_GET['reviewId'];
$userId = $_SESSION['userId'];

// Fetch the review
$review = getReviewById($conn, $reviewId);

// Check if the logged-in user owns the review
if (!$review || $review['userId'] != $userId) {
    echo "You do not have permission to edit this review.";
    exit();
}

include 'includes/header.php';
?>

<div class="account-container">
    </br>
    <h1>Edit Review</h1>
    <form action="updateReviewHandler.php" method="post">
        <input type="hidden" name="reviewId" value="<?php echo htmlspecialchars($review['id']); ?>">

        <div class="form-field">
            <label for="review">Your Review:</label>
            <textarea id="review" name="review" required><?php echo htmlspecialchars($review['review']); ?></textarea>
        </div>

        <div class="form-field">
            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <!-- Generate options for rating -->
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo ($i == $review['starRate']) ? 'selected' : ''; ?>>
                        <?php echo $i; ?> Star<?php echo $i > 1 ? 's' : ''; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="form-main">
            <button type="submit" name="submit" class="btn btn-primary">Update Review</button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
