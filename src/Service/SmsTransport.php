<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;

#[AsAlias(id: 'sms.tst.alias')]
class SmsTransport implements TransportInterface
{
    public function send(string $message, string $contact): void
    {
        // TODO: Implement send() method.
    }
}
