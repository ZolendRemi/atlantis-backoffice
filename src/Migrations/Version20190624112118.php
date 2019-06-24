<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190624112118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B014917BF3');
        $this->addSql('DROP INDEX UNIQ_BC8617B014917BF3 ON sensor');
        $this->addSql('ALTER TABLE sensor CHANGE date date DATETIME NOT NULL, CHANGE id_device_id device_id INT NOT NULL');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B094A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BC8617B094A4C7D4 ON sensor (device_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B094A4C7D4');
        $this->addSql('DROP INDEX UNIQ_BC8617B094A4C7D4 ON sensor');
        $this->addSql('ALTER TABLE sensor CHANGE date date DATE NOT NULL, CHANGE device_id id_device_id INT NOT NULL');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B014917BF3 FOREIGN KEY (id_device_id) REFERENCES devices (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BC8617B014917BF3 ON sensor (id_device_id)');
    }
}
