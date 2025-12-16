<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\User;

use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityRepository $userRepository;

    public function __construct(
        private EntityManagerInterface $em
    )
    {
        $this->userRepository = $this->em->getRepository(User::class);
    }

    public function save(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function getById(int $id): User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param string $lastname
     * @return User[]
     */
    public function findAllByLastName(string $lastname): array
    {
        $query = $this->userRepository->createQueryBuilder('u')
            ->leftJoin('u.profile', 'p')
            ->where('p.lastName LIKE :lastname')
            ->setParameter('lastname', "%$lastname%")
            ->getQuery();


        return $query->getResult();
    }
}
