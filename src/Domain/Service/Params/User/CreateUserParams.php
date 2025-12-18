<?php

declare(strict_types=1);

namespace App\Domain\Service\Params\User;

readonly class CreateUserParams
{
    public function __construct(
        public string $login,
        public string $password,
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {
    }
}
