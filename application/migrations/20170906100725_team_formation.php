<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Team_Formation
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Team_Formation extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for tf_club
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'policies_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'policies_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'creator' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'approval_post' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'logo' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'member_gender' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('tf_club');
        
        /**
        * migration for tf_post
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'club_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'date_created' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'creator' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('tf_post');
        
        /**
        * migration for tf_user_club
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'club_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_admin' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('tf_user_club');
    }
    
    public function down() {
        
        /**
        * migration for tf_club
        */
        $this->dbforge->drop_table('tf_club');
        
        /**
        * migration for tf_post
        */
        $this->dbforge->drop_table('tf_post');
        
        /**
        * migration for tf_user_club
        */
        $this->dbforge->drop_table('tf_user_club');
    }
    
}
