<?php

declare(strict_types=1);

namespace App\Domain\Entity\User;

use App\Domain\Entity\Profile;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'users')]
#[ORM\UniqueConstraint('uc_login', ['login'])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $login;

    #[ORM\Column()]
    private string $password;

    #[ORM\OneToOne(targetEntity: Profile::class, mappedBy: 'user')]
    private Profile $profile;

    public function __construct(string $login, string $password, Profile $profile)
    {
        $this->login = $login;
        $this->password = $password;
        $this->profile = $profile;
        $profile->setUser($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
