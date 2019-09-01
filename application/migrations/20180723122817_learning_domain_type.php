<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Learning_Domain_Type
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Learning_Domain_Type extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for learning_domain_type
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
                'constraint' => '255',
                'null' => FALSE
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'is_statics' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('learning_domain_type');
    }
    
    public function down() {
        
        /**
        * migration for learning_domain_type
        */
        $this->dbforge->drop_table('learning_domain_type');
    }
    
}
