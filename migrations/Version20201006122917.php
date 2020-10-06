<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006122917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tactic CHANGE pos1_id pos1_id INT DEFAULT NULL, CHANGE pos2_id pos2_id INT DEFAULT NULL, CHANGE pos3_id pos3_id INT DEFAULT NULL, CHANGE pos4_id pos4_id INT DEFAULT NULL, CHANGE pos5_id pos5_id INT DEFAULT NULL, CHANGE pos6_id pos6_id INT DEFAULT NULL, CHANGE pos7_id pos7_id INT DEFAULT NULL, CHANGE pos8_id pos8_id INT DEFAULT NULL, CHANGE pos9_id pos9_id INT DEFAULT NULL, CHANGE pos10_id pos10_id INT DEFAULT NULL, CHANGE pos11_id pos11_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tactic CHANGE pos1_id pos1_id INT NOT NULL, CHANGE pos2_id pos2_id INT NOT NULL, CHANGE pos3_id pos3_id INT NOT NULL, CHANGE pos4_id pos4_id INT NOT NULL, CHANGE pos5_id pos5_id INT NOT NULL, CHANGE pos6_id pos6_id INT NOT NULL, CHANGE pos7_id pos7_id INT NOT NULL, CHANGE pos8_id pos8_id INT NOT NULL, CHANGE pos9_id pos9_id INT NOT NULL, CHANGE pos10_id pos10_id INT NOT NULL, CHANGE pos11_id pos11_id INT NOT NULL');
    }
}
