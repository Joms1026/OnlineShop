<?php

include(__DIR__."/mailer/Exception.php");
include(__DIR__."/mailer/SMTP.php");
include(__DIR__."/mailer/PHPMailer.php");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// register.php
// --- include database.php
// ------  $db
// --- include function.php (file ini)
// ------ $db => global variable!
// ------ uniqueCodeEmail()
// ------ => 2 cara, 1 uniqueCodeEmail($db);
//        => global $db

function generateCode($panjang) {
    $result     = "";
    $dictionary = array_merge(range(1,9), range("a", "z"));

    // Ambil sejumlah kebutuhan dari user!
    for ($i = 0; $i < $panjang; $i++) { 
        $result .= $dictionary[mt_rand(0, count($dictionary) - 1)];
    }

    return $result;
}

function uniqueCodeEmail() {
    // @see https://www.php.net/manual/en/language.variables.scope.php
    /** @var PDO $db Autocomplete PDO */
    global $db;
    $count = 1;

    $result = "";

    do {
        $result = generateCode(20);
        $query = "SELECT COUNT(*) as jumlah FROM confirm_email WHERE code = '$result'";
        $count = $db->query($query)->fetch(PDO::FETCH_ASSOC)["jumlah"];
    } while ($count > 0);

    return $result;
}

function sendEmail($to, $subject, $body) {
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.zoho.com';                    // Set the SMTP server to send through smtp.gmail.com:587 => port
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'test@benyamin.xyz';                     // SMTP username
        $mail->Password   = 'testmail123';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('test@benyamin.xyz', 'Mailer Test');
        $mail->addAddress($to, 'User');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}