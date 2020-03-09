<?php

namespace App\Services\Email;

class DummyEmailService implements EmailInterface
{
    /**
     * @inheritDoc
     */
    public static function send($sender, $recipient, $subject, $body): bool
    {
        return true;
    }
}
