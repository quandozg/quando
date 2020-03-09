<?php

namespace App\Services\Email;

interface EmailInterface
{

    /**
     * Sends an email
     * @param string $sender
     * @param string $recipient
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public static function send($sender, $recipient, $subject, $body): bool;
}
