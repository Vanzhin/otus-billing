<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240915073119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billing_transaction ADD type VARCHAR(26) NOT NULL');
        $this->addSql('ALTER TABLE billing_transaction DROP order_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billing_transaction ADD order_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE billing_transaction DROP type');
    }
}
