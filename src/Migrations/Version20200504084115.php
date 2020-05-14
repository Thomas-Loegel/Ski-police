<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504084115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, teams_id INT DEFAULT NULL, year DATE NOT NULL, edition_number INT NOT NULL, station VARCHAR(255) NOT NULL, INDEX IDX_A891181FD6365F12 (teams_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition_race (edition_id INT NOT NULL, race_id INT NOT NULL, INDEX IDX_6A5850B174281A5E (edition_id), INDEX IDX_6A5850B16E59D40D (race_id), PRIMARY KEY(edition_id, race_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(123) NOT NULL, discipline VARCHAR(123) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race_competitor (race_id INT NOT NULL, competitor_id INT NOT NULL, INDEX IDX_830AD1336E59D40D (race_id), INDEX IDX_830AD13378A5D405 (competitor_id), PRIMARY KEY(race_id, competitor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE time (id INT AUTO_INCREMENT NOT NULL, attemp1 INT DEFAULT NULL, attemp2 INT DEFAULT NULL, status_attemp1 VARCHAR(70) DEFAULT NULL, status_attemp2 VARCHAR(70) DEFAULT NULL, penality1 INT DEFAULT NULL, penality2 INT DEFAULT NULL, jersey_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, competitors_id INT DEFAULT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, status INT NOT NULL, UNIQUE INDEX UNIQ_8D93D6499763EC7E (competitors_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181FD6365F12 FOREIGN KEY (teams_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE edition_race ADD CONSTRAINT FK_6A5850B174281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE edition_race ADD CONSTRAINT FK_6A5850B16E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_competitor ADD CONSTRAINT FK_830AD1336E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_competitor ADD CONSTRAINT FK_830AD13378A5D405 FOREIGN KEY (competitor_id) REFERENCES competitor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499763EC7E FOREIGN KEY (competitors_id) REFERENCES competitor (id)');
        $this->addSql('ALTER TABLE competitor ADD time_id INT DEFAULT NULL, DROP mail, DROP password');
        $this->addSql('ALTER TABLE competitor ADD CONSTRAINT FK_E0D53BAA5EEADD3B FOREIGN KEY (time_id) REFERENCES time (id)');
        $this->addSql('CREATE INDEX IDX_E0D53BAA5EEADD3B ON competitor (time_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE edition_race DROP FOREIGN KEY FK_6A5850B174281A5E');
        $this->addSql('ALTER TABLE edition_race DROP FOREIGN KEY FK_6A5850B16E59D40D');
        $this->addSql('ALTER TABLE race_competitor DROP FOREIGN KEY FK_830AD1336E59D40D');
        $this->addSql('ALTER TABLE competitor DROP FOREIGN KEY FK_E0D53BAA5EEADD3B');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE edition_race');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_competitor');
        $this->addSql('DROP TABLE time');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_E0D53BAA5EEADD3B ON competitor');
        $this->addSql('ALTER TABLE competitor ADD mail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP time_id');
    }
}
