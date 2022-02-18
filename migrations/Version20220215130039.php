<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215130039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7ED96F597B');
        $this->addSql('DROP TABLE checks');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7E9B177F54');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7ED96F597B');
        $this->addSql('DROP INDEX IDX_402C8E7E9B177F54 ON reservation_hotel');
        $this->addSql('ALTER TABLE reservation_hotel CHANGE chambre_id hotel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7E3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7ED96F597B FOREIGN KEY (checks_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_402C8E7E3243BB18 ON reservation_hotel (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE checks (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, check_in DATE NOT NULL, check_out DATE NOT NULL, adult INT NOT NULL, children INT DEFAULT NULL, INDEX IDX_42C8495554177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE checks ADD CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495554177093');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7E3243BB18');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7ED96F597B');
        $this->addSql('DROP INDEX IDX_402C8E7E3243BB18 ON reservation_hotel');
        $this->addSql('ALTER TABLE reservation_hotel CHANGE hotel_id chambre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7E9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7ED96F597B FOREIGN KEY (checks_id) REFERENCES checks (id)');
        $this->addSql('CREATE INDEX IDX_402C8E7E9B177F54 ON reservation_hotel (chambre_id)');
    }
}
