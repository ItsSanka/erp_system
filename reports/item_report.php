<?php include('../includes/database.php'); ?>
<?php include('../includes/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Report</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Item Report</h2>

    <?php
    $query = $conn->query("SELECT item_name, item_category, item_sub_category, SUM(quantity) AS total_quantity FROM items GROUP BY item_name");

    if ($query->num_rows > 0) {
        echo "<table class='table table-striped'>
                <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Total Quantity</th>
                </tr>
                </thead>
                <tbody>";

        while ($row = $query->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['item_name']}</td>
                    <td>{$row['item_category']}</td>
                    <td>{$row['item_sub_category']}</td>
                    <td>{$row['total_quantity']}</td>
                </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-warning'>No items found.</div>";
    }
    ?>
</div>
</body>
</html>
