<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706232422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE empleador (id INT AUTO_INCREMENT NOT NULL, apellido VARCHAR(255) DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, dni VARCHAR(255) NOT NULL, cuitcuil VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE persona ADD empleador_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT FK_51E5B69B7981C10B FOREIGN KEY (empleador_id) REFERENCES empleador (id)');
        $this->addSql('CREATE INDEX IDX_51E5B69B7981C10B ON persona (empleador_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE persona DROP FOREIGN KEY FK_51E5B69B7981C10B');
        $this->addSql('DROP TABLE empleador');
        $this->addSql('DROP INDEX IDX_51E5B69B7981C10B ON persona');
        $this->addSql('ALTER TABLE persona DROP empleador_id');
    }
}
