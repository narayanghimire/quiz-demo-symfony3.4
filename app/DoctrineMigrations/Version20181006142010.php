<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181006142010 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE fname fname VARCHAR(255) DEFAULT NULL, CHANGE lname lname VARCHAR(255) DEFAULT NULL, CHANGE createdAt createdAt DATETIME DEFAULT NULL, CHANGE lastModified lastModified DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE fname fname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE lname lname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE lastModified lastModified DATETIME NOT NULL');
    }
}
