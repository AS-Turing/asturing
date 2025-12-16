<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215012138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_message ADD phone VARCHAR(50) DEFAULT NULL, ADD company VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD audience JSON DEFAULT NULL, ADD outcomes JSON DEFAULT NULL, ADD cta_soft JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE service_solution ADD starting_price VARCHAR(50) DEFAULT NULL, ADD delivery_time VARCHAR(50) DEFAULT NULL, ADD price VARCHAR(50) DEFAULT NULL, ADD price_engagement VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_message DROP phone, DROP company');
        $this->addSql('ALTER TABLE service DROP audience, DROP outcomes, DROP cta_soft');
        $this->addSql('ALTER TABLE service_solution DROP starting_price, DROP delivery_time, DROP price, DROP price_engagement');
    }
}
