<?php

namespace Tests\Functional;

use ByJG\Mail\MailerFactory;
use ByJG\Mail\Wrapper\AmazonSesWrapper;

require_once "FunctionalBase.php";

class AmazonSesFunctionalTest extends FunctionalBase
{
    /**
     * @throws \ByJG\Mail\Exception\InvalidMailHandlerException
     * @throws \ByJG\Mail\Exception\ProtocolNotRegisteredException
     */
    public function setUp()
    {
        MailerFactory::registerMailer('ses', AmazonSesWrapper::class);

        $this->mailerName = "Aws Ses";
        $this->toEmail = getenv('AWSSES_TOEMAIL');
        $this->uri = getenv('AWSSES_URI');
        $this->from = getenv('AWSSES_FROM');
        parent::setUp();
    }
}
