<?php
    require_once "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;

    function SendMail($subject,$message){

        $mail = new PHPMailer; //From email address and name 
        $mail->From = "kenprogrammer@yahoo.com"; 
        $mail->FromName = "Inventory Software"; //To address and name 
        $mail->addAddress("doreentiema87@gmail.com", "Doreen Tiema");//Recipient name is optional
        //$mail->addReplyTo("reply@yourdomain.com", "Reply"); //CC and BCC 
        $mail->addCC("kenprogrammer@gmail.com"); 
        //$mail->addBCC("bcc@example.com"); //Send HTML or Plain Text email 
        $mail->isHTML(true); 
        $mail->Subject =$subject; 
        $mail->Body = $message;
        $mail->AltBody = "This is the plain text version of the email content"; 
        if(!$mail->send()) {
            errorLog("Mailer Error: " . $mail->ErrorInfo);
            return false;
        } else { 
            errorLog("Message has been sent successfully");
            return true;
        }
    }

    function errorLog($error){
        $myfile = fopen("logs.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $error);
        fclose($myfile);
    }