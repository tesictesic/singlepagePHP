<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require "../php mailer/src/Exception.php";
require "../php mailer/src/PHPMailer.php";
require "../php mailer/src/SMTP.php";
class Mail
{
    public static function sendMail($userEmail, $subject, $body)
    {
        $mail = new PHPMailer(true);
        try {//Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false,
                'allow_self_signed' => true));
            $mail->CharSet = 'utf-8';
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //'smtp.example.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            /* ********** Kredencijali email adrese sa kojeg se šalje email ********** */
            $mail->Username = 'djordje.tesic.59.21@ict.edu.rs'; //SMTP username
            $mail->Password = 'eyu4Msn1'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set
            `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`;
//Recipients
$mail->setFrom('from@example.com', 'Test Test');
/* ********** Email adresa/e korisnika kome se šalje email ********** */
$mail->addAddress($userEmail, 'Admin'); //Add a recipient
//$mail->addAddress('ellen@example.com'); //Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name
//Content
$mail->isHTML(true); //Set email format to HTML
$mail->Subject = $subject;
$mail->Body =" $body <hr/>
Odgovoriti na email: $userEmail.
";
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->send();
return 'Message has been sent';
} catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}