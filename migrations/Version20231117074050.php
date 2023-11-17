<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117074050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_certifications_licences ADD about_id INT DEFAULT NULL, ADD extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE user_certifications_licences ADD CONSTRAINT FK_CFC04AB1D087DB59 FOREIGN KEY (about_id) REFERENCES about (id)');
        $this->addSql('CREATE INDEX IDX_CFC04AB1D087DB59 ON user_certifications_licences (about_id)');
        $this->addSql('ALTER TABLE user_education ADD about_id INT DEFAULT NULL, ADD extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE user_education ADD CONSTRAINT FK_DBEAD336D087DB59 FOREIGN KEY (about_id) REFERENCES about (id)');
        $this->addSql('CREATE INDEX IDX_DBEAD336D087DB59 ON user_education (about_id)');
        $this->addSql('ALTER TABLE user_experience ADD about_id INT DEFAULT NULL, ADD extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE user_experience ADD CONSTRAINT FK_A2F707EFD087DB59 FOREIGN KEY (about_id) REFERENCES about (id)');
        $this->addSql('CREATE INDEX IDX_A2F707EFD087DB59 ON user_experience (about_id)');
        $this->addSql('ALTER TABLE user_skills ADD about_id INT DEFAULT NULL, ADD extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE user_skills ADD CONSTRAINT FK_B0630D4DD087DB59 FOREIGN KEY (about_id) REFERENCES about (id)');
        $this->addSql('CREATE INDEX IDX_B0630D4DD087DB59 ON user_skills (about_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_certifications_licences DROP FOREIGN KEY FK_CFC04AB1D087DB59');
        $this->addSql('DROP INDEX IDX_CFC04AB1D087DB59 ON user_certifications_licences');
        $this->addSql('ALTER TABLE user_certifications_licences DROP about_id, DROP extra_data');
        $this->addSql('ALTER TABLE user_education DROP FOREIGN KEY FK_DBEAD336D087DB59');
        $this->addSql('DROP INDEX IDX_DBEAD336D087DB59 ON user_education');
        $this->addSql('ALTER TABLE user_education DROP about_id, DROP extra_data');
        $this->addSql('ALTER TABLE user_experience DROP FOREIGN KEY FK_A2F707EFD087DB59');
        $this->addSql('DROP INDEX IDX_A2F707EFD087DB59 ON user_experience');
        $this->addSql('ALTER TABLE user_experience DROP about_id, DROP extra_data');
        $this->addSql('ALTER TABLE user_skills DROP FOREIGN KEY FK_B0630D4DD087DB59');
        $this->addSql('DROP INDEX IDX_B0630D4DD087DB59 ON user_skills');
        $this->addSql('ALTER TABLE user_skills DROP about_id, DROP extra_data');
    }
}
