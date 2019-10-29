<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191028202551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE upload_trou (id INT AUTO_INCREMENT NOT NULL, golf_id INT DEFAULT NULL, trou1 INT DEFAULT NULL, trou2 INT DEFAULT NULL, trou3 INT DEFAULT NULL, trou4 INT DEFAULT NULL, trou5 INT DEFAULT NULL, trou6 INT DEFAULT NULL, trou7 INT DEFAULT NULL, trou8 INT DEFAULT NULL, trou9 INT DEFAULT NULL, trou10 INT DEFAULT NULL, trou11 INT DEFAULT NULL, trou12 INT DEFAULT NULL, trou13 INT DEFAULT NULL, trou14 INT DEFAULT NULL, trou15 INT DEFAULT NULL, trou16 INT DEFAULT NULL, trou17 INT DEFAULT NULL, trou18 INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE upload_trou');
    }
}
