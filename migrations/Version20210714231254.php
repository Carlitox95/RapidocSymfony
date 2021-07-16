<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714231254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC741CFE234');
        $this->addSql('DROP INDEX IDX_B6B12EC741CFE234 ON documento');
        $this->addSql('ALTER TABLE documento CHANGE formulario_id archivo_id INT NOT NULL');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC746EBF93B FOREIGN KEY (archivo_id) REFERENCES formulario (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6B12EC746EBF93B ON documento (archivo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC746EBF93B');
        $this->addSql('DROP INDEX UNIQ_B6B12EC746EBF93B ON documento');
        $this->addSql('ALTER TABLE documento CHANGE archivo_id formulario_id INT NOT NULL');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC741CFE234 FOREIGN KEY (formulario_id) REFERENCES formulario (id)');
        $this->addSql('CREATE INDEX IDX_B6B12EC741CFE234 ON documento (formulario_id)');
    }
}
