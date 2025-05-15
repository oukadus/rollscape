<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515092407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE type ADD ressource_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type ADD CONSTRAINT FK_8CDE5729FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8CDE5729FC6CD52A ON type (ressource_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729FC6CD52A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8CDE5729FC6CD52A ON type
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type DROP ressource_id
        SQL);
    }
}
