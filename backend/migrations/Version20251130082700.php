<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251130082700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add service detail entities and fields';
    }

    public function up(Schema $schema): void
    {
        // Add new fields to service table
        $this->addSql('ALTER TABLE service ADD hero_image LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD hero_subtitle LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD stats JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD tech_categories JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD audit_duration VARCHAR(50) DEFAULT \'1h\'');

        // Create service_solution table
        $this->addSql('CREATE TABLE service_solution (
            id INT AUTO_INCREMENT NOT NULL,
            service_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            description LONGTEXT NOT NULL,
            features JSON NOT NULL,
            position SMALLINT NOT NULL DEFAULT 0,
            INDEX IDX_service_solution_service (service_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('ALTER TABLE service_solution ADD CONSTRAINT FK_service_solution_service 
            FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');

        // Create service_process_step table
        $this->addSql('CREATE TABLE service_process_step (
            id INT AUTO_INCREMENT NOT NULL,
            service_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            description LONGTEXT NOT NULL,
            position SMALLINT NOT NULL DEFAULT 0,
            INDEX IDX_service_process_step_service (service_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('ALTER TABLE service_process_step ADD CONSTRAINT FK_service_process_step_service 
            FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');

        // Create service_faq table
        $this->addSql('CREATE TABLE service_faq (
            id INT AUTO_INCREMENT NOT NULL,
            service_id INT NOT NULL,
            question LONGTEXT NOT NULL,
            answer LONGTEXT NOT NULL,
            position SMALLINT NOT NULL DEFAULT 0,
            INDEX IDX_service_faq_service (service_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('ALTER TABLE service_faq ADD CONSTRAINT FK_service_faq_service 
            FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE service_solution DROP FOREIGN KEY FK_service_solution_service');
        $this->addSql('ALTER TABLE service_process_step DROP FOREIGN KEY FK_service_process_step_service');
        $this->addSql('ALTER TABLE service_faq DROP FOREIGN KEY FK_service_faq_service');
        
        $this->addSql('DROP TABLE service_solution');
        $this->addSql('DROP TABLE service_process_step');
        $this->addSql('DROP TABLE service_faq');
        
        $this->addSql('ALTER TABLE service DROP hero_image');
        $this->addSql('ALTER TABLE service DROP hero_subtitle');
        $this->addSql('ALTER TABLE service DROP stats');
        $this->addSql('ALTER TABLE service DROP tech_categories');
        $this->addSql('ALTER TABLE service DROP audit_duration');
    }
}
