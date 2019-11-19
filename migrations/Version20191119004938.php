<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191119004938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE parameter_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE parameter (id INT NOT NULL, code VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE item_parameter (item_id INT NOT NULL, parameter_id INT NOT NULL, PRIMARY KEY(item_id, parameter_id))');
        $this->addSql('CREATE INDEX IDX_264D87E0126F525E ON item_parameter (item_id)');
        $this->addSql('CREATE INDEX IDX_264D87E07C56DBD6 ON item_parameter (parameter_id)');
        $this->addSql('ALTER TABLE item_parameter ADD CONSTRAINT FK_264D87E0126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_parameter ADD CONSTRAINT FK_264D87E07C56DBD6 FOREIGN KEY (parameter_id) REFERENCES parameter (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM1', 'Parameter 1')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM2', 'Parameter 2')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM3', 'Parameter 3')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM4', 'Parameter 4')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM5', 'Parameter 5')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM6', 'Parameter 6')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM7', 'Parameter 7')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM8', 'Parameter 8')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM9', 'Parameter 9')");
        $this->addSql("INSERT INTO parameter (id, code, name) VALUES (nextval('parameter_id_seq'), 'PARAM10', 'Parameter 10')");

        $this->addSql("INSERT INTO item (id, name) VALUES (nextval('item_id_seq'), 'Item 1')");

        $this->addSql("INSERT INTO item_parameter (item_id, parameter_id) VALUES (1,1)");
        $this->addSql("INSERT INTO item_parameter (item_id, parameter_id) VALUES (1,2)");
        $this->addSql("INSERT INTO item_parameter (item_id, parameter_id) VALUES (1,3)");
        $this->addSql("INSERT INTO item_parameter (item_id, parameter_id) VALUES (1,4)");
        $this->addSql("INSERT INTO item_parameter (item_id, parameter_id) VALUES (1,5)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE item_parameter DROP CONSTRAINT FK_264D87E07C56DBD6');
        $this->addSql('ALTER TABLE item_parameter DROP CONSTRAINT FK_264D87E0126F525E');
        $this->addSql('DROP SEQUENCE parameter_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_parameter');
    }
}
