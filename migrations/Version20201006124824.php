<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006124824 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E422F783CC');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E44D4A63A8');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E468213C74');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E474EC1F4A');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E47A94939A');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E49A4BE4A9');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4C228F4FF');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4CC50782F');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4D09D5B11');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4E743AB23');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4F5F604CD');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E422F783CC FOREIGN KEY (pos9_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E44D4A63A8 FOREIGN KEY (pos3_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E468213C74 FOREIGN KEY (pos5_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E474EC1F4A FOREIGN KEY (pos11_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E47A94939A FOREIGN KEY (pos6_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E49A4BE4A9 FOREIGN KEY (pos8_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4C228F4FF FOREIGN KEY (pos7_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4CC50782F FOREIGN KEY (pos10_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4D09D5B11 FOREIGN KEY (pos4_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4E743AB23 FOREIGN KEY (pos1_id) REFERENCES player (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4F5F604CD FOREIGN KEY (pos2_id) REFERENCES player (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4E743AB23');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4F5F604CD');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E44D4A63A8');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4D09D5B11');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E468213C74');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E47A94939A');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4C228F4FF');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E49A4BE4A9');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E422F783CC');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E4CC50782F');
        $this->addSql('ALTER TABLE tactic DROP FOREIGN KEY FK_9FCCC8E474EC1F4A');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4E743AB23 FOREIGN KEY (pos1_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4F5F604CD FOREIGN KEY (pos2_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E44D4A63A8 FOREIGN KEY (pos3_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4D09D5B11 FOREIGN KEY (pos4_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E468213C74 FOREIGN KEY (pos5_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E47A94939A FOREIGN KEY (pos6_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4C228F4FF FOREIGN KEY (pos7_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E49A4BE4A9 FOREIGN KEY (pos8_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E422F783CC FOREIGN KEY (pos9_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E4CC50782F FOREIGN KEY (pos10_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tactic ADD CONSTRAINT FK_9FCCC8E474EC1F4A FOREIGN KEY (pos11_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
