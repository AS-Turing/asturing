<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fingerprint-validator',
    description: 'Validate the fingerprint of a user requiring validation.',
)]
class FingerprintValidatorCommand extends Command
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
//        $this
//            ->addArgument('valid', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
//        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $user = $this->repository->findOneBy(['requiresValidation' => true]);

        if (!$user) {
            $io->error("No user need validation");
            return Command::FAILURE;
        }

        if ($io->confirm('Accept validation about ' . $user->getFirstname() . $user->getLastname() . ' fingerprint ?')) {
            try {
                $user->setRequiresValidation(false);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            } catch (\Throwable $exception) {
                $io->error($exception->getMessage());
                return Command::FAILURE;
            }
        } else {
            $io->error("The fingerprint can't be validated");
            return Command::FAILURE;
        }

        $io->success('The fingerprint has been successfully validated');

        return Command::SUCCESS;
    }
}
