<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726114404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, name2 VARCHAR(255) NOT NULL, count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content ADD author_id INT NOT NULL, ADD picture VARCHAR(255) DEFAULT NULL, ADD tag VARCHAR(255) DEFAULT NULL, ADD parent INT NOT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A9F675F31B ON content (author_id)');
        $this->addSql('ALTER TABLE users ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tags');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9F675F31B');
        $this->addSql('DROP INDEX IDX_FEC530A9F675F31B ON content');
        $this->addSql('ALTER TABLE content DROP author_id, DROP picture, DROP tag, DROP parent');
        $this->addSql('ALTER TABLE users DROP roles');
    }
}
