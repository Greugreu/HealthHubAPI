<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617132731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stats_bio ALTER weight TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE stats_bio ALTER weight DROP DEFAULT');
        $this->addSql('ALTER TABLE stats_bio ALTER height TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE stats_bio ALTER height DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE stats_bio ALTER weight TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE stats_bio ALTER weight DROP DEFAULT');
        $this->addSql('ALTER TABLE stats_bio ALTER height TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE stats_bio ALTER height DROP DEFAULT');
    }
}
