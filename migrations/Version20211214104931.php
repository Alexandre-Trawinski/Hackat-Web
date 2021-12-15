<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214104931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE InscriptionHackathon CHANGE idHackathon idHackathon INT DEFAULT NULL, CHANGE idParticipant idParticipant INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY evenement_ibfk_1');
        $this->addSql('ALTER TABLE evenement DROP type, CHANGE idHackathon idHackathon INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E77D0DD19 FOREIGN KEY (idHackathon) REFERENCES hackathon (idHackathon)');
        $this->addSql('ALTER TABLE participant ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE InscriptionHackathon CHANGE idParticipant idParticipant INT NOT NULL, CHANGE idHackathon idHackathon INT NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E77D0DD19');
        $this->addSql('ALTER TABLE evenement ADD type VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE idHackathon idHackathon INT NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT evenement_ibfk_1 FOREIGN KEY (idHackathon) REFERENCES hackathon (idHackathon) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant DROP roles');
    }
}
