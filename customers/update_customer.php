<?php include('../includes/database.php'); ?>
<?php include('../includes/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Customer</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Update Customer</h2>

    <?php
    if (isset($_GET['id'])) {
        $customer_id = $_GET['id'];

        $query = $conn->prepare("SELECT * FROM customers WHERE customer_id = ?");
        $query->bind_param('i', $customer_id);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
            ?>

            <form method="POST" action="update_customer.php?id=<?php echo $customer_id; ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <select class="form-control" name="title" required>
                        <option value="Mr" <?php if($customer['title'] == 'Mr') echo 'selected'; ?>>Mr</option>
                        <option value="Mrs" <?php if($customer['title'] == 'Mrs') echo 'selected'; ?>>Mrs</option>
                        <option value="Miss" <?php if($customer['title'] == 'Miss') echo 'selected'; ?>>Miss</option>
                        <option value="Dr" <?php if($customer['title'] == 'Dr') echo 'selected'; ?>>Dr</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo $customer['first_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo $customer['last_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" class="form-control" name="contact_number" value="<?php echo $customer['contact_number']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control" name="district" value="<?php echo $customer['district']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Customer</button>
            </form>

            <?php
        } else {
            echo "<div class='alert alert-danger'>Customer not found.</div>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $district = $_POST['district'];

        $update_query = $conn->prepare("UPDATE customers SET title = ?, first_name = ?, last_name = ?, contact_number = ?, district = ? WHERE customer_id = ?");
        $update_query->bind_param('sssssi', $title, $first_name, $last_name, $contact_number, $district, $customer_id);
        if ($update_query->execute()) {
            echo "<div class='alert alert-success'>Customer updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating customer: " . $update_query->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
