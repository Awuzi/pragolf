<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191012151250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, golf_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date DATE NOT NULL, heure_depart TIME NOT NULL, INDEX IDX_B50A2CB1F1503E2B (golf_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE golf (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, competition_id INT NOT NULL, heure_depart TIME NOT NULL, INDEX IDX_59B1F3D7B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trou (id INT AUTO_INCREMENT NOT NULL, golf_id INT NOT NULL, numero INT NOT NULL, temps_ref TIME NOT NULL, par INT NOT NULL, INDEX IDX_5066A632F1503E2B (golf_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trou_partie (id INT AUTO_INCREMENT NOT NULL, trou_id INT NOT NULL, partie_id INT NOT NULL, depassement TIME DEFAULT NULL, INDEX IDX_D16E33791D222B9C (trou_id), INDEX IDX_D16E3379E075F7A4 (partie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1F1503E2B FOREIGN KEY (golf_id) REFERENCES golf (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE trou ADD CONSTRAINT FK_5066A632F1503E2B FOREIGN KEY (golf_id) REFERENCES golf (id)');
        $this->addSql('ALTER TABLE trou_partie ADD CONSTRAINT FK_D16E33791D222B9C FOREIGN KEY (trou_id) REFERENCES trou (id)');
        $this->addSql('ALTER TABLE trou_partie ADD CONSTRAINT FK_D16E3379E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D7B39D312');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1F1503E2B');
        $this->addSql('ALTER TABLE trou DROP FOREIGN KEY FK_5066A632F1503E2B');
        $this->addSql('ALTER TABLE trou_partie DROP FOREIGN KEY FK_D16E3379E075F7A4');
        $this->addSql('ALTER TABLE trou_partie DROP FOREIGN KEY FK_D16E33791D222B9C');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE golf');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE trou');
        $this->addSql('DROP TABLE trou_partie');
    }
}
