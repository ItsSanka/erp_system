<?php
include('../includes/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];


    $query = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
    $query->bind_param('i', $customer_id);


    if ($query->execute()) {

        $_SESSION['message'] = "Customer deleted successfully.";
        

        header("Location: index.php");
        exit();
    } else {
 
        $_SESSION['message'] = "Error deleting customer: " . $query->error;
        

        header("Location: index.php");
        exit();
    }
}
?>
