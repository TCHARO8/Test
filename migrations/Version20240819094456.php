<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240819094456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service ADD departement_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2EAE6F2D2 FOREIGN KEY (departement_id_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2EAE6F2D2 ON service (departement_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2EAE6F2D2');
        $this->addSql('DROP INDEX IDX_E19D9AD2EAE6F2D2 ON service');
        $this->addSql('ALTER TABLE service DROP departement_id_id');
    }
}
