<?php 

    require ('session.php');
	require ('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $expenses_id = $_POST['expenses_id'];
    $purpose = $_POST['purpose'];
    $amount = $_POST['amount'];

    try{
        $sql_insert = "INSERT INTO expenses (expenses_id, purpose, amount) VALUES (:expenses_id, :purpose, :amount)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(':expenses_id', $expenses_id);
        $stmt->bindParam(':purpose', $purpose);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();

        header("Location: expenses.php?status=success");
        exit();
        
    
    }
    catch (PDOException $e) {
        header("Location: expenses.php?status=error");
        exit();
    }
}
?>