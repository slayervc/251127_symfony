<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use App\Domain\Entity\User\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SecurityUserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return SecurityUser::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $domainUser = $this->userRepository->findByLogin($identifier);
        if (null === $domainUser) {
            throw new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
        }

        return new SecurityUser($domainUser->getId(), $domainUser->getLogin(), $domainUser->getPassword());
    }
}
