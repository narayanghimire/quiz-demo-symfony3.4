<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181006125608 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25534B549B');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A258337E7D7');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25C8DA168D');
        $this->addSql('DROP INDEX IDX_DADD4A25534B549B ON answer');
        $this->addSql('DROP INDEX IDX_DADD4A25C8DA168D ON answer');
        $this->addSql('DROP INDEX IDX_DADD4A258337E7D7 ON answer');
        $this->addSql('ALTER TABLE answer ADD user_id INT DEFAULT NULL, ADD question_id INT DEFAULT NULL, ADD quiz_id INT DEFAULT NULL, DROP uid_id, DROP quiz_id_id, DROP qid_id');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25853CD175 FOREIGN KEY (quiz_id) REFERENCES round (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25A76ED395 ON answer (user_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25853CD175 ON answer (quiz_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25A76ED395');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25853CD175');
        $this->addSql('DROP INDEX IDX_DADD4A25A76ED395 ON answer');
        $this->addSql('DROP INDEX IDX_DADD4A251E27F6BF ON answer');
        $this->addSql('DROP INDEX IDX_DADD4A25853CD175 ON answer');
        $this->addSql('ALTER TABLE answer ADD uid_id INT DEFAULT NULL, ADD quiz_id_id INT DEFAULT NULL, ADD qid_id INT DEFAULT NULL, DROP user_id, DROP question_id, DROP quiz_id');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25534B549B FOREIGN KEY (uid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A258337E7D7 FOREIGN KEY (quiz_id_id) REFERENCES round (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25C8DA168D FOREIGN KEY (qid_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25534B549B ON answer (uid_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25C8DA168D ON answer (qid_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A258337E7D7 ON answer (quiz_id_id)');
    }
}
