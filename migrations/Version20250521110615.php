<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250521110615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE user_ressource (user_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_937FC8A0A76ED395 (user_id), INDEX IDX_937FC8A0FC6CD52A (ressource_id), PRIMARY KEY(user_id, ressource_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_ressource ADD CONSTRAINT FK_937FC8A0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_ressource ADD CONSTRAINT FK_937FC8A0FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user_ressource DROP FOREIGN KEY FK_937FC8A0A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_ressource DROP FOREIGN KEY FK_937FC8A0FC6CD52A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_ressource
        SQL);
    }
}
