<?php
// Include your database connection
require ('db.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database and if the email is not already verified
    $sql = "SELECT * FROM users WHERE verification_token = :token AND email_verified = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Token exists and the user is not verified, update their email_verified status
        $sql_update = "UPDATE users SET email_verified = 1, verification_token = NULL WHERE verification_token = :token";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':token', $token);
        $stmt_update->execute();

        echo "Your email has been successfully verified! You can now <a href='login.php'>login</a>.";
    } else {
        echo "Invalid or expired verification link.";
    }
} else {
    echo "No verification token provided.";
}
?>
