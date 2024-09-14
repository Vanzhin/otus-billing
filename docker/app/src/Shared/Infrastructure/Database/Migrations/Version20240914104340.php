<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240914104340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE TABLE billing_account (id VARCHAR(26) NOT NULL, balance DOUBLE PRECISION NOT NULL, user_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE billing_transaction (id VARCHAR(26) NOT NULL, account_id VARCHAR(26) DEFAULT NULL, order_id VARCHAR(26) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sum DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F5B3C16C9B6B5FBA ON billing_transaction (account_id)');
        $this->addSql('COMMENT ON COLUMN billing_transaction.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE billing_transaction ADD CONSTRAINT FK_F5B3C16C9B6B5FBA FOREIGN KEY (account_id) REFERENCES billing_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billing_transaction DROP CONSTRAINT FK_F5B3C16C9B6B5FBA');
        $this->addSql('DROP TABLE billing_account');
        $this->addSql('DROP TABLE billing_transaction');
    }
}
