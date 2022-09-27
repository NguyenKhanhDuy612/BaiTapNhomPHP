<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__.'/../config/config.php');
require_once(ROOT.'include/PHPMailer/src/Exception.php');
require_once(ROOT.'include/PHPMailer/src/PHPMailer.php');
require_once(ROOT.'include/PHPMailer/src/SMTP.php');

function guiMail($mailTo, $subject, $body)
{
    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = 465;

    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'webbantraicay@gmail.com';

    //Password to use for SMTP authentication
    $mail->Password = 'dungdoimatkhau'; // pwease uwu

    $mail->CharSet = 'utf-8';

    //Set who the message is to be sent from
    //Note that with gmail you can only use your account address (same as `Username`)
    //or predefined aliases that you have configured within your account.
    //Do not use user-submitted addresses in here
    $mail->setLanguage('vi');
    $mail->setFrom('webbantraicay@gmail.com', 'Web bán trái cây');

    //Set an alternative reply-to address
    //This is a good place to put user-submitted addresses
    //$mail->addReplyTo('example@gmail.com', 'name');

    //Set who the message is to be sent to
    $mail->addAddress($mailTo);

    //Set the subject line
    $mail->Subject = $subject;

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->Body = $body;

    //Replace the plain text body with one created manually
    //$mail->AltBody = '';

    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    } else {
        //echo 'Message sent!';
        return true;
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}

// ẩn email
function maskEmail($email, $minLength = 3, $maxLength = 10, $mask = "***") {
    $atPos = strrpos($email, "@");
    $name = substr($email, 0, $atPos);
    $len = strlen($name);
    $domain = substr($email, $atPos);

    if (($len / 2) < $maxLength) $maxLength = ($len / 2);

    $shortenedEmail = (($len > $minLength) ? substr($name, 0, $maxLength) : "");
    return  "{$shortenedEmail}{$mask}{$domain}";
}