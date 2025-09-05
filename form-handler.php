<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = htmlspecialchars($_POST['name']);
    $mobile   = htmlspecialchars($_POST['mobile']);
    $email    = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'Not Provided';
    $formName = isset($_POST['form_name']) ? htmlspecialchars($_POST['form_name']) : 'General Enquiry';

    $mail = new PHPMailer(true);
      try {
        // Server settings  
    $mail->SMTPDebug = 0; // change to 2 if you want detailed logs
    $mail->Debugoutput = 'html';
    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hello@ekroof.com';
        $mail->Password   = '8ytBAdVW#rm3bCat&Wmq#)s#';  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or 'ssl'
    $mail->Port       = 587; // or 465 if ssl

    $mail->setFrom('hello@ekroof.com', 'Website Enquiry');
    $mail->addAddress('bitkittu@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = "New Enquiry from " . $formName;
    
        $mail->Body    = "
            <h3>New Enquiry Received</h3>
            <p><b>Name:</b> $name</p>
            <p><b>Mobile:</b> $mobile</p>
            <p><b>Email:</b> $email</p>
            <p><b>Form Source:</b> $formName</p>
        ";

        $mail->send();
        header("Location: thank-you.html");
        exit();
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
