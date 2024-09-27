<?php include('../includes/database.php'); ?>
<?php include('../includes/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Report</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Invoice Report</h2>

    <form method="POST">
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <br>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];


        echo "<div>Start Date: $start_date, End Date: $end_date</div>";

  
        $query = $conn->prepare("
            SELECT invoices.invoice_id, invoices.invoice_date, 
                   customers.first_name, customers.last_name, 
                   customers.district, COUNT(invoice_items.item_id) AS item_count, 
                   invoices.total_amount 
            FROM invoices 
            JOIN customers ON invoices.customer_id = customers.customer_id 
            JOIN invoice_items ON invoices.invoice_id = invoice_items.invoice_id 
            WHERE invoices.invoice_date BETWEEN ? AND ? 
            GROUP BY invoices.invoice_id
        ");
        
     
        $query->bind_param('ss', $start_date, $end_date);


        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>
                    <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Invoice Date</th>
                        <th>Customer Name</th>
                        <th>Customer District</th>
                        <th>Item Count</th>
                        <th>Invoice Amount</th>
                    </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['invoice_id']}</td>
                        <td>{$row['invoice_date']}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['district']}</td>
                        <td>{$row['item_count']}</td>
                        <td>{$row['total_amount']}</td>
                    </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>No invoices found in the selected date range.</div>";
        }
    }
    ?>
</div>
</body>
</html>
