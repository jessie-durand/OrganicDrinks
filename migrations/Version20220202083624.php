<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220202083624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE benefit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drink (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drink_ingredient (drink_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_432CB60D36AA4BB4 (drink_id), INDEX IDX_432CB60D933FE08C (ingredient_id), PRIMARY KEY(drink_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_benefit (ingredient_id INT NOT NULL, benefit_id INT NOT NULL, INDEX IDX_5DBC0BD9933FE08C (ingredient_id), INDEX IDX_5DBC0BD9B517B89 (benefit_id), PRIMARY KEY(ingredient_id, benefit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE drink_ingredient ADD CONSTRAINT FK_432CB60D36AA4BB4 FOREIGN KEY (drink_id) REFERENCES drink (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE drink_ingredient ADD CONSTRAINT FK_432CB60D933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_benefit ADD CONSTRAINT FK_5DBC0BD9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_benefit ADD CONSTRAINT FK_5DBC0BD9B517B89 FOREIGN KEY (benefit_id) REFERENCES benefit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_benefit DROP FOREIGN KEY FK_5DBC0BD9B517B89');
        $this->addSql('ALTER TABLE drink_ingredient DROP FOREIGN KEY FK_432CB60D36AA4BB4');
        $this->addSql('ALTER TABLE drink_ingredient DROP FOREIGN KEY FK_432CB60D933FE08C');
        $this->addSql('ALTER TABLE ingredient_benefit DROP FOREIGN KEY FK_5DBC0BD9933FE08C');
        $this->addSql('DROP TABLE benefit');
        $this->addSql('DROP TABLE drink');
        $this->addSql('DROP TABLE drink_ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_benefit');
    }
}
