<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Update_CM
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Update_CM extends CI_Migration {
    
    public function up() {
        

        /**
        * migration for cm_program_domain
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'domain_type' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_domain');

    }
    
    public function down() {

        /**
        * migration for cm_program_domain
        */
        $this->dbforge->drop_table('cm_program_domain');

    }
    
}
