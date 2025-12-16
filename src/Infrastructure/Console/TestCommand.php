<?php

declare(strict_types=1);

namespace App\Infrastructure\Console;

use App\Infrastructure\Service\TransportInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('test')]
class TestCommand extends Command
{
    public function __construct(
//        private readonly TransportInterface $firstTransport,
//        private readonly TransportInterface $secondTransport,
//        private readonly TransportInterface $thirdTransport,
//        private readonly TransportInterface $fourthTransport,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        return Command::SUCCESS;
    }
}
