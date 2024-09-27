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
    <title>Customers List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Customers List</h2>
    

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-info'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']); 
    }
    ?>


    <form method="POST" class="mb-3">
        <div class="input-group">
            <input type="text" name="search_term" class="form-control" placeholder="Search by name" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <div class="input-group-append">
                <button type="submit" name="search" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <a href="add.php" class="btn btn-success">Add New Customer</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>District</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
   
        $query = "SELECT * FROM customers";
        if ($searchTerm) {
            $query .= " WHERE first_name LIKE ? OR last_name LIKE ? OR contact_number LIKE ?";
        }
        $stmt = $conn->prepare($query);
        
        if ($searchTerm) {
            $searchWildcard = '%' . $searchTerm . '%';
            $stmt->bind_param('sss', $searchWildcard, $searchWildcard, $searchWildcard);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['customer_id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['contact_number']}</td>
                    <td>{$row['district']}</td>
                    <td>
                        <a href='update_customer.php?id={$row['customer_id']}' class='btn btn-primary'>Update</a>
                        <form action='delete_customer.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='customer_id' value='{$row['customer_id']}'>
                            <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this customer?\");'>Delete</button>
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
