<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250719073415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specification DROP FOREIGN KEY FK_E3F1A9ACDFA51E8');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, specification_book_id INT DEFAULT NULL, quote_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, uploaded_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8C9F36105518325C (specification_book_id), INDEX IDX_8C9F3610DB805178 (quote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6B71CBF419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specification_book (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8366D44319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F36105518325C FOREIGN KEY (specification_book_id) REFERENCES specification_book (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE specification_book ADD CONSTRAINT FK_8366D44319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE cateogry');
        $this->addSql('DROP INDEX IDX_E3F1A9ACDFA51E8 ON specification');
        $this->addSql('ALTER TABLE specification CHANGE cateogry_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specification ADD CONSTRAINT FK_E3F1A9A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_E3F1A9A12469DE2 ON specification (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specification DROP FOREIGN KEY FK_E3F1A9A12469DE2');
        $this->addSql('CREATE TABLE cateogry (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F36105518325C');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610DB805178');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF419EB6921');
        $this->addSql('ALTER TABLE specification_book DROP FOREIGN KEY FK_8366D44319EB6921');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE specification_book');
        $this->addSql('DROP INDEX IDX_E3F1A9A12469DE2 ON specification');
        $this->addSql('ALTER TABLE specification CHANGE category_id cateogry_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specification ADD CONSTRAINT FK_E3F1A9ACDFA51E8 FOREIGN KEY (cateogry_id) REFERENCES cateogry (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E3F1A9ACDFA51E8 ON specification (cateogry_id)');
    }
}
