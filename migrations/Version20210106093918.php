<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210106093918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, description VARCHAR(45) NOT NULL, date_ajout DATETIME NOT NULL, document_categorie_id INT NOT NULL, evenement_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, categorie_id INT NOT NULL, date_naissance DATE NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, classe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, sport_id_id INT NOT NULL, type_id_id INT NOT NULL, categorie_id_id INT NOT NULL, nom VARCHAR(45) NOT NULL, description VARCHAR(255) NOT NULL, date DATETIME NOT NULL, nombre_places INT NOT NULL, image VARCHAR(255) NOT NULL, vignette VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B26681ECB38FF4E (sport_id_id), UNIQUE INDEX UNIQ_B26681E714819A0 (type_id_id), UNIQUE INDEX UNIQ_B26681E8A3C7387 (categorie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, eleve_id INT NOT NULL, evenement_id INT NOT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_5E90F6D6A6CC7B2 (eleve_id), UNIQUE INDEX UNIQ_5E90F6D6FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, eleve_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B3A6CC7B2 (eleve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681ECB38FF4E FOREIGN KEY (sport_id_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E8A3C7387 FOREIGN KEY (categorie_id_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E8A3C7387');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A6CC7B2');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3A6CC7B2');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6FD02F13');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681ECB38FF4E');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E714819A0');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_categorie');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
