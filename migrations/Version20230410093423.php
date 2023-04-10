<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230410093423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_category_book DROP FOREIGN KEY FK_2597E17A16A2B381');
        $this->addSql('ALTER TABLE book_category_book DROP FOREIGN KEY FK_2597E17A40B1D29E');
        $this->addSql('ALTER TABLE book_category_category DROP FOREIGN KEY FK_63FC4B5812469DE2');
        $this->addSql('ALTER TABLE book_category_category DROP FOREIGN KEY FK_63FC4B5840B1D29E');
        $this->addSql('DROP TABLE book_category_book');
        $this->addSql('DROP TABLE book_category_category');
        $this->addSql('ALTER TABLE book_category ADD book_id INT DEFAULT NULL, ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F9816A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F9812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_1FB30F9816A2B381 ON book_category (book_id)');
        $this->addSql('CREATE INDEX IDX_1FB30F9812469DE2 ON book_category (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_category_book (book_category_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_2597E17A40B1D29E (book_category_id), INDEX IDX_2597E17A16A2B381 (book_id), PRIMARY KEY(book_category_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE book_category_category (book_category_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_63FC4B5840B1D29E (book_category_id), INDEX IDX_63FC4B5812469DE2 (category_id), PRIMARY KEY(book_category_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE book_category_book ADD CONSTRAINT FK_2597E17A16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_category_book ADD CONSTRAINT FK_2597E17A40B1D29E FOREIGN KEY (book_category_id) REFERENCES book_category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_category_category ADD CONSTRAINT FK_63FC4B5812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_category_category ADD CONSTRAINT FK_63FC4B5840B1D29E FOREIGN KEY (book_category_id) REFERENCES book_category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F9816A2B381');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F9812469DE2');
        $this->addSql('DROP INDEX IDX_1FB30F9816A2B381 ON book_category');
        $this->addSql('DROP INDEX IDX_1FB30F9812469DE2 ON book_category');
        $this->addSql('ALTER TABLE book_category DROP book_id, DROP category_id');
    }
}
