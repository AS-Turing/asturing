<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260105200659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE specification (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, placeholder VARCHAR(255) NOT NULL, required TINYINT NOT NULL, pattern VARCHAR(255) NOT NULL, min INT DEFAULT NULL, max INT DEFAULT NULL, error_message LONGTEXT NOT NULL, tooltip LONGTEXT DEFAULT NULL, display_order INT NOT NULL, type_options JSON DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE specification_answer (id INT AUTO_INCREMENT NOT NULL, answer_value LONGTEXT DEFAULT NULL, specification_book_id INT NOT NULL, specification_id INT NOT NULL, INDEX IDX_9B5FD4D5518325C (specification_book_id), INDEX IDX_9B5FD4D908E2FFE (specification_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE specification_book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE specification_answer ADD CONSTRAINT FK_9B5FD4D5518325C FOREIGN KEY (specification_book_id) REFERENCES specification_book (id)');
        $this->addSql('ALTER TABLE specification_answer ADD CONSTRAINT FK_9B5FD4D908E2FFE FOREIGN KEY (specification_id) REFERENCES specification (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specification_answer DROP FOREIGN KEY FK_9B5FD4D5518325C');
        $this->addSql('ALTER TABLE specification_answer DROP FOREIGN KEY FK_9B5FD4D908E2FFE');
        $this->addSql('DROP TABLE specification');
        $this->addSql('DROP TABLE specification_answer');
        $this->addSql('DROP TABLE specification_book');
    }
}
