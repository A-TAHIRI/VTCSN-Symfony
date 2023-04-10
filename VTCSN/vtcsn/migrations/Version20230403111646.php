<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403111646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT NOT NULL, user_id INT NOT NULL, license VARCHAR(100) NOT NULL, disponibility TINYINT(1) NOT NULL, total_ride INT DEFAULT NULL, UNIQUE INDEX UNIQ_11667CD94A4A3511 (vehicule_id), INDEX IDX_11667CD9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(45) NOT NULL, region VARCHAR(45) NOT NULL, city VARCHAR(45) NOT NULL, zip_code VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, user_id INT DEFAULT NULL, note INT DEFAULT NULL, commentary VARCHAR(255) DEFAULT NULL, INDEX IDX_D8892622C3423909 (driver_id), INDEX IDX_D8892622A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, status TINYINT(1) NOT NULL, rendez_vous VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, rendez_vous_time DATETIME NOT NULL, time_destination DATETIME NOT NULL, start_time DATETIME NOT NULL, stop_time DATETIME NOT NULL, canceled VARCHAR(45) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9B3D7CD064D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride_user (ride_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C6ACE33D302A8A70 (ride_id), INDEX IDX_C6ACE33DA76ED395 (user_id), PRIMARY KEY(ride_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride_driver (ride_id INT NOT NULL, driver_id INT NOT NULL, INDEX IDX_C864F37302A8A70 (ride_id), INDEX IDX_C864F37C3423909 (driver_id), PRIMARY KEY(ride_id, driver_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, surname VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(6) NOT NULL, city VARCHAR(150) NOT NULL, phone_number VARCHAR(100) NOT NULL, reset_token VARCHAR(100) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', portfil_image VARCHAR(100) DEFAULT NULL, genre VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, type_vehicule VARCHAR(45) NOT NULL, number_place INT NOT NULL, brand VARCHAR(45) NOT NULL, model VARCHAR(45) NOT NULL, color VARCHAR(45) NOT NULL, image VARCHAR(45) DEFAULT NULL, energie VARCHAR(45) NOT NULL, number_door INT NOT NULL, license_plate VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_292FFF1DF5AA79D0 (license_plate), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD94A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD064D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE ride_user ADD CONSTRAINT FK_C6ACE33D302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_user ADD CONSTRAINT FK_C6ACE33DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_driver ADD CONSTRAINT FK_C864F37302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_driver ADD CONSTRAINT FK_C864F37C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE driver DROP FOREIGN KEY FK_11667CD94A4A3511');
        $this->addSql('ALTER TABLE driver DROP FOREIGN KEY FK_11667CD9A76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622C3423909');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD064D218E');
        $this->addSql('ALTER TABLE ride_user DROP FOREIGN KEY FK_C6ACE33D302A8A70');
        $this->addSql('ALTER TABLE ride_user DROP FOREIGN KEY FK_C6ACE33DA76ED395');
        $this->addSql('ALTER TABLE ride_driver DROP FOREIGN KEY FK_C864F37302A8A70');
        $this->addSql('ALTER TABLE ride_driver DROP FOREIGN KEY FK_C864F37C3423909');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE ride');
        $this->addSql('DROP TABLE ride_user');
        $this->addSql('DROP TABLE ride_driver');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
