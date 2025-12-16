<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251216152809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, departement VARCHAR(100) NOT NULL, code_postal VARCHAR(10) NOT NULL, region VARCHAR(100) NOT NULL, meta JSON NOT NULL, hero JSON NOT NULL, why_choose JSON NOT NULL, services JSON NOT NULL, sectors JSON DEFAULT NULL, projects JSON DEFAULT NULL, process JSON NOT NULL, faq JSON NOT NULL, cta JSON NOT NULL, contact JSON DEFAULT NULL, is_active TINYINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5E9E89CB989D9B62 (slug), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE location');
    }
}
