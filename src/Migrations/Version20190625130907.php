<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625130907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sensors (id INT AUTO_INCREMENT NOT NULL, device_id INT NOT NULL, type VARCHAR(255) NOT NULL, uid VARCHAR(255) NOT NULL, INDEX IDX_D0D3FA9094A4C7D4 (device_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sensors ADD CONSTRAINT FK_D0D3FA9094A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id)');
        $this->addSql('DROP TABLE sensor');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sensor (id INT AUTO_INCREMENT NOT NULL, device_id INT NOT NULL, type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, uid VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_BC8617B094A4C7D4 (device_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B094A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id)');
        $this->addSql('DROP TABLE sensors');
    }
}
