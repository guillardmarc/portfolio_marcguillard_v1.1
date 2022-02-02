<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220202153252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achievements (id INT AUTO_INCREMENT NOT NULL, applicant_id INT DEFAULT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, statut VARCHAR(255) NOT NULL, git_link VARCHAR(255) NOT NULL, http_link VARCHAR(255) DEFAULT NULL, release_date DATE DEFAULT NULL, update_date DATE DEFAULT NULL, INDEX IDX_D1227EFE97139001 (applicant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE achievements_web_technologies (achievements_id INT NOT NULL, web_technologies_id INT NOT NULL, INDEX IDX_1BC7E8EBBDC78EA7 (achievements_id), INDEX IDX_1BC7E8EB52FA352F (web_technologies_id), PRIMARY KEY(achievements_id, web_technologies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achievements ADD CONSTRAINT FK_D1227EFE97139001 FOREIGN KEY (applicant_id) REFERENCES establishments (id)');
        $this->addSql('ALTER TABLE achievements_web_technologies ADD CONSTRAINT FK_1BC7E8EBBDC78EA7 FOREIGN KEY (achievements_id) REFERENCES achievements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achievements_web_technologies ADD CONSTRAINT FK_1BC7E8EB52FA352F FOREIGN KEY (web_technologies_id) REFERENCES web_technologies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_achievements ADD achievements_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture_achievements ADD CONSTRAINT FK_E8BF8579BDC78EA7 FOREIGN KEY (achievements_id) REFERENCES achievements (id)');
        $this->addSql('CREATE INDEX IDX_E8BF8579BDC78EA7 ON picture_achievements (achievements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achievements_web_technologies DROP FOREIGN KEY FK_1BC7E8EBBDC78EA7');
        $this->addSql('ALTER TABLE picture_achievements DROP FOREIGN KEY FK_E8BF8579BDC78EA7');
        $this->addSql('DROP TABLE achievements');
        $this->addSql('DROP TABLE achievements_web_technologies');
        $this->addSql('ALTER TABLE establishments CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE http_link http_link VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone VARCHAR(13) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture_link picture_link VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hobbies CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture_link picture_link VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_E8BF8579BDC78EA7 ON picture_achievements');
        $this->addSql('ALTER TABLE picture_achievements DROP achievements_id, CHANGE link link VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE presentations CHANGE last_name last_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone VARCHAR(13) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE job job VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture_link picture_link VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE update_websites CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE web_technologies CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture_link picture_link VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE websites CHANGE regulation regulation LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE copyright copyright VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE version version VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
