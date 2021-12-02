<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118144147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE salle_sport_categories');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle_sport_categories (salle_sport_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_9B37BF34B039EBF6 (salle_sport_id), INDEX IDX_9B37BF34A21214B7 (categories_id), PRIMARY KEY(salle_sport_id, categories_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE salle_sport_categories ADD CONSTRAINT FK_9B37BF34A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_sport_categories ADD CONSTRAINT FK_9B37BF34B039EBF6 FOREIGN KEY (salle_sport_id) REFERENCES salle_sport (id) ON DELETE CASCADE');
    }
}
