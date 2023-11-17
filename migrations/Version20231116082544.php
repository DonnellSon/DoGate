<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116082544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recommended (id INT AUTO_INCREMENT NOT NULL, author_id VARCHAR(255) DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5F898A6FF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turnover (id INT AUTO_INCREMENT NOT NULL, company_id VARCHAR(255) DEFAULT NULL, year VARCHAR(255) NOT NULL, turnover VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_638A62C979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recommended ADD CONSTRAINT FK_5F898A6FF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE turnover ADD CONSTRAINT FK_638A62C979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommended DROP FOREIGN KEY FK_5F898A6FF675F31B');
        $this->addSql('ALTER TABLE turnover DROP FOREIGN KEY FK_638A62C979B1AD6');
        $this->addSql('DROP TABLE recommended');
        $this->addSql('DROP TABLE turnover');
    }
}
