<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181006125008 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, uid_id INT DEFAULT NULL, qid_id INT DEFAULT NULL, quiz_id_id INT DEFAULT NULL, answer VARCHAR(255) NOT NULL, correct TINYINT(1) NOT NULL, INDEX IDX_DADD4A25534B549B (uid_id), INDEX IDX_DADD4A25C8DA168D (qid_id), INDEX IDX_DADD4A258337E7D7 (quiz_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE round (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, user_id INT DEFAULT NULL, score VARCHAR(255) NOT NULL, INDEX IDX_C5EEEA341E27F6BF (question_id), INDEX IDX_C5EEEA34A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25534B549B FOREIGN KEY (uid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25C8DA168D FOREIGN KEY (qid_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A258337E7D7 FOREIGN KEY (quiz_id_id) REFERENCES round (id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA341E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA34A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question CHANGE type type enum(\'question\', \'answer\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A258337E7D7');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE round');
        $this->addSql('ALTER TABLE question CHANGE type type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
