<?php

declare(strict_types=1);

namespace App\Infrastructure\Console;

use App\Domain\Entity\Profile;
use App\Domain\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('user:create')]
class CreateUser extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $profile = new Profile('Patya', 'Pupkin', 'Patya@mail.ru');
        $user = new User('someDude1eds439', $profile);


        $this->em->persist($profile);
        $this->em->persist($user);
        $this->em->flush();

        return Command::SUCCESS;
    }
}
