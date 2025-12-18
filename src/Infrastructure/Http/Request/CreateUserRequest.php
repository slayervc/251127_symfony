<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Request;

use App\Domain\Service\Params\User\CreateUserParams;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequest
{
    #[Assert\NotBlank()]
    public ?string $login = null;

    public string $password;
    public string $firstName;
    public string $lastName;
    public string $email;

    public function toParams(string $hashedPassword): CreateUserParams
    {
        return new CreateUserParams($this->login, $hashedPassword, $this->firstName, $this->lastName, $this->email);
    }
}
