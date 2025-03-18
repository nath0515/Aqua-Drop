<?php
include 'db_connect.php';

// Get order ID from URL
$id = $_GET['id'];
$query = "SELECT * FROM orders WHERE id = $id";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Update order when form is submitted
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $rider = $_POST['rider'];

    $updateQuery = "UPDATE orders SET 
        name='$name', contact='$contact', address='$address',
        date='$date', quantity='$quantity', type='$type',
        status='$status', rider='$rider' 
        WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Order updated successfully!'); window.location='orders.php';</script>";
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
</head>
<body>
    <h2>Edit Order</h2>
    <form method="post">
        Name: <input type="text" name="name" value="<?= $order['name'] ?>" required><br>
        Contact: <input type="text" name="contact" value="<?= $order['contact'] ?>" required><br>
        Address: <input type="text" name="address" value="<?= $order['address'] ?>" required><br>
        Date: <input type="date" name="date" value="<?= $order['date'] ?>" required><br>
        Quantity: <input type="number" name="quantity" value="<?= $order['quantity'] ?>" required><br>
        Type: <input type="text" name="type" value="<?= $order['type'] ?>" required><br>
        Status: 
        <select name="status">
            <option <?= ($order['status'] == 'New') ? 'selected' : '' ?>>New</option>
            <option <?= ($order['status'] == 'Enroute') ? 'selected' : '' ?>>Enroute</option>
            <option <?= ($order['status'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
        </select><br>
        Rider: <input type="text" name="rider" value="<?= $order['rider'] ?>" required><br>

        <button type="submit" name="update">Update Order</button>
        <a href="orders.php">Cancel</a>
    </form>
</body>
</html>
