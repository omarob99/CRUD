<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303074120 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE students_grades ADD student_id INT DEFAULT NULL, ADD classes VARCHAR(255) NOT NULL, ADD type VARCHAR(255) NOT NULL, DROP student');
        $this->addSql('ALTER TABLE students_grades ADD CONSTRAINT FK_803F4472CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_803F4472CB944F1A ON students_grades (student_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE students_grades DROP FOREIGN KEY FK_803F4472CB944F1A');
        $this->addSql('DROP INDEX IDX_803F4472CB944F1A ON students_grades');
        $this->addSql('ALTER TABLE students_grades ADD student INT NOT NULL, DROP student_id, DROP classes, DROP type');
    }
}
