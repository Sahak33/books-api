<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230410091815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP isbn, DROP page_count, DROP published, DROP thumbnail_url, DROP short_description, DROP status');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD isbn VARCHAR(255) NOT NULL, ADD page_count VARCHAR(255) NOT NULL, ADD published JSON DEFAULT NULL, ADD thumbnail_url VARCHAR(255) NOT NULL, ADD short_description VARCHAR(255) NOT NULL, ADD status INT NOT NULL');
    }
}
