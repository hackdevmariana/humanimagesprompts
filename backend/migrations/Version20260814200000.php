<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20260814200000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial schema for the prompt-engine-mvp: Character, Lighting, Scene, Garment, Outfit, GarmentSlot, Pose, PromptComposition. DDL matches the entity mappings exactly (verified via doctrine:schema:create --dump-sql).';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE character (name VARCHAR(255) NOT NULL, is_public BOOLEAN NOT NULL, gender VARCHAR(50) NOT NULL, age INTEGER NOT NULL, ethnicity VARCHAR(50) NOT NULL, cranial_morphology CLOB DEFAULT \'{}\' NOT NULL, skin_profile CLOB DEFAULT \'{}\' NOT NULL, hair_profile CLOB DEFAULT \'{}\' NOT NULL, eye_profile CLOB DEFAULT \'{}\' NOT NULL, facial_features CLOB DEFAULT \'{}\' NOT NULL, current_grooming CLOB DEFAULT \'{}\' NOT NULL, current_makeup CLOB DEFAULT \'{}\' NOT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE garment (name VARCHAR(255) NOT NULL, category VARCHAR(20) NOT NULL, sub_category VARCHAR(100) NOT NULL, fit VARCHAR(20) NOT NULL, fabric CLOB DEFAULT \'{}\' NOT NULL, primary_color CLOB DEFAULT \'{}\' NOT NULL, secondary_color CLOB DEFAULT NULL, pattern VARCHAR(30) DEFAULT NULL, tags CLOB DEFAULT \'[]\' NOT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE garment_slot (slot_type VARCHAR(30) NOT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, outfit_id VARCHAR(36) NOT NULL, garment_id VARCHAR(36) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_DED4897AE96E385 FOREIGN KEY (outfit_id) REFERENCES outfit (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DED48979CDB257C FOREIGN KEY (garment_id) REFERENCES garment (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DED4897AE96E385 ON garment_slot (outfit_id)');
        $this->addSql('CREATE INDEX IDX_DED48979CDB257C ON garment_slot (garment_id)');
        $this->addSql('CREATE TABLE lighting (setup_type VARCHAR(50) NOT NULL, color_temperature VARCHAR(50) NOT NULL, key_light_direction VARCHAR(50) DEFAULT NULL, hardness VARCHAR(50) DEFAULT NULL, modifiers CLOB DEFAULT \'{}\', id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE outfit (name VARCHAR(255) NOT NULL, style_category VARCHAR(50) NOT NULL, is_public BOOLEAN NOT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pose (title VARCHAR(255) NOT NULL, category VARCHAR(50) NOT NULL, body_language CLOB NOT NULL, facial_expression VARCHAR(50) NOT NULL, expression_intensity INTEGER NOT NULL, camera_angle VARCHAR(50) DEFAULT NULL, required_framing VARCHAR(50) DEFAULT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE prompt_composition (title VARCHAR(255) NOT NULL, user_id VARCHAR(36) NOT NULL, status VARCHAR(20) DEFAULT \'DRAFT\' NOT NULL, applied_overrides CLOB DEFAULT \'[]\' NOT NULL, target_model_hint VARCHAR(30) DEFAULT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, character_id VARCHAR(36) DEFAULT NULL, outfit_id VARCHAR(36) DEFAULT NULL, pose_id VARCHAR(36) DEFAULT NULL, scene_id VARCHAR(36) DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_AE554A621136BE75 FOREIGN KEY (character_id) REFERENCES character (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AE554A62AE96E385 FOREIGN KEY (outfit_id) REFERENCES outfit (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AE554A62A32C33D6 FOREIGN KEY (pose_id) REFERENCES pose (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AE554A62166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_AE554A621136BE75 ON prompt_composition (character_id)');
        $this->addSql('CREATE INDEX IDX_AE554A62AE96E385 ON prompt_composition (outfit_id)');
        $this->addSql('CREATE INDEX IDX_AE554A62A32C33D6 ON prompt_composition (pose_id)');
        $this->addSql('CREATE INDEX IDX_AE554A62166053B4 ON prompt_composition (scene_id)');
        $this->addSql('CREATE TABLE scene (title VARCHAR(255) NOT NULL, environment_type VARCHAR(50) NOT NULL, location_details CLOB NOT NULL, camera_and_lens CLOB DEFAULT \'{}\' NOT NULL, weather_and_atmosphere CLOB DEFAULT \'{}\' NOT NULL, id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lighting_id VARCHAR(36) DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_D979EFDA9987DD4 FOREIGN KEY (lighting_id) REFERENCES lighting (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D979EFDA9987DD4 ON scene (lighting_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE prompt_composition');
        $this->addSql('DROP TABLE garment_slot');
        $this->addSql('DROP TABLE scene');
        $this->addSql('DROP TABLE garment');
        $this->addSql('DROP TABLE pose');
        $this->addSql('DROP TABLE outfit');
        $this->addSql('DROP TABLE character');
        $this->addSql('DROP TABLE lighting');
    }
}
