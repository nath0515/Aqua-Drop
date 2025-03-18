<?php
include 'db_connect.php';

$id = $_GET['id'];

$query = "DELETE FROM orders WHERE id=$id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Order deleted successfully!'); window.location='orders.php';</script>";
} else {
    echo "Error deleting order: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
