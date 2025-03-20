<?php 

    require ('session.php');
	require ('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $status_id = $_POST['status_id'];
    $order_id = $_POST['order_id'];

    try{
        $sql_insert = "UPDATE orders SET status_id = :status_id WHERE order_id = :order_id";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        header("Location: orders.php?status=success");
        exit();
        
    
    }
    catch (PDOException $e) {
        header("Location: orders.php?status=error");
        exit();
    }
}
?>