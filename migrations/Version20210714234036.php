<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714234036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC746EBF93B');
        $this->addSql('DROP INDEX UNIQ_B6B12EC746EBF93B ON documento');
        $this->addSql('ALTER TABLE documento DROP archivo_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documento ADD archivo_id INT NOT NULL');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC746EBF93B FOREIGN KEY (archivo_id) REFERENCES formulario (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6B12EC746EBF93B ON documento (archivo_id)');
    }
}
