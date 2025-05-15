<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515110552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE ressource_tag (ressource_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_B31A7A13FC6CD52A (ressource_id), INDEX IDX_B31A7A13BAD26311 (tag_id), PRIMARY KEY(ressource_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_tag ADD CONSTRAINT FK_B31A7A13FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_tag ADD CONSTRAINT FK_B31A7A13BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_tag DROP FOREIGN KEY FK_B31A7A13FC6CD52A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_tag DROP FOREIGN KEY FK_B31A7A13BAD26311
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressource_tag
        SQL);
    }
}
