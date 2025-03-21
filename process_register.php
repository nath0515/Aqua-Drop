<?php 
	require ('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    try{
        if($password == $confirmPassword){
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $sqlcheck = "SELECT * FROM users WHERE username = :username";
            $stmt = $conn->prepare($sqlcheck);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header("Location: register.php?status=exist");
                exit();
            } 
            else {
                $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password_hashed);
                $stmt->execute();

                $last_id = $conn->lastInsertId();

                $sql1 = "INSERT INTO userdetails (userid, role_id, email, firstname, lastname, address) VALUES (:userid, 2, :email, :firstname, :lastname, :address)";
                $stmt = $conn->prepare($sql1);
                $stmt->bindParam(':userid', $last_id);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':address', $address);
                $stmt->execute();

                header("Location: register.php?status=success");
                exit();
            }
        }
        else{
            header("Location: register.php?status=xmatch");
            exit();
        }
    }
    catch (PDOException $e) {
        header("Location: register.php?status=error");
        exit();
    }
}
?>