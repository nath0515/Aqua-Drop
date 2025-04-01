<?php 

    require ('session.php');
	require ('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $type_id = $_POST['type_id'];
    $quantity = $_POST['quantity'];

    try{
        $sql_insert = "INSERT INTO orders (name, contact_number, address, type_id,quantity, status_id) VALUES ('Walk-In', 'Unknown','Unknown',:type_id, :quantity, 4)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(':type_id', $type_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();

        header("Location: sales.php?status=success");
        exit();
        
    
    }
    catch (PDOException $e) {
        header("Location: sales.php?status=error");
        exit();
    }
}
?>