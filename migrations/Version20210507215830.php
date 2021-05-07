<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210507215830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE activity_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE activity_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE adress_book_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE consume_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE food_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE meal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stats_bio_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE activity_log (id INT NOT NULL, users_id_users_id INT NOT NULL, activity_type_id_activity_type_id INT NOT NULL, steps INT NOT NULL, length TIME(0) WITHOUT TIME ZONE NOT NULL, distance DOUBLE PRECISION NOT NULL, has_distance BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD06F647C0DD645A ON activity_log (users_id_users_id)');
        $this->addSql('CREATE INDEX IDX_FD06F647C3A10FB5 ON activity_log (activity_type_id_activity_type_id)');
        $this->addSql('CREATE TABLE activity_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE adress_book (id INT NOT NULL, street_num INT NOT NULL, street VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, contry VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE consume (id INT NOT NULL, frequency INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE food_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, is_alcohol BOOLEAN NOT NULL, extra JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE meal (id INT NOT NULL, users_id_users_id INT NOT NULL, name VARCHAR(255) NOT NULL, food_quantity INT DEFAULT NULL, alcohol_quantity INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9EF68E9CC0DD645A ON meal (users_id_users_id)');
        $this->addSql('CREATE TABLE meal_food_type (meal_id INT NOT NULL, food_type_id INT NOT NULL, PRIMARY KEY(meal_id, food_type_id))');
        $this->addSql('CREATE INDEX IDX_8796FDF3639666D6 ON meal_food_type (meal_id)');
        $this->addSql('CREATE INDEX IDX_8796FDF38AD350AB ON meal_food_type (food_type_id)');
        $this->addSql('CREATE TABLE stats_bio (id INT NOT NULL, weight DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, consume_id_consume_id INT DEFAULT NULL, adress_book_id_adress_book_id INT DEFAULT NULL, stats_bio_id_stats_bio_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, gender INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E931AA1058 ON users (consume_id_consume_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E916476FD4 ON users (adress_book_id_adress_book_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9BE474CED ON users (stats_bio_id_stats_bio_id)');
        $this->addSql('ALTER TABLE activity_log ADD CONSTRAINT FK_FD06F647C0DD645A FOREIGN KEY (users_id_users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE activity_log ADD CONSTRAINT FK_FD06F647C3A10FB5 FOREIGN KEY (activity_type_id_activity_type_id) REFERENCES activity_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CC0DD645A FOREIGN KEY (users_id_users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE meal_food_type ADD CONSTRAINT FK_8796FDF3639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE meal_food_type ADD CONSTRAINT FK_8796FDF38AD350AB FOREIGN KEY (food_type_id) REFERENCES food_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E931AA1058 FOREIGN KEY (consume_id_consume_id) REFERENCES consume (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E916476FD4 FOREIGN KEY (adress_book_id_adress_book_id) REFERENCES adress_book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9BE474CED FOREIGN KEY (stats_bio_id_stats_bio_id) REFERENCES stats_bio (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE activity_log DROP CONSTRAINT FK_FD06F647C3A10FB5');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E916476FD4');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E931AA1058');
        $this->addSql('ALTER TABLE meal_food_type DROP CONSTRAINT FK_8796FDF38AD350AB');
        $this->addSql('ALTER TABLE meal_food_type DROP CONSTRAINT FK_8796FDF3639666D6');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9BE474CED');
        $this->addSql('ALTER TABLE activity_log DROP CONSTRAINT FK_FD06F647C0DD645A');
        $this->addSql('ALTER TABLE meal DROP CONSTRAINT FK_9EF68E9CC0DD645A');
        $this->addSql('DROP SEQUENCE activity_log_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE activity_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE adress_book_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE consume_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE food_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE meal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stats_bio_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP TABLE activity_log');
        $this->addSql('DROP TABLE activity_type');
        $this->addSql('DROP TABLE adress_book');
        $this->addSql('DROP TABLE consume');
        $this->addSql('DROP TABLE food_type');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meal_food_type');
        $this->addSql('DROP TABLE stats_bio');
        $this->addSql('DROP TABLE users');
    }
}
