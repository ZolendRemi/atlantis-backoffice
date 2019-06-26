<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625133700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE devices_users DROP FOREIGN KEY FK_45B66B8667B3B43D');
        $this->addSql('ALTER TABLE users_devices DROP FOREIGN KEY FK_E1073A5067B3B43D');
        $this->addSql('CREATE TABLE stats (id INT AUTO_INCREMENT NOT NULL, sensor_id INT NOT NULL, date DATETIME NOT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_574767AAA247991F (sensor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stat_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AAA247991F FOREIGN KEY (sensor_id) REFERENCES sensors (id)');
        $this->addSql('DROP TABLE devices_users');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_devices');
        $this->addSql('ALTER TABLE sensors ADD stat_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sensors ADD CONSTRAINT FK_D0D3FA9021B6FB0A FOREIGN KEY (stat_type_id) REFERENCES stat_type (id)');
        $this->addSql('CREATE INDEX IDX_D0D3FA9021B6FB0A ON sensors (stat_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sensors DROP FOREIGN KEY FK_D0D3FA9021B6FB0A');
        $this->addSql('CREATE TABLE devices_users (devices_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_45B66B86665B0F2F (devices_id), INDEX IDX_45B66B8667B3B43D (users_id), PRIMARY KEY(devices_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, mail VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users_devices (users_id INT NOT NULL, devices_id INT NOT NULL, INDEX IDX_E1073A5067B3B43D (users_id), INDEX IDX_E1073A50665B0F2F (devices_id), PRIMARY KEY(users_id, devices_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE devices_users ADD CONSTRAINT FK_45B66B86665B0F2F FOREIGN KEY (devices_id) REFERENCES devices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devices_users ADD CONSTRAINT FK_45B66B8667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_devices ADD CONSTRAINT FK_E1073A50665B0F2F FOREIGN KEY (devices_id) REFERENCES devices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_devices ADD CONSTRAINT FK_E1073A5067B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE stats');
        $this->addSql('DROP TABLE stat_type');
        $this->addSql('DROP INDEX IDX_D0D3FA9021B6FB0A ON sensors');
        $this->addSql('ALTER TABLE sensors DROP stat_type_id');
    }
}
