<?php

namespace ByJG\Mail;

use \PHPUnit\Framework\TestCase;
use ByJG\Mail\Wrapper\AmazonSesWrapper;
use ByJG\Mail\Wrapper\MailgunApiWrapper;
use ByJG\Mail\Wrapper\PHPMailerWrapper;
use ByJG\Mail\Wrapper\SendMailWrapper;

class MailerWrapperTest extends TestCase
{

    /**
     * @throws \ByJG\Mail\Exception\InvalidMailHandlerException
     */
    public function testRegisterMailer()
    {
        MailerFactory::registerMailer('smtp', PHPMailerWrapper::class);
        MailerFactory::registerMailer('tls', PHPMailerWrapper::class);
        MailerFactory::registerMailer('ssl', PHPMailerWrapper::class);
        MailerFactory::registerMailer('sendmail', SendMailWrapper::class);
        MailerFactory::registerMailer('mailgun', MailgunApiWrapper::class);
        MailerFactory::registerMailer('ses', AmazonSesWrapper::class);

        // If there is no error above, the test is OK.
        $this->assertTrue(true);
    }

    /**
     * @throws \ByJG\Mail\Exception\InvalidMailHandlerException
     * @expectedException \ByJG\Mail\Exception\InvalidMailHandlerException
     */
    public function testRegisterMailerFail()
    {
        MailerFactory::registerMailer('some', '\\Non\\Existant\\Class');
    }

    /**
     * @throws \ByJG\Mail\Exception\InvalidMailHandlerException
     * @throws \ByJG\Mail\Exception\ProtocolNotRegisteredException
     */
    public function testCreate()
    {
        MailerFactory::registerMailer('smtp', PHPMailerWrapper::class);
        MailerFactory::create('smtp://localhost');

        // If there is no error above the test is OK.
        $this->assertTrue(true);
    }

    /**
     * @throws \ByJG\Mail\Exception\ProtocolNotRegisteredException
     * @expectedException \ByJG\Mail\Exception\ProtocolNotRegisteredException
     * @throws \ByJG\Mail\Exception\InvalidMailHandlerException
     */
    public function testCreateFail()
    {
        MailerFactory::registerMailer('smtp', PHPMailerWrapper::class);
        MailerFactory::create('some://localhost');
    }
}
