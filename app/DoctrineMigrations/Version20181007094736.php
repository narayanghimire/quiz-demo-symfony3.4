<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181007094736 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA341E27F6BF');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP INDEX IDX_DADD4A251E27F6BF ON answer');
        $this->addSql('ALTER TABLE answer ADD fname VARCHAR(255) DEFAULT NULL, DROP question_id');
        $this->addSql('DROP INDEX IDX_C5EEEA341E27F6BF ON round');
        $this->addSql('ALTER TABLE round DROP question_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, text VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, qAnswer VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, totalCorrect VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, createdAt DATETIME DEFAULT NULL, lastModified DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD question_id INT DEFAULT NULL, DROP fname');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('ALTER TABLE round ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA341E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_C5EEEA341E27F6BF ON round (question_id)');
    }
}
