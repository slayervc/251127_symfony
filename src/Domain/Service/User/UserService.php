<?php

declare(strict_types=1);

namespace App\Domain\Service\User;

use App\Domain\Entity\Profile;
use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepositoryInterface;
use App\Domain\Service\Params\User\CreateUserParams;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function create(CreateUserParams $params): User
    {
        $profile = new Profile(
            $params->firstName,
            $params->lastName,
            $params->email,
        );

        $user = new User($params->login, $params->password, $profile);
        $this->userRepository->save($user);

        return $user;

        //Дополнительная логика по созданию пользователя размещается здесь, например:
            //Добавление юзера в дефолтную группу
            //Начисление welcome-бонуса на счет
    }
}
