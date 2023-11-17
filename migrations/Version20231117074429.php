<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117074429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD about_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D087DB59 FOREIGN KEY (about_id) REFERENCES about (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D087DB59 ON user (about_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D087DB59');
        $this->addSql('DROP INDEX UNIQ_8D93D649D087DB59 ON user');
        $this->addSql('ALTER TABLE user DROP about_id');
    }
}
