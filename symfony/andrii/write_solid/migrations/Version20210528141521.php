<?php

declare(strict_types=1);

namespace Write_solid\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528141521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE andrii_write_solid_big_foot_sighting (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, latitude NUMERIC(9, 6) DEFAULT NULL, longitude NUMERIC(9, 6) DEFAULT NULL, created_at DATETIME NOT NULL, score INT NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_2A30F4907E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE andrii_write_solid_comment (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, big_foot_sighting_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C0CB5CD77E3C61F9 (owner_id), INDEX IDX_C0CB5CD7183C610D (big_foot_sighting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE andrii_write_solid_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(100) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, agreed_to_terms_at DATETIME NOT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_38DAEB65E7927C74 (email), UNIQUE INDEX UNIQ_38DAEB65F85E0677 (username), UNIQUE INDEX UNIQ_38DAEB65C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE andrii_write_solid_big_foot_sighting ADD CONSTRAINT FK_2A30F4907E3C61F9 FOREIGN KEY (owner_id) REFERENCES andrii_write_solid_user (id)'
        );
        $this->addSql(
            'ALTER TABLE andrii_write_solid_comment ADD CONSTRAINT FK_C0CB5CD77E3C61F9 FOREIGN KEY (owner_id) REFERENCES andrii_write_solid_user (id)'
        );
        $this->addSql(
            'ALTER TABLE andrii_write_solid_comment ADD CONSTRAINT FK_C0CB5CD7183C610D FOREIGN KEY (big_foot_sighting_id) REFERENCES andrii_write_solid_big_foot_sighting (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE andrii_write_solid_comment DROP FOREIGN KEY FK_C0CB5CD7183C610D');
        $this->addSql('ALTER TABLE andrii_write_solid_big_foot_sighting DROP FOREIGN KEY FK_2A30F4907E3C61F9');
        $this->addSql('ALTER TABLE andrii_write_solid_comment DROP FOREIGN KEY FK_C0CB5CD77E3C61F9');
        $this->addSql('DROP TABLE andrii_write_solid_big_foot_sighting');
        $this->addSql('DROP TABLE andrii_write_solid_comment');
        $this->addSql('DROP TABLE andrii_write_solid_user');
    }
}
