<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251202081330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD excerpt LONGTEXT DEFAULT NULL, ADD client VARCHAR(255) DEFAULT NULL, ADD sector VARCHAR(255) DEFAULT NULL, ADD year VARCHAR(50) DEFAULT NULL, ADD duration VARCHAR(100) DEFAULT NULL, ADD status VARCHAR(255) DEFAULT NULL, ADD url VARCHAR(500) DEFAULT NULL, ADD challenge LONGTEXT DEFAULT NULL, ADD solution LONGTEXT DEFAULT NULL, ADD results LONGTEXT DEFAULT NULL, ADD testimonial JSON DEFAULT NULL, ADD features LONGTEXT DEFAULT NULL, ADD images JSON DEFAULT NULL, ADD featured TINYINT NOT NULL, ADD is_published TINYINT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP excerpt, DROP client, DROP sector, DROP year, DROP duration, DROP status, DROP url, DROP challenge, DROP solution, DROP results, DROP testimonial, DROP features, DROP images, DROP featured, DROP is_published');
    }
}
