<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

class Notifier
{
    public function __construct(
        private readonly TransportInterface $smsTransport,
    ) {
    }

    public function notify(string $message, string $contact): void
    {
        $this->transport->send();
    }
}
