<?php include 'includes/header.php'; ?>

<?php
    // Check if the 'type' and 'brand' query parameters are set
    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $brand = isset($_GET['brand']) ? $_GET['brand'] : null;

    // Now you can use $type and $brand to change your header content dynamically
?>

<!-- Example: Changing the page title dynamically -->
<title>
    <?php echo ucfirst($brand) . " " . ucfirst($type); ?> - RetroArc
</title>

<div class="content">
    <?php if($type && $brand): ?>
        <h1><?php echo ucfirst($brand) . " " . ucfirst($type); ?></h1>
        <!-- Your content for the specific brand and type goes here -->
    <?php else: ?>
        <!-- Default content if no type/brand is selected -->
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>