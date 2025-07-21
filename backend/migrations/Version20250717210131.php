<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250717210131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, og_title VARCHAR(255) NOT NULL, og_description LONGTEXT NOT NULL, og_url LONGTEXT NOT NULL, map LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE micro_service (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_BBF7E514ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Service (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_price (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_price_include (id INT AUTO_INCREMENT NOT NULL, service_price_id INT NOT NULL, INDEX IDX_CB341E552F629CDA (service_price_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specification (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, placeholder VARCHAR(255) NOT NULL, required TINYINT(1) NOT NULL, pattern VARCHAR(255) NOT NULL, min INT DEFAULT NULL, max INT DEFAULT NULL, error_message LONGTEXT NOT NULL, tooltip LONGTEXT DEFAULT NULL, display_order INT NOT NULL, type_options JSON DEFAULT NULL, INDEX IDX_E3F1A9ACDFA51E8 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, fingerprint VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE micro_service ADD CONSTRAINT FK_BBF7E514ED5CA9E6 FOREIGN KEY (service_id) REFERENCES Service (id)');
        $this->addSql('ALTER TABLE service_price_include ADD CONSTRAINT FK_CB341E552F629CDA FOREIGN KEY (service_price_id) REFERENCES service_price (id)');
        $this->addSql('ALTER TABLE specification ADD CONSTRAINT FK_E3F1A9ACDFA51E8 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE micro_service DROP FOREIGN KEY FK_BBF7E514ED5CA9E6');
        $this->addSql('ALTER TABLE service_price_include DROP FOREIGN KEY FK_CB341E552F629CDA');
        $this->addSql('ALTER TABLE specification DROP FOREIGN KEY FK_E3F1A9ACDFA51E8');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE micro_service');
        $this->addSql('DROP TABLE Service');
        $this->addSql('DROP TABLE service_price');
        $this->addSql('DROP TABLE service_price_include');
        $this->addSql('DROP TABLE specification');
        $this->addSql('DROP TABLE `user`');
    }
}
