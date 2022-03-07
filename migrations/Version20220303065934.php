<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303065934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student ADD target_id INT DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33158E0B66 FOREIGN KEY (target_id) REFERENCES students_grades (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33158E0B66 ON student (target_id)');
        $this->addSql('ALTER TABLE students_grades DROP student, DROP course');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33158E0B66');
        $this->addSql('DROP INDEX UNIQ_B723AF33158E0B66 ON student');
        $this->addSql('ALTER TABLE student DROP target_id, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE students_grades ADD student INT NOT NULL, ADD course VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
