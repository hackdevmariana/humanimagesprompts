<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260817110530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garment ADD COLUMN label VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__garment AS SELECT name, category, sub_category, fit, fabric, primary_color, secondary_color, pattern, tags, id, created_at, updated_at FROM garment');
        $this->addSql('DROP TABLE garment');
        $this->addSql('CREATE TABLE garment (name VARCHAR(255) NOT NULL, category VARCHAR(20) NOT NULL, sub_category VARCHAR(100) NOT NULL, fit VARCHAR(20) NOT NULL, fabric CLOB DEFAULT \'{}\' NOT NULL, primary_color CLOB DEFAULT \'{}\' NOT NULL, secondary_color CLOB DEFAULT NULL, pattern VARCHAR(30) DEFAULT NULL, tags CLOB DEFAULT \'[]\' NOT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (id))');
        $this->addSql('INSERT INTO garment (name, category, sub_category, fit, fabric, primary_color, secondary_color, pattern, tags, id, created_at, updated_at) SELECT name, category, sub_category, fit, fabric, primary_color, secondary_color, pattern, tags, id, created_at, updated_at FROM __temp__garment');
        $this->addSql('DROP TABLE __temp__garment');
    }
}
