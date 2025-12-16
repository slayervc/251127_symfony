<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

class MailTransport implements TransportInterface
{
    public function send(string $message, string $contact): void
    {

    }
}
