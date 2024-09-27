<?php include('../includes/navbar.php'); ?>
<?php
session_start();
include('../includes/database.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_sub_category = $_POST['item_sub_category'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $query = $conn->prepare("UPDATE items SET item_code=?, item_name=?, item_category=?, item_sub_category=?, quantity=?, unit_price=? WHERE item_id=?");
    $query->bind_param('ssssssi', $item_code, $item_name, $item_category, $item_sub_category, $quantity, $unit_price, $item_id);
    
    if ($query->execute()) {
        $_SESSION['message'] = "Item updated successfully.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating item: " . $query->error;
        header("Location: index.php");
        exit();
    }
}


if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM items WHERE item_id=?");
    $stmt->bind_param('i', $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Item</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Update Item</h2>
    <form method="POST">
        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
        <div class="form-group">
            <label for="item_code">Item Code</label>
            <input type="text" class="form-control" name="item_code" value="<?php echo $item['item_code']; ?>" required>
        </div>
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" name="item_name" value="<?php echo $item['item_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="item_category">Item Category</label>
            <input type="text" class="form-control" name="item_category" value="<?php echo $item['item_category']; ?>" required>
        </div>
        <div class="form-group">
            <label for="item_sub_category">Item Sub Category</label>
            <input type="text" class="form-control" name="item_sub_category" value="<?php echo $item['item_sub_category']; ?>" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" value="<?php echo $item['quantity']; ?>" required>
        </div>
        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="text" class="form-control" name="unit_price" value="<?php echo $item['unit_price']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update Item</button>
    </form>
</div>
</body>
</html>
