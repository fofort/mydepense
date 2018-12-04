<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181126204918 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__depense AS SELECT id, id_shop, amount, date_buy FROM depense');
        $this->addSql('DROP TABLE depense');
        $this->addSql('CREATE TABLE depense (id INTEGER NOT NULL, id_shop INTEGER NOT NULL, amount NUMERIC(10, 0) NOT NULL, date_buy DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO depense (id, id_shop, amount, date_buy) SELECT id, id_shop, amount, date_buy FROM __temp__depense');
        $this->addSql('DROP TABLE __temp__depense');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shop AS SELECT id, name, address, id_type FROM shop');
        $this->addSql('DROP TABLE shop');
        $this->addSql('CREATE TABLE shop (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, address INTEGER DEFAULT 0 NOT NULL, id_type INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO shop (id, name, address, id_type) SELECT id, name, address, id_type FROM __temp__shop');
        $this->addSql('DROP TABLE __temp__shop');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__depense AS SELECT id, id_shop, amount, date_buy FROM depense');
        $this->addSql('DROP TABLE depense');
        $this->addSql('CREATE TABLE depense (id INTEGER NOT NULL, id_shop INTEGER NOT NULL, amount NUMERIC(10, 0) NOT NULL, date_buy DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO depense (id, id_shop, amount, date_buy) SELECT id, id_shop, amount, date_buy FROM __temp__depense');
        $this->addSql('DROP TABLE __temp__depense');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shop AS SELECT id, name, address, id_type FROM shop');
        $this->addSql('DROP TABLE shop');
        $this->addSql('CREATE TABLE shop (id INTEGER NOT NULL, name INTEGER NOT NULL, address INTEGER NOT NULL, id_type INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO shop (id, name, address, id_type) SELECT id, name, address, id_type FROM __temp__shop');
        $this->addSql('DROP TABLE __temp__shop');
    }
}
