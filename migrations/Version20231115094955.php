<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115094955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_grade (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, author_id VARCHAR(255) DEFAULT NULL, grade_id INT DEFAULT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, salary LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', xp VARCHAR(255) DEFAULT NULL, summary VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_288A3A4EF675F31B (author_id), INDEX IDX_288A3A4EFE19A1A8 (grade_id), INDEX IDX_288A3A4EC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EFE19A1A8 FOREIGN KEY (grade_id) REFERENCES job_grade (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EC54C8C93 FOREIGN KEY (type_id) REFERENCES job_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EF675F31B');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EFE19A1A8');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EC54C8C93');
        $this->addSql('DROP TABLE job_grade');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_type');
    }
}
