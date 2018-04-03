<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180403124656 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE caddie DROP FOREIGN KEY FK_E98DC43BA76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD3DA5256D');
        $this->addSql('ALTER TABLE caddie DROP FOREIGN KEY FK_E98DC43B4584665A');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C64584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADDCD6110');
        $this->addSql('CREATE TABLE thi_caddie (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id BIGINT DEFAULT NULL, quantity INT NOT NULL, total NUMERIC(8, 2) NOT NULL, INDEX IDX_B9E5297E4584665A (product_id), INDEX IDX_B9E5297EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thi_image (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thi_newsletter (id BIGINT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, user_creation INT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, user_deleted INT DEFAULT NULL, date_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, use_modif INT DEFAULT NULL, date_modif DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B53ADE6FE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thi_product (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(8, 2) NOT NULL, oldprice NUMERIC(8, 2) NOT NULL, description LONGTEXT NOT NULL, color VARCHAR(128) NOT NULL, size VARCHAR(16) NOT NULL, brand VARCHAR(255) NOT NULL, availability VARCHAR(64) NOT NULL, category VARCHAR(255) NOT NULL, reduction VARCHAR(64) NOT NULL, new VARCHAR(64) DEFAULT NULL, collection VARCHAR(255) NOT NULL, genre VARCHAR(32) NOT NULL, user_creation INT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, user_deleted INT DEFAULT NULL, date_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, use_modif INT DEFAULT NULL, date_modif DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D5ACD95F3DA5256D (image_id), UNIQUE INDEX UNIQ_D5ACD95FDCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thi_review (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, date DATETIME DEFAULT NULL, note INT NOT NULL, INDEX IDX_292B6C834584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thi_stock (id INT AUTO_INCREMENT NOT NULL, eshopquantity INT NOT NULL, storequantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thi_users (id BIGINT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', UNIQUE INDEX UNIQ_791FDC99F85E0677 (username), UNIQUE INDEX UNIQ_791FDC99E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE thi_caddie ADD CONSTRAINT FK_B9E5297E4584665A FOREIGN KEY (product_id) REFERENCES thi_product (id)');
        $this->addSql('ALTER TABLE thi_caddie ADD CONSTRAINT FK_B9E5297EA76ED395 FOREIGN KEY (user_id) REFERENCES thi_users (id)');
        $this->addSql('ALTER TABLE thi_product ADD CONSTRAINT FK_D5ACD95F3DA5256D FOREIGN KEY (image_id) REFERENCES thi_image (id)');
        $this->addSql('ALTER TABLE thi_product ADD CONSTRAINT FK_D5ACD95FDCD6110 FOREIGN KEY (stock_id) REFERENCES thi_stock (id)');
        $this->addSql('ALTER TABLE thi_review ADD CONSTRAINT FK_292B6C834584665A FOREIGN KEY (product_id) REFERENCES thi_product (id)');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('DROP TABLE caddie');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE stock');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE thi_product DROP FOREIGN KEY FK_D5ACD95F3DA5256D');
        $this->addSql('ALTER TABLE thi_caddie DROP FOREIGN KEY FK_B9E5297E4584665A');
        $this->addSql('ALTER TABLE thi_review DROP FOREIGN KEY FK_292B6C834584665A');
        $this->addSql('ALTER TABLE thi_product DROP FOREIGN KEY FK_D5ACD95FDCD6110');
        $this->addSql('ALTER TABLE thi_caddie DROP FOREIGN KEY FK_B9E5297EA76ED395');
        $this->addSql('CREATE TABLE app_users (id BIGINT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, password VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:simple_array)\', UNIQUE INDEX UNIQ_C2502824F85E0677 (username), UNIQUE INDEX UNIQ_C2502824E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caddie (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id BIGINT DEFAULT NULL, quantity INT NOT NULL, total NUMERIC(8, 2) NOT NULL, INDEX IDX_E98DC43B4584665A (product_id), INDEX IDX_E98DC43BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id BIGINT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, user_creation INT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, user_deleted INT DEFAULT NULL, date_deleted DATETIME DEFAULT NULL, use_modif INT DEFAULT NULL, date_modif DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_7E8585C8E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, price NUMERIC(8, 2) NOT NULL, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, color VARCHAR(128) NOT NULL COLLATE utf8_unicode_ci, size VARCHAR(16) NOT NULL COLLATE utf8_unicode_ci, brand VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, availability VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, category VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, new VARCHAR(64) DEFAULT NULL COLLATE utf8_unicode_ci, collection VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, genre VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, oldprice NUMERIC(8, 2) NOT NULL, reduction VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, user_creation INT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, user_deleted INT DEFAULT NULL, date_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, use_modif INT DEFAULT NULL, date_modif DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D34A04AD3DA5256D (image_id), UNIQUE INDEX UNIQ_D34A04ADDCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, comment LONGTEXT NOT NULL COLLATE utf8_unicode_ci, date DATETIME DEFAULT NULL, note INT NOT NULL, INDEX IDX_794381C64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, eshopquantity INT NOT NULL, storequantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caddie ADD CONSTRAINT FK_E98DC43B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE caddie ADD CONSTRAINT FK_E98DC43BA76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('DROP TABLE thi_caddie');
        $this->addSql('DROP TABLE thi_image');
        $this->addSql('DROP TABLE thi_newsletter');
        $this->addSql('DROP TABLE thi_product');
        $this->addSql('DROP TABLE thi_review');
        $this->addSql('DROP TABLE thi_stock');
        $this->addSql('DROP TABLE thi_users');
    }
}
