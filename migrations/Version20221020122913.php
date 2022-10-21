<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221020122913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD formateur_id INT NOT NULL, ADD centre_id INT NOT NULL, ADD promo_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE155D8F51 FOREIGN KEY (formateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDED0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE155D8F51 ON booking (formateur_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE463CD7C3 ON booking (centre_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDED0C07AFF ON booking (promo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE155D8F51');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE463CD7C3');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDED0C07AFF');
        $this->addSql('DROP INDEX IDX_E00CEDDE155D8F51 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE463CD7C3 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDED0C07AFF ON booking');
        $this->addSql('ALTER TABLE booking DROP formateur_id, DROP centre_id, DROP promo_id');
    }
}
