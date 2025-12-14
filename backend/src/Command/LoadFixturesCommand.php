<?php

namespace App\Command;

use App\DataFixtures\ProjectFixtures;
use App\DataFixtures\ServiceFixtures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-fixtures',
    description: 'Load fixtures data into database',
)]
class LoadFixturesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('purge', null, InputOption::VALUE_NONE, 'Purge data before loading');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Loading fixtures...');

        // Purge if requested
        if ($input->getOption('purge')) {
            $io->section('Purging existing data...');
            
            $connection = $this->entityManager->getConnection();
            $connection->executeStatement('SET FOREIGN_KEY_CHECKS=0');
            $connection->executeStatement('TRUNCATE TABLE blog_post');
            $connection->executeStatement('TRUNCATE TABLE project');
            $connection->executeStatement('TRUNCATE TABLE service');
            $connection->executeStatement('TRUNCATE TABLE service_faq');
            $connection->executeStatement('TRUNCATE TABLE service_process_step');
            $connection->executeStatement('TRUNCATE TABLE service_solution');
            $connection->executeStatement('TRUNCATE TABLE service_technology');
            $connection->executeStatement('TRUNCATE TABLE contact_page');
            $connection->executeStatement('TRUNCATE TABLE process_page');
            $connection->executeStatement('TRUNCATE TABLE client');
            $connection->executeStatement('TRUNCATE TABLE contact_message');
            $connection->executeStatement('TRUNCATE TABLE company_info');
            $connection->executeStatement('SET FOREIGN_KEY_CHECKS=1');
            
            $io->success('Data purged!');
        }

        // Load Services
        $io->section('Loading Services...');
        $serviceFixtures = new ServiceFixtures();
        $serviceFixtures->load($this->entityManager);
        $io->success('6 Services loaded successfully!');

        // Load Projects
        $io->section('Loading Projects...');
        $projectFixtures = new ProjectFixtures();
        $projectFixtures->load($this->entityManager);
        $io->success('2 Projects loaded successfully!');

        // Load Blog Posts
        $io->section('Loading Blog Posts...');
        $blogPostFixtures = new \App\DataFixtures\BlogPostFixtures();
        $blogPostFixtures->load($this->entityManager);
        $io->success('5 Blog Posts loaded successfully!');

        // Load Contact Page
        $io->section('Loading Contact Page...');
        $contactPageFixtures = new \App\DataFixtures\ContactPageFixtures();
        $contactPageFixtures->load($this->entityManager);
        $io->success('Contact Page loaded successfully!');

        // Load Process Page
        $io->section('Loading Process Page...');
        $processPageFixtures = new \App\DataFixtures\ProcessPageFixtures();
        $processPageFixtures->load($this->entityManager);
        $io->success('Process Page loaded successfully!');

        // Load Clients
        $io->section('Loading Clients...');
        $clientFixtures = new \App\DataFixtures\ClientFixtures();
        $clientFixtures->load($this->entityManager);
        $io->success('8 Clients loaded successfully!');

        // Load Company Info
        $io->section('Loading Company Info...');
        $companyInfoFixtures = new \App\DataFixtures\CompanyInfoFixtures();
        $companyInfoFixtures->load($this->entityManager);
        $io->success('Company Info loaded successfully!');

        $io->success('All fixtures loaded successfully!');

        return Command::SUCCESS;
    }
}
