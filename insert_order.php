<?php
require('db.php');
require('session.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get and sanitize inputs
        $type_id = intval($_POST['type_id']); // Type of order
        $quantity = intval($_POST['quantity']); // Quantity of items
        $total = floatval($_POST['total']); // Payment/Total amount
        $user_id = $_SESSION['user_id']; // Get user ID from session

        // ✅ Get user details using PDO with JOIN to get username and address
        $stmt_user = $conn->prepare("
            SELECT u.username, ud.address 
            FROM users u
            JOIN userdetails ud ON u.id = ud.userid
            WHERE u.id = :user_id
        ");
        $stmt_user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_user->execute();

        // ✅ Fetch user details
        $user_data = $stmt_user->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists
        if ($user_data) {
            $username = htmlspecialchars($user_data['username']);
            $address = htmlspecialchars($user_data['address']);
        } else {
            echo "error_user"; // If no user found
            exit();
        }

        // ✅ Insert order into the database
        $stmt_order = $conn->prepare("
            INSERT INTO orders 
            (user_id, name, address, date, quantity, type_id, payment, status_id, rider) 
            VALUES 
            (:user_id, :name, :address, NOW(), :quantity, :type_id, :payment, 1, 1)
        ");

        // ✅ Bind parameters to the insert query
        $stmt_order->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_order->bindParam(':name', $username, PDO::PARAM_STR);
        $stmt_order->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt_order->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt_order->bindParam(':type_id', $type_id, PDO::PARAM_INT);
        $stmt_order->bindParam(':payment', $total, PDO::PARAM_STR);

        // ✅ Execute the insert query
        if ($stmt_order->execute()) {
            echo "success"; // Order placed successfully
        } else {
            echo "error_order"; // Order insert error
        }
    } catch (PDOException $e) {
        // Handle any PDO exceptions
        echo "Error: " . $e->getMessage();
    }
}
?>
