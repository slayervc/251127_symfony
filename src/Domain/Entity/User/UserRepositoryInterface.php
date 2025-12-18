<?php

declare(strict_types=1);

namespace App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findById(int $id): ?User;

    public function findByLogin(string $login): ?User;

    /**
     * @param string $lastname
     * @return User[]
     */
    public function findAllByLastName(string $lastname): array;
}
