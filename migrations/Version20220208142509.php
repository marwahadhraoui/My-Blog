<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208142509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_hotel ADD chambre_id INT DEFAULT NULL, ADD checks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7E9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7ED96F597B FOREIGN KEY (checks_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_402C8E7E9B177F54 ON reservation_hotel (chambre_id)');
        $this->addSql('CREATE INDEX IDX_402C8E7ED96F597B ON reservation_hotel (checks_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE chambre CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE client CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hotel CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE post CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7E9B177F54');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7ED96F597B');
        $this->addSql('DROP INDEX IDX_402C8E7E9B177F54 ON reservation_hotel');
        $this->addSql('DROP INDEX IDX_402C8E7ED96F597B ON reservation_hotel');
        $this->addSql('ALTER TABLE reservation_hotel DROP chambre_id, DROP checks_id, CHANGE nom_client nom_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom_client prenom_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse_client adresse_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE service CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
