<?php

declare(strict_types=1);

namespace App\Infrastructure\Console;

use App\Domain\Entity\User\UserRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('user:dump')]
class DumpUser extends Command
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userById = $this->userRepository->getById(2);
        $usersByLastName = $this->userRepository->findAllByLastName('kin');

        $output->writeln('<info>UserById: </info>' . $userById->getId());
        foreach ($usersByLastName as $user) {
            $output->writeln('<info>usersByLastName: </info>' . $user->getId());
        }

        return Command::SUCCESS;
    }
}
