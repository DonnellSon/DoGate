<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114093248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_domain (company_id VARCHAR(255) NOT NULL, domain_id VARCHAR(255) NOT NULL, INDEX IDX_9A367A7E979B1AD6 (company_id), INDEX IDX_9A367A7E115F0EE5 (domain_id), PRIMARY KEY(company_id, domain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain_invest (domain_id VARCHAR(255) NOT NULL, invest_id VARCHAR(255) NOT NULL, INDEX IDX_846A534F115F0EE5 (domain_id), INDEX IDX_846A534FC7065BD6 (invest_id), PRIMARY KEY(domain_id, invest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_domain ADD CONSTRAINT FK_9A367A7E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_domain ADD CONSTRAINT FK_9A367A7E115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domain_invest ADD CONSTRAINT FK_846A534F115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domain_invest ADD CONSTRAINT FK_846A534FC7065BD6 FOREIGN KEY (invest_id) REFERENCES invest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_domaine DROP FOREIGN KEY FK_58FD101B979B1AD6');
        $this->addSql('ALTER TABLE company_domaine DROP FOREIGN KEY FK_58FD101B4272FC9F');
        $this->addSql('ALTER TABLE domaine_invest DROP FOREIGN KEY FK_E4E0EEA84272FC9F');
        $this->addSql('ALTER TABLE domaine_invest DROP FOREIGN KEY FK_E4E0EEA8C7065BD6');
        $this->addSql('DROP TABLE company_domaine');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE domaine_invest');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_domaine (company_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, domaine_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_58FD101B979B1AD6 (company_id), INDEX IDX_58FD101B4272FC9F (domaine_id), PRIMARY KEY(company_id, domaine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE domaine (id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE domaine_invest (domaine_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, invest_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E4E0EEA84272FC9F (domaine_id), INDEX IDX_E4E0EEA8C7065BD6 (invest_id), PRIMARY KEY(domaine_id, invest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE company_domaine ADD CONSTRAINT FK_58FD101B979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_domaine ADD CONSTRAINT FK_58FD101B4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domaine_invest ADD CONSTRAINT FK_E4E0EEA84272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domaine_invest ADD CONSTRAINT FK_E4E0EEA8C7065BD6 FOREIGN KEY (invest_id) REFERENCES invest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_domain DROP FOREIGN KEY FK_9A367A7E979B1AD6');
        $this->addSql('ALTER TABLE company_domain DROP FOREIGN KEY FK_9A367A7E115F0EE5');
        $this->addSql('ALTER TABLE domain_invest DROP FOREIGN KEY FK_846A534F115F0EE5');
        $this->addSql('ALTER TABLE domain_invest DROP FOREIGN KEY FK_846A534FC7065BD6');
        $this->addSql('DROP TABLE company_domain');
        $this->addSql('DROP TABLE domain');
        $this->addSql('DROP TABLE domain_invest');
    }
}
