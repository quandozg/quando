<?php

namespace phpunit;

use App\Model\User;
use PHPUnit\Framework\TestCase;
use function var_dump;

class UserModelTest extends TestCase
{

    public function testUserValid()
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->getModel(), 'Users');
    }

    public function testUserWithData()
    {
        $user = new User([
            'firstName' => 'erwere',
            'lastName' => 'doreovic',
            'email' => 'sieriwersa@terer.com',
        ]);
        $this->assertTrue($user->isValid());
    }

    public function testUserWithInvalidEmail()
    {
        $user = new User([
            'firstName' => 'swqewqe',
            'lastName' => 'qwewqewq',
            'email' => 'sinerwea.com',
        ]);
        $this->assertFalse($user->isValid());
    }

    public function testUserWithInvalidFirstName()
    {
        $user = new User([
            'lastName' => 'wererwer',
            'email' => 'ere@werere.com',
        ]);
        $this->assertFalse($user->isValid());
        $this->assertCount(1, $user->getErrors());
    }

    public function testUserWithInvalidFirstLastName()
    {
        $user = new User([
            'firstName'=>'',
            'lastName' => '',
            'email' => 'ererer@erwerwe.com',
        ]);
        $this->assertFalse($user->isValid());
        $this->assertCount(2, $user->getErrors());
    }
}
