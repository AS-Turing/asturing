<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251129194146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, excerpt VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, category VARCHAR(100) NOT NULL, category_class VARCHAR(100) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, image_gradient VARCHAR(100) NOT NULL, image_text VARCHAR(255) DEFAULT NULL, published_at DATETIME NOT NULL, is_published TINYINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_BA5AE01D989D9B62 (slug), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE contact_message (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, is_read TINYINT NOT NULL, created_at DATETIME NOT NULL, read_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, technologies LONGTEXT NOT NULL, image_url VARCHAR(255) DEFAULT NULL, image_text VARCHAR(255) DEFAULT NULL, bg_gradient VARCHAR(100) NOT NULL, image_gradient VARCHAR(100) NOT NULL, dot_color VARCHAR(50) NOT NULL, category_color VARCHAR(100) NOT NULL, desc_color VARCHAR(100) NOT NULL, tech_class VARCHAR(100) NOT NULL, link_color VARCHAR(100) NOT NULL, position SMALLINT NOT NULL, is_active TINYINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2FB3D0EE989D9B62 (slug), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, icon LONGTEXT NOT NULL, icon_gradient VARCHAR(100) NOT NULL, border_color VARCHAR(100) NOT NULL, link_color VARCHAR(100) NOT NULL, position SMALLINT NOT NULL, is_active TINYINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_E19D9AD2989D9B62 (slug), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE contact_message');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE service');
    }
}
