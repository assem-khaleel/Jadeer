<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Award_Management extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for wa_award
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ),
            'description_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'level' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'level_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('wa_award');
        
        /**
        * migration for wa_candidate_user
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
            'award_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('wa_candidate_user');
        
        /**
        * migration for wa_winner_award
        */
        $this->dbforge->add_field(array(
            'award_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'received' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('wa_winner_award');
    }
    
    public function down() {
        /**
        * migration for wa_award
        */
        $this->dbforge->drop_table('wa_award');
        
        /**
        * migration for wa_candidate_user
        */
        $this->dbforge->drop_table('wa_candidate_user');
        
        /**
        * migration for wa_winner_award
        */
        $this->dbforge->drop_table('wa_winner_award');
    }
    
}
