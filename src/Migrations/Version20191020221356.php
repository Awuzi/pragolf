<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020221356 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition ADD minute_depart INT NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE date date VARCHAR(255) NOT NULL, CHANGE heure_depart heure_depart INT NOT NULL, CHANGE cadence cadence INT NOT NULL, CHANGE fichier fichier LONGBLOB NOT NULL, CHANGE nom_compet nom_compet LONGTEXT NOT NULL, CHANGE nom_golf nom_golf LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE golf CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition DROP minute_depart, CHANGE nom nom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE date date DATE DEFAULT \'NULL\', CHANGE heure_depart heure_depart TIME DEFAULT \'NULL\', CHANGE cadence cadence TIME DEFAULT \'NULL\', CHANGE fichier fichier LONGBLOB DEFAULT NULL, CHANGE nom_compet nom_compet LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_golf nom_golf LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE golf CHANGE nom nom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE lieu lieu VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles VARCHAR(50) NOT NULL COLLATE utf8mb4_bin');
    }
}
