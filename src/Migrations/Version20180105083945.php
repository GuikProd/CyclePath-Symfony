<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180105083945 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE cyclepath_locations_id_seq');
        $this->addSql('SELECT setval(\'cyclepath_locations_id_seq\', (SELECT MAX(id) FROM cyclepath_locations))');
        $this->addSql('ALTER TABLE cyclepath_locations ALTER id SET DEFAULT nextval(\'cyclepath_locations_id_seq\')');
        $this->addSql('CREATE SEQUENCE cyclepath_image_id_seq');
        $this->addSql('SELECT setval(\'cyclepath_image_id_seq\', (SELECT MAX(id) FROM cyclepath_image))');
        $this->addSql('ALTER TABLE cyclepath_image ALTER id SET DEFAULT nextval(\'cyclepath_image_id_seq\')');
        $this->addSql('CREATE SEQUENCE cyclepath_user_id_seq');
        $this->addSql('SELECT setval(\'cyclepath_user_id_seq\', (SELECT MAX(id) FROM cyclepath_user))');
        $this->addSql('ALTER TABLE cyclepath_user ALTER id SET DEFAULT nextval(\'cyclepath_user_id_seq\')');
        $this->addSql('CREATE SEQUENCE cyclepath_path_id_seq');
        $this->addSql('SELECT setval(\'cyclepath_path_id_seq\', (SELECT MAX(id) FROM cyclepath_path))');
        $this->addSql('ALTER TABLE cyclepath_path ALTER id SET DEFAULT nextval(\'cyclepath_path_id_seq\')');
        $this->addSql('CREATE SEQUENCE cyclepath_badge_id_seq');
        $this->addSql('SELECT setval(\'cyclepath_badge_id_seq\', (SELECT MAX(id) FROM cyclepath_badge))');
        $this->addSql('ALTER TABLE cyclepath_badge ALTER id SET DEFAULT nextval(\'cyclepath_badge_id_seq\')');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cyclepath_path ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE cyclepath_image ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE cyclepath_user ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE cyclepath_badge ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE cyclepath_locations ALTER id DROP DEFAULT');
    }
}
