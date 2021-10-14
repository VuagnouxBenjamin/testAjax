<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211010134119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bye_likes (id INT AUTO_INCREMENT NOT NULL, bye_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_8C3D573795C4965F (bye_id), INDEX IDX_8C3D5737A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bye_likes ADD CONSTRAINT FK_8C3D573795C4965F FOREIGN KEY (bye_id) REFERENCES bye (id)');
        $this->addSql('ALTER TABLE bye_likes ADD CONSTRAINT FK_8C3D5737A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bye_likes');
    }
}
