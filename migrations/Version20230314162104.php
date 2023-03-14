<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314162104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, from_user_id, parent_id, post_id, photo_id, event_id, video_id, attachment, created_time, like_count, message FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id BLOB NOT NULL --(DC2Type:uuid)
        , from_user_id BLOB NOT NULL --(DC2Type:uuid)
        , parent_id BLOB DEFAULT NULL --(DC2Type:uuid)
        , post_id BLOB DEFAULT NULL --(DC2Type:uuid)
        , photo_id VARCHAR(255) DEFAULT NULL, event_id VARCHAR(255) DEFAULT NULL, video_id VARCHAR(255) DEFAULT NULL, attachment BLOB DEFAULT NULL --(DC2Type:uuid)
        , created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , like_count INTEGER NOT NULL, message CLOB NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_9474526C2130303A FOREIGN KEY (from_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C727ACA70 FOREIGN KEY (parent_id) REFERENCES comment (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, from_user_id, parent_id, post_id, photo_id, event_id, video_id, attachment, created_time, like_count, message) SELECT id, from_user_id, parent_id, post_id, photo_id, event_id, video_id, attachment, created_time, like_count, message FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C29C1004E ON comment (video_id)');
        $this->addSql('CREATE INDEX IDX_9474526C71F7E88B ON comment (event_id)');
        $this->addSql('CREATE INDEX IDX_9474526C7E9E4C8C ON comment (photo_id)');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('CREATE INDEX IDX_9474526C727ACA70 ON comment (parent_id)');
        $this->addSql('CREATE INDEX IDX_9474526C2130303A ON comment (from_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, from_user_id, category, cover, description, start_time, end_time, is_draft, is_online, is_canceled, name, event_type, created_time, type FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id VARCHAR(255) NOT NULL, from_user_id BLOB NOT NULL --(DC2Type:uuid)
        , category VARCHAR(255) NOT NULL, cover VARCHAR(255) DEFAULT NULL, description CLOB NOT NULL, start_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , end_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , is_draft BOOLEAN NOT NULL, is_online BOOLEAN NOT NULL, is_canceled BOOLEAN NOT NULL, name VARCHAR(255) NOT NULL, event_type VARCHAR(255) NOT NULL, created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_3BAE0AA72130303A FOREIGN KEY (from_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO event (id, from_user_id, category, cover, description, start_time, end_time, is_draft, is_online, is_canceled, name, event_type, created_time, type) SELECT id, from_user_id, category, cover, description, start_time, end_time, is_draft, is_online, is_canceled, name, event_type, created_time, type FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
        $this->addSql('CREATE INDEX IDX_3BAE0AA72130303A ON event (from_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, from_user_id, album, alt_text, link, name, created_time, type FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id VARCHAR(255) NOT NULL, from_user_id BLOB NOT NULL --(DC2Type:uuid)
        , album VARCHAR(255) DEFAULT NULL, alt_text CLOB DEFAULT NULL, link VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_14B784182130303A FOREIGN KEY (from_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO photo (id, from_user_id, album, alt_text, link, name, created_time, type) SELECT id, from_user_id, album, alt_text, link, name, created_time, type FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
        $this->addSql('CREATE INDEX IDX_14B784182130303A ON photo (from_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, from_user_id, created_time, description, full_picture, icon, is_app_share, is_hidden, is_expired, is_published, link, name, type, message, attachment FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id BLOB NOT NULL --(DC2Type:uuid)
        , from_user_id BLOB NOT NULL --(DC2Type:uuid)
        , created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , description VARCHAR(255) DEFAULT NULL, full_picture VARCHAR(255) DEFAULT NULL, icon VARCHAR(255) NOT NULL, is_app_share BOOLEAN NOT NULL, is_hidden BOOLEAN NOT NULL, is_expired BOOLEAN NOT NULL, is_published BOOLEAN NOT NULL, link VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, message CLOB NOT NULL, attachment BLOB DEFAULT NULL --(DC2Type:uuid)
        , PRIMARY KEY(id), CONSTRAINT FK_5A8A6C8D2130303A FOREIGN KEY (from_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, from_user_id, created_time, description, full_picture, icon, is_app_share, is_hidden, is_expired, is_published, link, name, type, message, attachment) SELECT id, from_user_id, created_time, description, full_picture, icon, is_app_share, is_hidden, is_expired, is_published, link, name, type, message, attachment FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D2130303A ON post (from_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, first_name, last_name, name, middle_name, birthday, email, gender, quotes, profile_pic FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id BLOB NOT NULL --(DC2Type:uuid)
        , first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, birthday DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , email VARCHAR(255) NOT NULL, gender VARCHAR(255) DEFAULT NULL, quotes CLOB DEFAULT NULL, profile_pic VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, first_name, last_name, name, middle_name, birthday, email, gender, quotes, profile_pic) SELECT id, first_name, last_name, name, middle_name, birthday, email, gender, quotes, profile_pic FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__video AS SELECT id, from_user_id, description, format, title, status, created_time, type FROM video');
        $this->addSql('DROP TABLE video');
        $this->addSql('CREATE TABLE video (id VARCHAR(255) NOT NULL, from_user_id BLOB NOT NULL --(DC2Type:uuid)
        , description CLOB NOT NULL, format VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_7CC7DA2C2130303A FOREIGN KEY (from_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO video (id, from_user_id, description, format, title, status, created_time, type) SELECT id, from_user_id, description, format, title, status, created_time, type FROM __temp__video');
        $this->addSql('DROP TABLE __temp__video');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C2130303A ON video (from_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, from_user_id, parent_id, post_id, photo_id, event_id, video_id, attachment, created_time, like_count, message FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id VARCHAR(255) NOT NULL, from_user_id VARCHAR(255) NOT NULL, parent_id VARCHAR(255) DEFAULT NULL, post_id VARCHAR(255) DEFAULT NULL, photo_id VARCHAR(255) DEFAULT NULL, event_id VARCHAR(255) DEFAULT NULL, video_id VARCHAR(255) DEFAULT NULL, attachment BLOB DEFAULT NULL --(DC2Type:uuid)
        , created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , like_count INTEGER NOT NULL, message CLOB NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_9474526C2130303A FOREIGN KEY (from_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C727ACA70 FOREIGN KEY (parent_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C29C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, from_user_id, parent_id, post_id, photo_id, event_id, video_id, attachment, created_time, like_count, message) SELECT id, from_user_id, parent_id, post_id, photo_id, event_id, video_id, attachment, created_time, like_count, message FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C2130303A ON comment (from_user_id)');
        $this->addSql('CREATE INDEX IDX_9474526C727ACA70 ON comment (parent_id)');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('CREATE INDEX IDX_9474526C7E9E4C8C ON comment (photo_id)');
        $this->addSql('CREATE INDEX IDX_9474526C71F7E88B ON comment (event_id)');
        $this->addSql('CREATE INDEX IDX_9474526C29C1004E ON comment (video_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, from_user_id, category, cover, description, start_time, end_time, is_draft, is_online, is_canceled, name, event_type, created_time, type FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id VARCHAR(255) NOT NULL, from_user_id VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, cover VARCHAR(255) DEFAULT NULL, description CLOB NOT NULL, start_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , end_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , is_draft BOOLEAN NOT NULL, is_online BOOLEAN NOT NULL, is_canceled BOOLEAN NOT NULL, name VARCHAR(255) NOT NULL, event_type VARCHAR(255) NOT NULL, created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_3BAE0AA72130303A FOREIGN KEY (from_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO event (id, from_user_id, category, cover, description, start_time, end_time, is_draft, is_online, is_canceled, name, event_type, created_time, type) SELECT id, from_user_id, category, cover, description, start_time, end_time, is_draft, is_online, is_canceled, name, event_type, created_time, type FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
        $this->addSql('CREATE INDEX IDX_3BAE0AA72130303A ON event (from_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, from_user_id, album, alt_text, link, name, created_time, type FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id VARCHAR(255) NOT NULL, from_user_id VARCHAR(255) NOT NULL, album VARCHAR(255) DEFAULT NULL, alt_text CLOB DEFAULT NULL, link VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_14B784182130303A FOREIGN KEY (from_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO photo (id, from_user_id, album, alt_text, link, name, created_time, type) SELECT id, from_user_id, album, alt_text, link, name, created_time, type FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
        $this->addSql('CREATE INDEX IDX_14B784182130303A ON photo (from_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, from_user_id, created_time, description, full_picture, icon, is_app_share, is_hidden, is_expired, is_published, link, name, type, message, attachment FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id VARCHAR(255) NOT NULL, from_user_id VARCHAR(255) NOT NULL, created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , description VARCHAR(255) DEFAULT NULL, full_picture VARCHAR(255) DEFAULT NULL, icon VARCHAR(255) NOT NULL, is_app_share BOOLEAN NOT NULL, is_hidden BOOLEAN NOT NULL, is_expired BOOLEAN NOT NULL, is_published BOOLEAN NOT NULL, link VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, message CLOB NOT NULL, attachment BLOB DEFAULT NULL --(DC2Type:uuid)
        , PRIMARY KEY(id), CONSTRAINT FK_5A8A6C8D2130303A FOREIGN KEY (from_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, from_user_id, created_time, description, full_picture, icon, is_app_share, is_hidden, is_expired, is_published, link, name, type, message, attachment) SELECT id, from_user_id, created_time, description, full_picture, icon, is_app_share, is_hidden, is_expired, is_published, link, name, type, message, attachment FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D2130303A ON post (from_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, first_name, last_name, name, middle_name, birthday, email, gender, quotes, profile_pic FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, birthday DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , email VARCHAR(255) NOT NULL, gender VARCHAR(255) DEFAULT NULL, quotes CLOB DEFAULT NULL, profile_pic VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO "user" (id, first_name, last_name, name, middle_name, birthday, email, gender, quotes, profile_pic) SELECT id, first_name, last_name, name, middle_name, birthday, email, gender, quotes, profile_pic FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__video AS SELECT id, from_user_id, description, format, title, status, created_time, type FROM video');
        $this->addSql('DROP TABLE video');
        $this->addSql('CREATE TABLE video (id VARCHAR(255) NOT NULL, from_user_id VARCHAR(255) NOT NULL, description CLOB NOT NULL, format VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_time DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_7CC7DA2C2130303A FOREIGN KEY (from_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO video (id, from_user_id, description, format, title, status, created_time, type) SELECT id, from_user_id, description, format, title, status, created_time, type FROM __temp__video');
        $this->addSql('DROP TABLE __temp__video');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C2130303A ON video (from_user_id)');
    }
}
