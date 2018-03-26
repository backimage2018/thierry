<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321125241 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE caddie ADD user_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE caddie ADD CONSTRAINT FK_E98DC43BA76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('CREATE INDEX IDX_E98DC43BA76ED395 ON caddie (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE caddie DROP FOREIGN KEY FK_E98DC43BA76ED395');
        $this->addSql('DROP INDEX IDX_E98DC43BA76ED395 ON caddie');
        $this->addSql('ALTER TABLE caddie DROP user_id');
    }
}
