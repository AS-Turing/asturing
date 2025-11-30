<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251130193126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_page (id INT AUTO_INCREMENT NOT NULL, hero_badge VARCHAR(255) NOT NULL, hero_title VARCHAR(255) NOT NULL, hero_subtitle LONGTEXT NOT NULL, form_title VARCHAR(255) NOT NULL, form_description LONGTEXT NOT NULL, form_privacy_text LONGTEXT NOT NULL, form_privacy_link VARCHAR(255) NOT NULL, form_submit_button VARCHAR(255) NOT NULL, form_submitting_button VARCHAR(255) NOT NULL, form_success_message LONGTEXT NOT NULL, form_error_message LONGTEXT NOT NULL, contact_info JSON NOT NULL, urgent_cta_title VARCHAR(255) NOT NULL, urgent_cta_description LONGTEXT NOT NULL, urgent_cta_button_text VARCHAR(255) NOT NULL, urgent_cta_button_link VARCHAR(255) NOT NULL, urgent_cta_button_icon VARCHAR(100) NOT NULL, faq_title VARCHAR(255) NOT NULL, faq_description LONGTEXT NOT NULL, faq_items JSON NOT NULL, seo_title VARCHAR(255) NOT NULL, seo_description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact_page');
    }
}
