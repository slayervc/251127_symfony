<?php

declare(strict_types=1);

namespace App\Infrastructure\Console;

use App\Domain\Entity\Profile;
use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepositoryInterface;
use App\Domain\Service\Params\User\CreateUserParams;
use App\Domain\Service\User\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('user:create')]
class CreateUser extends Command
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Creates a new user');
        $this->addArgument('username', InputArgument::REQUIRED, 'Username');
        $this->addArgument('firstname', InputArgument::REQUIRED, 'First name');
        $this->addArgument('lastname', InputArgument::REQUIRED, 'Last name');
        $this->addArgument('email', InputArgument::REQUIRED, 'Email address');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $params = new CreateUserParams(
            $input->getArgument('username'),
            $input->getArgument('firstname'),
            $input->getArgument('lastname'),
            $input->getArgument('email')
        );

        $service = new UserService($this->userRepository);
        $service->create($params);

        return Command::SUCCESS;
    }
}
