<?php

use App\Domains\EmailAddressDomain;
use App\Exceptions\FormatException;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
    public function testEmailAddressValid()
    {
        $email = new EmailAddressDomain('wewe@wewe.com');
        $this->assertIsObject($email);
        $this->assertInstanceOf(EmailAddressDomain::class, $email);
        $this->assertEquals((string)$email, 'wewe@wewe.com');
        $this->assertEquals((string)$email, $email->toString());
        $this->assertEquals((string)$email, $email->getValue());
    }

    public function testEmailAddressInvalidTooBigDefault()
    {
        // Default email max size set to 50
        $this->expectException(FormatException::class);
        $email = new EmailAddressDomain('dsadsadsadsadsadsadsadsadsaasasadsasdasdsadsadasdasdsaddas@sdsadsd.com');
    }

    public function testEmailAddressInvalidTooSmallDefault()
    {
        // Default email min size set to 4
        $this->expectException(FormatException::class);
        $email = new EmailAddressDomain('s@s');
    }

    public function testEmailAddressInteger()
    {
        $this->expectException(FormatException::class);
        $email = new EmailAddressDomain(1);
    }

    public function testEmailAddressEmpty()
    {
        $this->expectException(FormatException::class);
        $email = new EmailAddressDomain(null);
    }

    public function testEmailAddressInvalid()
    {
        $this->expectException(FormatException::class);
        $email = new EmailAddressDomain('sadas');
    }
}

