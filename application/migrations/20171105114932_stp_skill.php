<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_stp_skill extends CI_Migration {
    
    public function up() {
        /**
        * migration for stp_skill
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'skill_name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'skill_name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_skill');
    }
    
    public function down() {
        
        /**
        * migration for stp_skill
        */
        $this->dbforge->drop_table('stp_skill');

    }
    
}
