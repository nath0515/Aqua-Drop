<?php 

    require ('session.php');
	require ('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $expense = $_POST['expense'];
    $purpose = $_POST['purpose'];
    $amount = $_POST['amount'];

    try{
        $sql_insert = "INSERT INTO expenses (expense, purpose, amount) VALUES (:expense, :purpose, :amount)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(':expense', $expense);
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