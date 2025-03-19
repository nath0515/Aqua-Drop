<?php
require ('db.php');
require ('session.php');

$user_id = $_GET['id'];

$sql = "SELECT status_id FROM orders WHERE order_id = :order_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    echo json_encode([
        'status_id' => $row['status_id']
    ]);
} else {
    echo json_encode(['error' => 'User not found']);
}

$stmt->closeCursor();
?>
