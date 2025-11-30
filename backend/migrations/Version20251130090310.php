<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251130090310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_technology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, service_id INT NOT NULL, INDEX IDX_62326BF9ED5CA9E6 (service_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE service_technology ADD CONSTRAINT FK_62326BF9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD long_description LONGTEXT DEFAULT NULL, CHANGE audit_duration audit_duration VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE service_faq DROP FOREIGN KEY `FK_service_faq_service`');
        $this->addSql('ALTER TABLE service_faq CHANGE position position SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE service_faq ADD CONSTRAINT FK_CAAF06BBED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_faq RENAME INDEX idx_service_faq_service TO IDX_CAAF06BBED5CA9E6');
        $this->addSql('ALTER TABLE service_process_step DROP FOREIGN KEY `FK_service_process_step_service`');
        $this->addSql('ALTER TABLE service_process_step CHANGE position position SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE service_process_step ADD CONSTRAINT FK_73FC59ECED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_process_step RENAME INDEX idx_service_process_step_service TO IDX_73FC59ECED5CA9E6');
        $this->addSql('ALTER TABLE service_solution DROP FOREIGN KEY `FK_service_solution_service`');
        $this->addSql('ALTER TABLE service_solution CHANGE position position SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE service_solution ADD CONSTRAINT FK_664572E6ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_solution RENAME INDEX idx_service_solution_service TO IDX_664572E6ED5CA9E6');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_technology DROP FOREIGN KEY FK_62326BF9ED5CA9E6');
        $this->addSql('DROP TABLE service_technology');
        $this->addSql('ALTER TABLE service DROP long_description, CHANGE audit_duration audit_duration VARCHAR(50) DEFAULT \'1h\'');
        $this->addSql('ALTER TABLE service_faq DROP FOREIGN KEY FK_CAAF06BBED5CA9E6');
        $this->addSql('ALTER TABLE service_faq CHANGE position position SMALLINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE service_faq ADD CONSTRAINT `FK_service_faq_service` FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_faq RENAME INDEX idx_caaf06bbed5ca9e6 TO IDX_service_faq_service');
        $this->addSql('ALTER TABLE service_process_step DROP FOREIGN KEY FK_73FC59ECED5CA9E6');
        $this->addSql('ALTER TABLE service_process_step CHANGE position position SMALLINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE service_process_step ADD CONSTRAINT `FK_service_process_step_service` FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_process_step RENAME INDEX idx_73fc59eced5ca9e6 TO IDX_service_process_step_service');
        $this->addSql('ALTER TABLE service_solution DROP FOREIGN KEY FK_664572E6ED5CA9E6');
        $this->addSql('ALTER TABLE service_solution CHANGE position position SMALLINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE service_solution ADD CONSTRAINT `FK_service_solution_service` FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_solution RENAME INDEX idx_664572e6ed5ca9e6 TO IDX_service_solution_service');
    }
}
