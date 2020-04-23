<?php

  /**
  * A simple home-made script to send email from a contact form to my personal
  * email, nothing special.
  */

  // A simple hand-made wrapper to send a email
  function SendEmail($message, $subject, $name, $from, $to) {

      // Result variable
      $isSent = false;

      // Content-type header
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      // Additional headers
      $headers .= 'From: Form dei contatti sito web' .'<'.$from .'>';

      // #sendit :)
      $isSent = mail($to, $subject, $message, $headers);

      // Return the result
      return $isSent;
  }

  // The company name submitted by user
  $company_name = $_POST['company-name'];

  // The email address submitted by user
  $email = $_POST['email'];

  // I put the company name and the mail directly in the message body 'couse if
  // I will put them in 'From' header, the mail will go in the spam folder
  $message .= 'Company employ email: ' . $email . '<br/>';
  $message .= 'Company name: ' . $company_name;
  $message .= '<br/><br/>';

  // The message submitted by user
  $message = $_POST['message'];

  // The mail that will receive the message
  $my_email = 'hello@lorenzocroccolino.com';

  // That mail does not exists, it's useful just becaouse the domain will be
  // trusted by my mail provider
  $my_fake_mail = 'website-contact@lorenzocroccolino.com';

  // A simple subject easy to see
  $subject = '==> Email da sito web personale';

  //Initial response is NULL
  $response = null;

  // Check if the mail field exists and is not empty
  if (isset($_POST['email']) && !empty($_POST['email'])) {

    // Try to send mail
    $response = (SendEmail($message, $subject, $company_name, $my_fake_mail, $my_email)) ? 'Messaggio inviato con successo' : 'Errore durante l\'invio del messaggio';
  } else {

    // If there is not mail field, I can't responde you so..
    $response = 'Errore durante l\'invio del messaggio';
  }

  // Compose the message in anyway in json format
  if (isset($response) && !empty($response) && !is_null($response)) {

    // Save the response in session and return to homepage, someone will catch it
    $_SESSION['email-callback'] = '{ResponseData:' . json_encode($response) . '}';
    header('Location: /');
    exit();
  }
?>
