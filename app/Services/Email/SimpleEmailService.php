<?php

namespace App\Services\Email;

class SimpleEmailService implements EmailInterface
{
    /**
     * @inheritDoc
     */
    public static function send($sender, $recipient, $subject, $body): bool
    {
        return mail($recipient, $subject, $body, ['from' => $sender]);
    }
}
