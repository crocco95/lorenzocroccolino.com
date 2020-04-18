<?php

$company_name = $_POST['company-name'];
$email = $_POST['email'];
$message = $_POST['message'];
$message .= "<br/><br/>";
$my_email = 'from-my-website@lorenzocroccolino.com';

//Initial response is NULL
$response = null;

if (isset($_POST["email"]) && !empty($_POST["email"])) {

        $response = (SendEmail($message, $subject], $company_name, $email, $my_email)) ? 'Messaggio inviato con successo' : "Errore durante l'invio del messaggio";
    } else {
        $response = "Errore durante l'invio del messaggio";
    }

if (isset($response) && !empty($response) && !is_null($response)) {
    echo '{"ResponseData":' . json_encode($response) . '}';
}

function SendEmail($message, $subject, $name, $from, $to) {
    $isSent = false;
    // Content-type header
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Additional headers
    $headers .= 'From: ' . $name .'<'.$from .'>';

    mail($to, $subject, $message, $headers);
    if (mail) {
        $isSent = true;
    }
    return $isSent;
}

?>
