<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180407195757 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE artist (id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, photo BLOB NOT NULL, description CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "release" (id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, art BLOB NOT NULL, description CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE song (id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, file BLOB NOT NULL, PRIMARY KEY(id))');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE "release"');
        $this->addSql('DROP TABLE song');
    }
}
