<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150807150023 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, category_products INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, title VARCHAR(20) NOT NULL, description TINYTEXT NOT NULL, price NUMERIC(10, 2) NOT NULL, thumbnail VARCHAR(120) NOT NULL, INDEX IDX_B3BA5A5A4C0DE21 (category_products), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A4C0DE21 FOREIGN KEY (category_products) REFERENCES categories (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A4C0DE21');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE categories');
    }
}
