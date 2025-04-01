<?php
    require('db.php');

    if (isset($_POST['type_id'])) {
        $type_id = $_POST['type_id'];

        $sql = "SELECT * FROM type WHERE type_id = :type_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':type_id', $type_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $item = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($item);
        } else {
            echo json_encode(['error' => 'Item not found.']);
        }
    }
?>