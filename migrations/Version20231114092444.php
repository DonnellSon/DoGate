<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114092444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id VARCHAR(255) NOT NULL, author_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id VARCHAR(255) NOT NULL, author_id VARCHAR(255) NOT NULL, commentable_id VARCHAR(255) DEFAULT NULL, parent_id VARCHAR(255) DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526CF675F31B (author_id), INDEX IDX_9474526CF8B08B0 (commentable_id), INDEX IDX_9474526C727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentable_entity (id VARCHAR(255) NOT NULL, commentable_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id VARCHAR(255) NOT NULL, active_logo_id VARCHAR(255) DEFAULT NULL, author_id VARCHAR(255) NOT NULL, company_size_id VARCHAR(255) NOT NULL, company_type_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, nif_stat VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, description LONGTEXT NOT NULL, numero VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, web_site VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_4FBF094F7AC3A854 (active_logo_id), INDEX IDX_4FBF094FF675F31B (author_id), INDEX IDX_4FBF094F69DFB2F0 (company_size_id), INDEX IDX_4FBF094FE51E9644 (company_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_domaine (company_id VARCHAR(255) NOT NULL, domaine_id VARCHAR(255) NOT NULL, INDEX IDX_58FD101B979B1AD6 (company_id), INDEX IDX_58FD101B4272FC9F (domaine_id), PRIMARY KEY(company_id, domaine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_logo (id VARCHAR(255) NOT NULL, company_id VARCHAR(255) DEFAULT NULL, file_url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', active TINYINT(1) NOT NULL, file_name VARCHAR(255) NOT NULL, file_size VARCHAR(255) NOT NULL, INDEX IDX_A7E380FD979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_size (id VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_type (id VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, requester_id VARCHAR(255) NOT NULL, receiver_id VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_4C62E638ED442CF4 (requester_id), INDEX IDX_4C62E638CD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discussion (id VARCHAR(255) NOT NULL, discu_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine_invest (domaine_id VARCHAR(255) NOT NULL, invest_id VARCHAR(255) NOT NULL, INDEX IDX_E4E0EEA84272FC9F (domaine_id), INDEX IDX_E4E0EEA8C7065BD6 (invest_id), PRIMARY KEY(domaine_id, invest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, author_id VARCHAR(255) NOT NULL, note INT NOT NULL, evaluation_type VARCHAR(255) NOT NULL, INDEX IDX_1323A575F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id VARCHAR(255) NOT NULL, image_entity_id VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C53D045F59A7A609 (image_entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_entity (id VARCHAR(255) NOT NULL, image_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invest (id VARCHAR(255) NOT NULL, author_id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, need VARCHAR(255) NOT NULL, collected VARCHAR(255) NOT NULL, INDEX IDX_EB095F86F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invest_picture (id VARCHAR(255) NOT NULL, invest_id VARCHAR(255) DEFAULT NULL, file_url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', file_name VARCHAR(255) NOT NULL, file_size VARCHAR(255) NOT NULL, INDEX IDX_5A511CF1C7065BD6 (invest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_grade (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, author_id VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, salary LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', xp VARCHAR(255) DEFAULT NULL, summary VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_288A3A4EF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisation (id VARCHAR(255) NOT NULL, lat_long VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_entity (id INT AUTO_INCREMENT NOT NULL, discussion_id VARCHAR(255) DEFAULT NULL, user_id VARCHAR(255) DEFAULT NULL, INDEX IDX_2AFEC65B1ADED311 (discussion_id), INDEX IDX_2AFEC65BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_id VARCHAR(255) NOT NULL, discussion_id VARCHAR(255) DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6BD307FF675F31B (author_id), INDEX IDX_B6BD307F1ADED311 (discussion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id VARCHAR(255) NOT NULL, localisation_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_349F3CAEC68BE09C (localisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id VARCHAR(255) NOT NULL, author_id VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5A8A6C8DF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_evaluation (id INT NOT NULL, post_id VARCHAR(255) NOT NULL, INDEX IDX_305BACB44B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_picture (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) NOT NULL, file_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', active TINYINT(1) NOT NULL, file_name VARCHAR(255) NOT NULL, ext_url VARCHAR(255) DEFAULT NULL, INDEX IDX_C5659115A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thumbnail (id VARCHAR(255) NOT NULL, post_id VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, file_size INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', file_url VARCHAR(255) NOT NULL, INDEX IDX_C35726E64B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id VARCHAR(255) NOT NULL, gender_id VARCHAR(255) DEFAULT NULL, active_profile_picture_id VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, birth_date VARCHAR(255) DEFAULT NULL, google_id VARCHAR(255) DEFAULT NULL, fb_id VARCHAR(255) DEFAULT NULL, linked_in_id VARCHAR(255) DEFAULT NULL, instagram_id VARCHAR(255) DEFAULT NULL, microsoft_id VARCHAR(255) DEFAULT NULL, discord_id VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649708A0E0 (gender_id), UNIQUE INDEX UNIQ_8D93D649A4767CB2 (active_profile_picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF8B08B0 FOREIGN KEY (commentable_id) REFERENCES commentable_entity (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C727ACA70 FOREIGN KEY (parent_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F7AC3A854 FOREIGN KEY (active_logo_id) REFERENCES company_logo (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F69DFB2F0 FOREIGN KEY (company_size_id) REFERENCES company_size (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FE51E9644 FOREIGN KEY (company_type_id) REFERENCES company_type (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FBF396750 FOREIGN KEY (id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_domaine ADD CONSTRAINT FK_58FD101B979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_domaine ADD CONSTRAINT FK_58FD101B4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_logo ADD CONSTRAINT FK_A7E380FD979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638ED442CF4 FOREIGN KEY (requester_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE domaine_invest ADD CONSTRAINT FK_E4E0EEA84272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domaine_invest ADD CONSTRAINT FK_E4E0EEA8C7065BD6 FOREIGN KEY (invest_id) REFERENCES invest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F59A7A609 FOREIGN KEY (image_entity_id) REFERENCES image_entity (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBF396750 FOREIGN KEY (id) REFERENCES commentable_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invest ADD CONSTRAINT FK_EB095F86F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE invest_picture ADD CONSTRAINT FK_5A511CF1C7065BD6 FOREIGN KEY (invest_id) REFERENCES invest (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE member_entity ADD CONSTRAINT FK_2AFEC65B1ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id)');
        $this->addSql('ALTER TABLE member_entity ADD CONSTRAINT FK_2AFEC65BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id)');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_349F3CAEC68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBF396750 FOREIGN KEY (id) REFERENCES commentable_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_evaluation ADD CONSTRAINT FK_305BACB44B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_evaluation ADD CONSTRAINT FK_305BACB4BF396750 FOREIGN KEY (id) REFERENCES evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile_picture ADD CONSTRAINT FK_C5659115A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE thumbnail ADD CONSTRAINT FK_C35726E64B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE thumbnail ADD CONSTRAINT FK_C35726E6BF396750 FOREIGN KEY (id) REFERENCES image_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A4767CB2 FOREIGN KEY (active_profile_picture_id) REFERENCES profile_picture (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BF396750 FOREIGN KEY (id) REFERENCES author (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF8B08B0');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C727ACA70');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F7AC3A854');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF675F31B');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F69DFB2F0');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FE51E9644');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FBF396750');
        $this->addSql('ALTER TABLE company_domaine DROP FOREIGN KEY FK_58FD101B979B1AD6');
        $this->addSql('ALTER TABLE company_domaine DROP FOREIGN KEY FK_58FD101B4272FC9F');
        $this->addSql('ALTER TABLE company_logo DROP FOREIGN KEY FK_A7E380FD979B1AD6');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638ED442CF4');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638CD53EDB6');
        $this->addSql('ALTER TABLE domaine_invest DROP FOREIGN KEY FK_E4E0EEA84272FC9F');
        $this->addSql('ALTER TABLE domaine_invest DROP FOREIGN KEY FK_E4E0EEA8C7065BD6');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F675F31B');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F59A7A609');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBF396750');
        $this->addSql('ALTER TABLE invest DROP FOREIGN KEY FK_EB095F86F675F31B');
        $this->addSql('ALTER TABLE invest_picture DROP FOREIGN KEY FK_5A511CF1C7065BD6');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EF675F31B');
        $this->addSql('ALTER TABLE member_entity DROP FOREIGN KEY FK_2AFEC65B1ADED311');
        $this->addSql('ALTER TABLE member_entity DROP FOREIGN KEY FK_2AFEC65BA76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF675F31B');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1ADED311');
        $this->addSql('ALTER TABLE pays DROP FOREIGN KEY FK_349F3CAEC68BE09C');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF675F31B');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBF396750');
        $this->addSql('ALTER TABLE post_evaluation DROP FOREIGN KEY FK_305BACB44B89032C');
        $this->addSql('ALTER TABLE post_evaluation DROP FOREIGN KEY FK_305BACB4BF396750');
        $this->addSql('ALTER TABLE profile_picture DROP FOREIGN KEY FK_C5659115A76ED395');
        $this->addSql('ALTER TABLE thumbnail DROP FOREIGN KEY FK_C35726E64B89032C');
        $this->addSql('ALTER TABLE thumbnail DROP FOREIGN KEY FK_C35726E6BF396750');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649708A0E0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A4767CB2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BF396750');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE commentable_entity');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_domaine');
        $this->addSql('DROP TABLE company_logo');
        $this->addSql('DROP TABLE company_size');
        $this->addSql('DROP TABLE company_type');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE domaine_invest');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_entity');
        $this->addSql('DROP TABLE invest');
        $this->addSql('DROP TABLE invest_picture');
        $this->addSql('DROP TABLE job_grade');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_type');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE member_entity');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_evaluation');
        $this->addSql('DROP TABLE profile_picture');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE thumbnail');
        $this->addSql('DROP TABLE user');
    }
}
