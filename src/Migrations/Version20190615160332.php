<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190615160332 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE devices_users');
        $this->addSql('ALTER TABLE devices ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devices ADD CONSTRAINT FK_11074E9A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_11074E9A67B3B43D ON devices (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE devices_users (devices_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_45B66B86665B0F2F (devices_id), INDEX IDX_45B66B8667B3B43D (users_id), PRIMARY KEY(devices_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE devices_users ADD CONSTRAINT FK_45B66B86665B0F2F FOREIGN KEY (devices_id) REFERENCES devices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devices_users ADD CONSTRAINT FK_45B66B8667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devices DROP FOREIGN KEY FK_11074E9A67B3B43D');
        $this->addSql('DROP INDEX IDX_11074E9A67B3B43D ON devices');
        $this->addSql('ALTER TABLE devices DROP users_id');
    }
}
