<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250729123829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, question VARCHAR(255) NOT NULL, answer LONGTEXT NOT NULL, INDEX IDX_E8FF75CCED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, name VARCHAR(255) NOT NULL, includes JSON DEFAULT NULL, price VARCHAR(255) NOT NULL, INDEX IDX_CAC822D9ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, og_title VARCHAR(255) NOT NULL, og_description LONGTEXT NOT NULL, og_url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6C71EC30ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE faq ADD CONSTRAINT FK_E8FF75CCED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE seo ADD CONSTRAINT FK_6C71EC30ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE micro_service DROP FOREIGN KEY FK_BBF7E514ED5CA9E6');
        $this->addSql('ALTER TABLE service_price_include DROP FOREIGN KEY FK_CB341E552F629CDA');
        $this->addSql('ALTER TABLE service_price DROP FOREIGN KEY FK_63BACF3EED5CA9E6');
        $this->addSql('DROP TABLE micro_service');
        $this->addSql('DROP TABLE service_price_include');
        $this->addSql('DROP TABLE service_price');
        $this->addSql('ALTER TABLE service ADD micro_services JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE micro_service (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, label VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BBF7E514ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE service_price_include (id INT AUTO_INCREMENT NOT NULL, service_price_id INT NOT NULL, INDEX IDX_CB341E552F629CDA (service_price_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE service_price (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price INT NOT NULL, INDEX IDX_63BACF3EED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE micro_service ADD CONSTRAINT FK_BBF7E514ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE service_price_include ADD CONSTRAINT FK_CB341E552F629CDA FOREIGN KEY (service_price_id) REFERENCES service_price (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE service_price ADD CONSTRAINT FK_63BACF3EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE faq DROP FOREIGN KEY FK_E8FF75CCED5CA9E6');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D9ED5CA9E6');
        $this->addSql('ALTER TABLE seo DROP FOREIGN KEY FK_6C71EC30ED5CA9E6');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE seo');
        $this->addSql('ALTER TABLE service DROP micro_services');
    }
}
