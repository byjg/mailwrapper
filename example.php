<?php

require "vendor/autoload.php";

// Create a connection URL (see below)
\ByJG\Mail\MailerFactory::registerMailer('tls', \ByJG\Mail\Wrapper\PHPMailerWrapper::class);

$mailer = \ByJG\Mail\MailerFactory::create('protocol://username:password/smtpserver:port');

// Create the email envelope
$envelope = new ByJG\Mail\Envelope();
$envelope->setFrom('johndoe@example.com', 'John Doe');
$envelope->addTo('jane@example.com');
$envelope->setSubject('Email Subject');
$envelope->setBody('html text body');

// The the email with the selected mailer.
$mailer->send($envelope);
