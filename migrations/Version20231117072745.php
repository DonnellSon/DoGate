<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117072745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAEC68BE09C');
        $this->addSql('CREATE TABLE about (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aside (id VARCHAR(255) NOT NULL, motto VARCHAR(255) DEFAULT NULL, anthem VARCHAR(255) DEFAULT NULL, population VARCHAR(255) DEFAULT NULL, area VARCHAR(255) DEFAULT NULL, population_density VARCHAR(255) DEFAULT NULL, gdp VARCHAR(255) DEFAULT NULL, gdp_nominal VARCHAR(255) DEFAULT NULL, hdi VARCHAR(255) DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, driving_side VARCHAR(255) DEFAULT NULL, calling_code VARCHAR(255) DEFAULT NULL, internet_tld VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flag (id VARCHAR(255) NOT NULL, file_url VARCHAR(255) DEFAULT NULL, file_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id VARCHAR(255) NOT NULL, language VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_pays (language_id VARCHAR(255) NOT NULL, pays_id VARCHAR(255) NOT NULL, INDEX IDX_696D6E282F1BAF4 (language_id), INDEX IDX_696D6E2A6E44244 (pays_id), PRIMARY KEY(language_id, pays_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id VARCHAR(255) NOT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_cultures (id VARCHAR(255) NOT NULL, extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_demog (id VARCHAR(255) NOT NULL, extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_economy (id VARCHAR(255) NOT NULL, extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_geography (id VARCHAR(255) NOT NULL, extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_gouvernment (id VARCHAR(255) NOT NULL, extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_history (id VARCHAR(255) NOT NULL, extra_data JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE religion (id VARCHAR(255) NOT NULL, religion VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1055F4F91055F4F9 (religion), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE religion_pays (religion_id VARCHAR(255) NOT NULL, pays_id VARCHAR(255) NOT NULL, INDEX IDX_52F0163B7850CBD (religion_id), INDEX IDX_52F0163A6E44244 (pays_id), PRIMARY KEY(religion_id, pays_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seal (id VARCHAR(255) NOT NULL, file_url VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_certifications_licences (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_education (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_experience (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_skills (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language_pays ADD CONSTRAINT FK_696D6E282F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_pays ADD CONSTRAINT FK_696D6E2A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE religion_pays ADD CONSTRAINT FK_52F0163B7850CBD FOREIGN KEY (religion_id) REFERENCES religion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE religion_pays ADD CONSTRAINT FK_52F0163A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP INDEX IDX_349F3CAEC68BE09C ON pays');
        $this->addSql('ALTER TABLE pays ADD location_id VARCHAR(255) DEFAULT NULL, ADD aside_id VARCHAR(255) DEFAULT NULL, ADD flag_id VARCHAR(255) DEFAULT NULL, ADD pays_history_id VARCHAR(255) DEFAULT NULL, ADD pays_geography_id VARCHAR(255) DEFAULT NULL, ADD pays_gouvernment_id VARCHAR(255) DEFAULT NULL, ADD pays_economy_id VARCHAR(255) DEFAULT NULL, ADD pays_cultures_id VARCHAR(255) DEFAULT NULL, ADD pays_demog_id VARCHAR(255) DEFAULT NULL, CHANGE localisation_id seal_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAE54778145 FOREIGN KEY (seal_id) REFERENCES seal (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAE64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAE725221F6 FOREIGN KEY (aside_id) REFERENCES aside (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAE919FE4E5 FOREIGN KEY (flag_id) REFERENCES flag (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAEB82157BA FOREIGN KEY (pays_history_id) REFERENCES pays_history (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAE79EC8569 FOREIGN KEY (pays_geography_id) REFERENCES pays_geography (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAE2CF2FF33 FOREIGN KEY (pays_gouvernment_id) REFERENCES pays_gouvernment (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAED2FBB123 FOREIGN KEY (pays_economy_id) REFERENCES pays_economy (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAEC7091461 FOREIGN KEY (pays_cultures_id) REFERENCES pays_cultures (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAE2E5B24A8 FOREIGN KEY (pays_demog_id) REFERENCES pays_demog (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_349F3CAE54778145 ON pays (seal_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_349F3CAE64D218E ON pays (location_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_349F3CAE725221F6 ON pays (aside_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_349F3CAE919FE4E5 ON pays (flag_id)');
        $this->addSql('CREATE INDEX IDX_349F3CAEB82157BA ON pays (pays_history_id)');
        $this->addSql('CREATE INDEX IDX_349F3CAE79EC8569 ON pays (pays_geography_id)');
        $this->addSql('CREATE INDEX IDX_349F3CAE2CF2FF33 ON pays (pays_gouvernment_id)');
        $this->addSql('CREATE INDEX IDX_349F3CAED2FBB123 ON pays (pays_economy_id)');
        $this->addSql('CREATE INDEX IDX_349F3CAEC7091461 ON pays (pays_cultures_id)');
        $this->addSql('CREATE INDEX IDX_349F3CAE2E5B24A8 ON pays (pays_demog_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAE725221F6');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAE919FE4E5');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAE64D218E');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAEC7091461');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAE2E5B24A8');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAED2FBB123');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAE79EC8569');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAE2CF2FF33');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAEB82157BA');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAE54778145');
        $this->addSql('CREATE TABLE localisation (id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lat_long VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE language_pays DROP FOREIGN KEY FK_696D6E282F1BAF4');
        $this->addSql('ALTER TABLE language_pays DROP FOREIGN KEY FK_696D6E2A6E44244');
        $this->addSql('ALTER TABLE religion_pays DROP FOREIGN KEY FK_52F0163B7850CBD');
        $this->addSql('ALTER TABLE religion_pays DROP FOREIGN KEY FK_52F0163A6E44244');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE aside');
        $this->addSql('DROP TABLE flag');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_pays');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE pays_cultures');
        $this->addSql('DROP TABLE pays_demog');
        $this->addSql('DROP TABLE pays_economy');
        $this->addSql('DROP TABLE pays_geography');
        $this->addSql('DROP TABLE pays_gouvernment');
        $this->addSql('DROP TABLE pays_history');
        $this->addSql('DROP TABLE religion');
        $this->addSql('DROP TABLE religion_pays');
        $this->addSql('DROP TABLE seal');
        $this->addSql('DROP TABLE user_certifications_licences');
        $this->addSql('DROP TABLE user_education');
        $this->addSql('DROP TABLE user_experience');
        $this->addSql('DROP TABLE user_skills');
        $this->addSql('DROP INDEX UNIQ_349F3CAE54778145 ON pays');
        $this->addSql('DROP INDEX UNIQ_349F3CAE64D218E ON pays');
        $this->addSql('DROP INDEX UNIQ_349F3CAE725221F6 ON pays');
        $this->addSql('DROP INDEX UNIQ_349F3CAE919FE4E5 ON pays');
        $this->addSql('DROP INDEX IDX_349F3CAEB82157BA ON pays');
        $this->addSql('DROP INDEX IDX_349F3CAE79EC8569 ON pays');
        $this->addSql('DROP INDEX IDX_349F3CAE2CF2FF33 ON pays');
        $this->addSql('DROP INDEX IDX_349F3CAED2FBB123 ON pays');
        $this->addSql('DROP INDEX IDX_349F3CAEC7091461 ON pays');
        $this->addSql('DROP INDEX IDX_349F3CAE2E5B24A8 ON pays');
        $this->addSql('ALTER TABLE pays ADD localisation_id VARCHAR(255) DEFAULT NULL, DROP seal_id, DROP location_id, DROP aside_id, DROP flag_id, DROP pays_history_id, DROP pays_geography_id, DROP pays_gouvernment_id, DROP pays_economy_id, DROP pays_cultures_id, DROP pays_demog_id');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAEC68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('CREATE INDEX IDX_349F3CAEC68BE09C ON pays (localisation_id)');
    }
}
