<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251206124347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_info (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) NOT NULL, tagline VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, phone VARCHAR(100) DEFAULT NULL, email VARCHAR(255) NOT NULL, address LONGTEXT DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, region VARCHAR(100) DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, social_networks JSON DEFAULT NULL, logo_path VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, tva VARCHAR(255) DEFAULT NULL, business_hours JSON DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE company_info');
    }
}
