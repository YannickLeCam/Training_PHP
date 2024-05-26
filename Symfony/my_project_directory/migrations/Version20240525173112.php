<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525173112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe AS SELECT id, title, slug, content, created_at, duration, nb_personne, ingredients FROM recipe');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('CREATE TABLE recipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title CLOB NOT NULL, slug CLOB NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , duration INTEGER DEFAULT NULL, nb_personne INTEGER , ingredients CLOB)');
        $this->addSql('INSERT INTO recipe (id, title, slug, content, created_at, duration, nb_personne, ingredients) SELECT id, title, slug, content, created_at, duration, nb_personne, ingredients FROM __temp__recipe');
        $this->addSql('DROP TABLE __temp__recipe');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe AS SELECT id, title, slug, content, created_at, duration, nb_personne, ingredients FROM recipe');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('CREATE TABLE recipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title CLOB NOT NULL, slug CLOB NOT NULL, content CLOB DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , duration INTEGER DEFAULT NULL, nb_personne INTEGER DEFAULT NULL, ingredients CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO recipe (id, title, slug, content, created_at, duration, nb_personne, ingredients) SELECT id, title, slug, content, created_at, duration, nb_personne, ingredients FROM __temp__recipe');
        $this->addSql('DROP TABLE __temp__recipe');
    }
}
