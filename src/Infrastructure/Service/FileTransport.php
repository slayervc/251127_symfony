<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

class FileTransport implements TransportInterface
{
    public function __construct(private readonly string $filePath)
    {
    }

    public function send(string $message, string $contact): void
    {
        // TODO: Implement send() method.
    }
}
