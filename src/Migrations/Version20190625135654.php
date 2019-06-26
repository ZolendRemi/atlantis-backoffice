<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625135654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sensors DROP FOREIGN KEY FK_D0D3FA9021B6FB0A');
        $this->addSql('DROP INDEX IDX_D0D3FA9021B6FB0A ON sensors');
        $this->addSql('ALTER TABLE sensors DROP stat_type_id');
        $this->addSql('ALTER TABLE stats ADD stat_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AA21B6FB0A FOREIGN KEY (stat_type_id) REFERENCES stat_type (id)');
        $this->addSql('CREATE INDEX IDX_574767AA21B6FB0A ON stats (stat_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sensors ADD stat_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sensors ADD CONSTRAINT FK_D0D3FA9021B6FB0A FOREIGN KEY (stat_type_id) REFERENCES stat_type (id)');
        $this->addSql('CREATE INDEX IDX_D0D3FA9021B6FB0A ON sensors (stat_type_id)');
        $this->addSql('ALTER TABLE stats DROP FOREIGN KEY FK_574767AA21B6FB0A');
        $this->addSql('DROP INDEX IDX_574767AA21B6FB0A ON stats');
        $this->addSql('ALTER TABLE stats DROP stat_type_id');
    }
}
