<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250605115234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE job DROP INDEX UNIQ_FBD8E0F8979B1AD6, ADD INDEX IDX_FBD8E0F8979B1AD6 (company_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE job DROP INDEX IDX_FBD8E0F8979B1AD6, ADD UNIQUE INDEX UNIQ_FBD8E0F8979B1AD6 (company_id)
        SQL);
    }
}
