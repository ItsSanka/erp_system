<?php include('../includes/database.php'); ?>
<?php include('../includes/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Add New Item</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $item_code = $_POST['item_code'];
        $item_name = $_POST['item_name'];
        $item_category = $_POST['item_category'];
        $item_sub_category = $_POST['item_sub_category'];
        $quantity = $_POST['quantity'];
        $unit_price = $_POST['unit_price'];

        if (!empty($item_code) && !empty($item_name) && !empty($quantity) && !empty($unit_price)) {
            $stmt = $conn->prepare("INSERT INTO items (item_code, item_name, item_category, item_sub_category, quantity, unit_price) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssii', $item_code, $item_name, $item_category, $item_sub_category, $quantity, $unit_price);
            $stmt->execute();

            echo "<div class='alert alert-success'>Item added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>All fields are required!</div>";
        }
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <label for="item_code">Item Code</label>
            <input type="text" class="form-control" name="item_code" required>
        </div>
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" name="item_name" required>
        </div>
        <div class="form-group">
            <label for="item_category">Item Category</label>
            <input type="text" class="form-control" name="item_category" required>
        </div>
        <div class="form-group">
            <label for="item_sub_category">Item Sub-Category</label>
            <input type="text" class="form-control" name="item_sub_category" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="number" class="form-control" name="unit_price" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>
</body>
</html>
