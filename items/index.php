<?php
session_start();
include('../includes/database.php');
include('../includes/navbar.php');

$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search_term'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Items List</h2>
    
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-info'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']); 
    }
    ?>


    <form method="POST" class="mb-3">
        <div class="input-group">
            <input type="text" name="search_term" class="form-control" placeholder="Search by item name or code" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <div class="input-group-append">
                <button type="submit" name="search" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <a href="add.php" class="btn btn-success">Add New Item</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Actions</th> 
        </tr>
        </thead>
        <tbody>
        <?php

        $query = "SELECT * FROM items";
        if ($searchTerm) {
            $query .= " WHERE item_name LIKE ? OR item_code LIKE ?";
        }
        $stmt = $conn->prepare($query);
        
        if ($searchTerm) {
            $searchWildcard = '%' . $searchTerm . '%';
            $stmt->bind_param('ss', $searchWildcard, $searchWildcard);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['item_id']}</td>
                    <td>{$row['item_code']}</td>
                    <td>{$row['item_name']}</td>
                    <td>{$row['item_category']}</td>
                    <td>{$row['item_sub_category']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['unit_price']}</td>
                    <td>
                        <a href='update_item.php?id={$row['item_id']}' class='btn btn-primary'>Update</a>
                        <form action='delete_item.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='item_id' value='{$row['item_id']}'>
                            <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</button>
                        </form>
                    </td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
