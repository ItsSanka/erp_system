<?php include('includes/database.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP Dashboard</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">ERP System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="customers/index.php">Manage Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="items/index.php">Manage Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports/invoice_report.php">Invoice Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports/item_report.php">Item Report</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container dashboard-container">
    <h1 class="dashboard-header">ERP System Dashboard</h1>
    <div class="row">
 
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-users fa-3x mb-3" style="color: #007bff;"></i>
                    <h5 class="card-title">Customer Management</h5>
                    <p class="card-text">Add, update, and delete customer details.</p>
                    <a href="customers/index.php" class="btn">Manage Customers</a>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-boxes fa-3x mb-3" style="color: #007bff;"></i>
                    <h5 class="card-title">Item Management</h5>
                    <p class="card-text">Manage items in your inventory.</p>
                    <a href="items/index.php" class="btn">Manage Items</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-file-alt fa-3x mb-3" style="color: #007bff;"></i>
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">Generate reports based on invoices and items.</p>
                    <a href="reports/invoice_report.php" class="btn">Invoice Report</a><br>
                    <a href="reports/item_report.php" class="btn mt-2">Item Report</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
