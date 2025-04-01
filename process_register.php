<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer autoload

require ('db.php'); // Include your DB connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    try {
        // Check if passwords match
        if ($password == $confirmPassword) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Check if username already exists
            $sqlcheck = "SELECT * FROM users WHERE username = :username";
            $stmt = $conn->prepare($sqlcheck);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header("Location: register.php?status=exist");
                exit();
            } else {
                // Generate a unique verification token
                $verification_token = bin2hex(random_bytes(16)); // 32 characters long token

                // Insert user into the users table
                $sql = "INSERT INTO users (username, password, verification_token) VALUES (:username, :password, :verification_token)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password_hashed);
                $stmt->bindParam(':verification_token', $verification_token);
                $stmt->execute();

                $last_id = $conn->lastInsertId();

                // Insert user details into the userdetails table
                $sql1 = "INSERT INTO userdetails (userid, role_id, email, firstname, lastname, address) 
                         VALUES (:userid, 2, :email, :firstname, :lastname, :address)";
                $stmt = $conn->prepare($sql1);
                $stmt->bindParam(':userid', $last_id);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':address', $address);
                $stmt->execute();

                // Send the verification email
                $mailsent= sendVerificationEmail($email, $verification_token);

                if ($mailsent){
                    header("Location: register.php?status=success");
                    exit();
                }
                else{
                    header("Location: register.php?status=error");
                    exit();
                }
                
            }
        } else {
            header("Location: register.php?status=xmatch");
            exit();
        }
    } catch (PDOException $e) {
        // If an error occurs
        header("Location: register.php?status=error");
        exit();
    }
}

// Function to send the verification email using PHPMailer
function sendVerificationEmail($email, $verification_token) {
    $mail = new PHPMailer(true);
    try {
        // Set up PHPMailer
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'system.aquadrop@gmail.com'; // Your Gmail address
        $mail->Password = 'nasv xpiv whcv zuzd'; // Your Gmail password or App password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPDebug = 2;

        $mail->setFrom('system.aquadrop@gmail.com', 'aqua drop');
        $mail->addAddress($email); // Recipient's email address

        // Content of the email
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = "Hi,<br><br>Click the link below to verify your email address:<br><br>
                       <a href='http://localhost/Aqua-Drop/verify_email.php?token=$verification_token'>Verify Email</a><br><br>Thank you.";

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>
