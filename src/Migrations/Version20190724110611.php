<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724110611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content ADD parent INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE picture picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content DROP parent');
        $this->addSql('ALTER TABLE users CHANGE picture picture VARCHAR(255) DEFAULT \'https://cdn-media.rtl.fr/cache/kI0jBeCiI_M-HHVSqgW-TA/880v587-0/online/image/2018/0802/7794304883_l-extraterrestre-de-la-serie-alf.jpg\' COLLATE utf8mb4_unicode_ci');
    }
}
