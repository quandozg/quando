<?php


namespace phpunit;


use App\Domains\StringDomain;
use App\Exceptions\FormatException;
use PHPUnit\Framework\TestCase;

/**
 * Class StringDomainTest
 * This is a sample of php-unit how tests should look like
 * @package phpunit
 */
class StringDomainTest extends TestCase
{
    public function testStringAsString()
    {
        $string = new StringDomain('string');
        $this->assertInstanceOf(StringDomain::class, $string);
        $this->assertEquals($string->getValue(), (string) $string);
        $this->assertEquals('string', $string->toString());
        $this->assertEquals('string', (string) $string);
    }

    public function testStringAsBool()
    {
        $this->expectException(FormatException::class);
        $string = new StringDomain(true);
    }

    public function testStringAsMinError()
    {
        $this->expectException(FormatException::class);
        $string = new StringDomain('1234', ['min' => 5]);
    }

    public function testStringMaxError()
    {
        $this->expectException(FormatException::class);
        $string = new StringDomain('1234', ['max' => 1]);
    }

    public function testStringMinMaxSuccess()
    {
        $string = new StringDomain('1234', ['min' => 4, 'max' => 4]);
        $this->assertInstanceOf(StringDomain::class, $string);
        $this->assertEquals('1234', $string->toString());
        $this->assertEquals('1234', (string) $string);
    }
}

