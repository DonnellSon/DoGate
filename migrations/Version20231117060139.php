<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117060139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP turnover_id');
        $this->addSql('ALTER TABLE turnover DROP FOREIGN KEY FK_638A62C979B1AD6');
        $this->addSql('DROP INDEX UNIQ_638A62C979B1AD6 ON turnover');
        $this->addSql('ALTER TABLE turnover DROP company_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD turnover_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE turnover ADD company_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE turnover ADD CONSTRAINT FK_638A62C979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_638A62C979B1AD6 ON turnover (company_id)');
    }
}
