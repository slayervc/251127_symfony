<?php

declare(strict_types=1);

namespace App\Domain\Service\User;

use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepositoryInterface;
use App\Infrastructure\Service\Notifier;

class UserService
{
    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly Notifier $notifier,
    ) {
    }

    public function create(): void
    {
        //Псеводокод для примера
        $user = new User();
        $account = new Account();
        $account->setBalance(1000);
        $this->userRepository->save($user);
        $this->accountRepository->save($account);
        $this->notifier->notify();
    }
}
