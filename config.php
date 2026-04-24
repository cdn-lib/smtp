<?php
define('SMTP_HOST',       'smtp.gmail.com');
define('SMTP_PORT',       465);
define('SMTP_USERNAME',   'your-email@gmail.com');       
define('SMTP_PASSWORD',   'your-app-password');          
define('SMTP_FROM_NAME',  'Your Company Name');          
define('SMTP_ENCRYPTION', 'ssl');                        
define('ADMIN_EMAIL',     'admin@yourcompany.com');

define('SITE_NAME',       'Your Company');
define('SITE_URL',        'https://yourcompany.com');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';

function createMailer(): PHPMailer
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->Host       = SMTP_HOST;
    $mail->Port       = SMTP_PORT;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = (SMTP_ENCRYPTION === 'ssl')
        ? PHPMailer::ENCRYPTION_SMTPS
        : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->CharSet    = 'UTF-8';
    $mail->setFrom(SMTP_USERNAME, SMTP_FROM_NAME);
    return $mail;
}
