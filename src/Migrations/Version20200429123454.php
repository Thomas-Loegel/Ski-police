<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429123454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competitor (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(70) NOT NULL, last_name VARCHAR(70) NOT NULL, birth_year INT NOT NULL, sexe VARCHAR(10) NOT NULL, mail VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, city VARCHAR(70) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, status VARCHAR(123) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competitor_team (competitor_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_51442AA478A5D405 (competitor_id), INDEX IDX_51442AA4296CD8AE (team_id), PRIMARY KEY(competitor_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, team_name VARCHAR(70) NOT NULL, city VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competitor_team ADD CONSTRAINT FK_51442AA478A5D405 FOREIGN KEY (competitor_id) REFERENCES competitor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competitor_team ADD CONSTRAINT FK_51442AA4296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competitor_team DROP FOREIGN KEY FK_51442AA478A5D405');
        $this->addSql('ALTER TABLE competitor_team DROP FOREIGN KEY FK_51442AA4296CD8AE');
        $this->addSql('DROP TABLE competitor');
        $this->addSql('DROP TABLE competitor_team');
        $this->addSql('DROP TABLE team');
    }
}
