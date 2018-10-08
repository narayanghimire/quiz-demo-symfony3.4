<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181006205449 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer CHANGE createdAt createdAt DATETIME DEFAULT NULL, CHANGE lastModified lastModified DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE text text VARCHAR(255) DEFAULT NULL, CHANGE qAnswer qAnswer VARCHAR(255) DEFAULT NULL, CHANGE totalCorrect totalCorrect VARCHAR(255) DEFAULT NULL, CHANGE createdAt createdAt DATETIME DEFAULT NULL, CHANGE lastModified lastModified DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE round CHANGE score score VARCHAR(255) DEFAULT NULL, CHANGE createdAt createdAt DATETIME DEFAULT NULL, CHANGE lastModified lastModified DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE lastModified lastModified DATETIME NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE text text VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE qAnswer qAnswer VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE totalCorrect totalCorrect VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE lastModified lastModified DATETIME NOT NULL');
        $this->addSql('ALTER TABLE round CHANGE score score VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE lastModified lastModified DATETIME NOT NULL');
    }
}
