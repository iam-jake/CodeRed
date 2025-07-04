<?php

@include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer-master/src/Exception.php';
require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';

if(isset($_POST['send'])){
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    // Assuming $conn is your database connection
    $stmt = $conn->prepare("SELECT email FROM account WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind email only for the query
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if ($email === $row['email']) {
    $mail= new PHPMailer(true);
    
    
    // Server settings
    $mail->SMTPDebug = '2'; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username='codered4314@gmail.com';
    $mail->Password='jyve uoch bfsm kjum';
    
    /*
    // Sender and recipient settings
    $mail->setFrom('example@gmail.com', 'Sender Name');
    $mail->addAddress('codered4314@gmail.com', 'Receiver Name');
    $mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
    $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    $mail->send();
    echo "Email message sent.";
    */
    
    $mail->setFrom('codered4314@gmail.com', 'Code RED');
    //$mail->addAddress('codered4314@gmail.com', 'You');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    
    $mail->Subject="Reset Password";
    $mail->Body = "Hello, Click this link to continue the process of resetting your password 
    <a href='https://codered.click/Reset_Password.php?email=$email'>Reset Password</a>.";
    header('Location: index.php');
    $mail->send();
    $email= $_SESSION['email'];
    
    echo "sent successfully";
    return true;
} else{
    header('Location: Forgot_password.php');
    $error[]="invalid Email Address";
}
}
}

?>