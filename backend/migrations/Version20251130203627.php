<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251130203627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE process_page (id INT AUTO_INCREMENT NOT NULL, hero_badge VARCHAR(255) NOT NULL, hero_title VARCHAR(255) NOT NULL, hero_subtitle LONGTEXT NOT NULL, process_title VARCHAR(255) NOT NULL, process_description LONGTEXT NOT NULL, process_steps JSON NOT NULL, values_title VARCHAR(255) NOT NULL, values_description LONGTEXT NOT NULL, `values` JSON NOT NULL, seo_title VARCHAR(255) NOT NULL, seo_description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE process_page');
    }
}
