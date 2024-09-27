<?php include('../includes/database.php'); ?>
<?php include('../includes/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Add New Customer</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $district = $_POST['district'];

        // Validation
        if (!empty($first_name) && !empty($last_name) && !empty($contact_number)) {
            $stmt = $conn->prepare("INSERT INTO customers (title, first_name, last_name, contact_number, district) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $title, $first_name, $last_name, $contact_number, $district);
            $stmt->execute();

            echo "<div class='alert alert-success'>Customer added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>All fields are required!</div>";
        }
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <select name="title" class="form-control" required>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Miss">Miss</option>
                <option value="Dr">Dr</option>
            </select>
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" required>
        </div>
        <div class="form-group">
            <label for="district">District</label>
            <input type="text" class="form-control" name="district" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>
</div>
</body>
</html>
