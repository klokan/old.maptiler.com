<?php
/*
Credits: Bit Repository
URL: http:/w/ww.bitrepository.com/
 */

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
    include 'functions.php';

    $name = stripslashes($_POST['name']);
    $email = trim($_POST['email']);
    $company = stripslashes($_POST['company']);
    $address = stripslashes($_POST['address']);
    $operatingsystem = stripslashes($_POST['operatingsystem']);

    $error = '';

    // Check name
    if(!$name) { $error .= 'Please enter your name.<br />'; }

    // Check email
    if(!$email) { $error .= 'Please enter an e-mail address.<br />'; }
    if($email && !ValidateEmail($email)) { $error .= 'Please enter a valid e-mail address.<br />'; }
    
    // Check company
    if(!$company) { $error .= 'Please enter your company name.<br />'; }

    // Check message (length)
    if(!$address || strlen($address) < 15) { $error .= "Please enter your address. It should have at least 15 characters.<br />"; }

    if(!$error)
    {
        include("class.phpmailer.php");

        $mail = new PHPMailer();
        $email_address = $mail->SecureHeader($_POST['frommail']);

        $mail->CharSet = "utf-8";
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port
        $mail->Username   = "info@klokantech.com"; // GMAIL username
        $mail->Password   = "";           // GMAIL password

        $mail->SetFrom("info@klokantech.com");
        $mail->AddReplyTo($email, $name);
        //$mail->AddAddress("info@klokantech.com", "Klokantech");
        $mail->AddAddress("robert@solarik.com", "Robert Solarik");

        $mail->Subject = "Contact from the web form - " . $name . " " . $company;

        $mail->Body = "Operating system: " . $operatingsystem . "\n\n" . $address;
        
        if(!$mail->Send())
        {
            echo '<div class="alert error hideit"><i class="icon-warning-sign"></i>'.$mail->ErrorInfo.'</div>';
        }
        else
        {
            echo '<div class="alert success hideit"><i class="icon-check"></i>Message sent!</div>';
        }
    }
    else
    {
        echo '<div class="alert error hideit"><i class="icon-warning-sign"></i>'.$error.'</div>';
    }
}
?>