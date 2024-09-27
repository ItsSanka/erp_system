<?php
session_start();
include('../includes/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];


    $query = $conn->prepare("DELETE FROM items WHERE item_id = ?");
    $query->bind_param('i', $item_id);


    if ($query->execute()) {
        $_SESSION['message'] = "Item deleted successfully.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = "Error deleting item: " . $query->error;
        header("Location: index.php");
        exit();
    }
}
?>
