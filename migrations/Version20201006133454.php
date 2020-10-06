<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006133454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stats DROP FOREIGN KEY FK_574767AA99E6F5DF');
        $this->addSql('ALTER TABLE stats DROP FOREIGN KEY FK_574767AAD6E2FADC');
        $this->addSql('ALTER TABLE stats CHANGE encounter_id encounter_id INT DEFAULT NULL, CHANGE redcard red_card INT NOT NULL');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AA99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AAD6E2FADC FOREIGN KEY (encounter_id) REFERENCES encounter (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stats DROP FOREIGN KEY FK_574767AAD6E2FADC');
        $this->addSql('ALTER TABLE stats DROP FOREIGN KEY FK_574767AA99E6F5DF');
        $this->addSql('ALTER TABLE stats CHANGE encounter_id encounter_id INT NOT NULL, CHANGE red_card redcard INT NOT NULL');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AAD6E2FADC FOREIGN KEY (encounter_id) REFERENCES encounter (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AA99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
