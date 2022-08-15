<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815014435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, major_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, describle VARCHAR(255) NOT NULL, INDEX IDX_497D309DE93695C7 (major_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, describle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_teacher (course_id INT NOT NULL, teacher_id INT NOT NULL, INDEX IDX_B835A339591CC992 (course_id), INDEX IDX_B835A33941807E1D (teacher_id), PRIMARY KEY(course_id, teacher_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_student (course_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_BFE0AADF591CC992 (course_id), INDEX IDX_BFE0AADFCB944F1A (student_id), PRIMARY KEY(course_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, course_id INT DEFAULT NULL, grade DOUBLE PRECISION NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_595AAE34CB944F1A (student_id), INDEX IDX_595AAE3441807E1D (teacher_id), INDEX IDX_595AAE34591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE major (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, describle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, major_id INT DEFAULT NULL, classroom_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, brithday DATE NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, studentid VARCHAR(255) NOT NULL, INDEX IDX_B723AF33E93695C7 (major_id), INDEX IDX_B723AF336278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, birthday DATE NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309DE93695C7 FOREIGN KEY (major_id) REFERENCES major (id)');
        $this->addSql('ALTER TABLE course_teacher ADD CONSTRAINT FK_B835A339591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_teacher ADD CONSTRAINT FK_B835A33941807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_student ADD CONSTRAINT FK_BFE0AADF591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_student ADD CONSTRAINT FK_BFE0AADFCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE34CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE3441807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE34591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33E93695C7 FOREIGN KEY (major_id) REFERENCES major (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom DROP FOREIGN KEY FK_497D309DE93695C7');
        $this->addSql('ALTER TABLE course_teacher DROP FOREIGN KEY FK_B835A339591CC992');
        $this->addSql('ALTER TABLE course_teacher DROP FOREIGN KEY FK_B835A33941807E1D');
        $this->addSql('ALTER TABLE course_student DROP FOREIGN KEY FK_BFE0AADF591CC992');
        $this->addSql('ALTER TABLE course_student DROP FOREIGN KEY FK_BFE0AADFCB944F1A');
        $this->addSql('ALTER TABLE grade DROP FOREIGN KEY FK_595AAE34CB944F1A');
        $this->addSql('ALTER TABLE grade DROP FOREIGN KEY FK_595AAE3441807E1D');
        $this->addSql('ALTER TABLE grade DROP FOREIGN KEY FK_595AAE34591CC992');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33E93695C7');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336278D5A8');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_teacher');
        $this->addSql('DROP TABLE course_student');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE major');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE user');
    }
}
