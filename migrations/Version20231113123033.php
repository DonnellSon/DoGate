<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113123033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD comment_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment_reply DROP content, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE comment_reply ADD CONSTRAINT FK_54325E11BF396750 FOREIGN KEY (id) REFERENCES comment (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP comment_type');
        $this->addSql('ALTER TABLE comment_reply DROP FOREIGN KEY FK_54325E11BF396750');
        $this->addSql('ALTER TABLE comment_reply ADD content VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
