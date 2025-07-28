<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250728192354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE condicion_iva (id SERIAL NOT NULL, codigo SMALLINT NOT NULL, condicion_iva VARCHAR(50) NOT NULL, alicuota NUMERIC(10, 3) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4B7978820332D99 ON condicion_iva (codigo)');
        $this->addSql('CREATE TABLE producto_servicio (id SERIAL NOT NULL, id_rubro INT NOT NULL, id_unidad_medida INT NOT NULL, id_condicion_iva INT NOT NULL, tipo VARCHAR(1) DEFAULT NULL, codigo VARCHAR(20) DEFAULT NULL, producto_servicio VARCHAR(255) DEFAULT NULL, precio_bruto_unitario NUMERIC(30, 2) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E31583FF7C032DDF ON producto_servicio (id_rubro)');
        $this->addSql('CREATE INDEX IDX_E31583FFC38BC206 ON producto_servicio (id_unidad_medida)');
        $this->addSql('CREATE INDEX IDX_E31583FF7A9F46ED ON producto_servicio (id_condicion_iva)');
        $this->addSql('COMMENT ON COLUMN producto_servicio.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE rubro (id SERIAL NOT NULL, rubro VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE unidad_medida (id SERIAL NOT NULL, codigo VARCHAR(5) NOT NULL, unidad_medida VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7DA3136320332D99 ON unidad_medida (codigo)');
        $this->addSql('ALTER TABLE producto_servicio ADD CONSTRAINT FK_E31583FF7C032DDF FOREIGN KEY (id_rubro) REFERENCES rubro (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto_servicio ADD CONSTRAINT FK_E31583FFC38BC206 FOREIGN KEY (id_unidad_medida) REFERENCES unidad_medida (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto_servicio ADD CONSTRAINT FK_E31583FF7A9F46ED FOREIGN KEY (id_condicion_iva) REFERENCES condicion_iva (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE producto_servicio DROP CONSTRAINT FK_E31583FF7C032DDF');
        $this->addSql('ALTER TABLE producto_servicio DROP CONSTRAINT FK_E31583FFC38BC206');
        $this->addSql('ALTER TABLE producto_servicio DROP CONSTRAINT FK_E31583FF7A9F46ED');
        $this->addSql('DROP TABLE condicion_iva');
        $this->addSql('DROP TABLE producto_servicio');
        $this->addSql('DROP TABLE rubro');
        $this->addSql('DROP TABLE unidad_medida');
    }
}
