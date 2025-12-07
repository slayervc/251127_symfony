<?php

declare(strict_types=1);

namespace App\Service;

interface TransportInterface
{
    public function send(string $message, string $contact): void;
}
