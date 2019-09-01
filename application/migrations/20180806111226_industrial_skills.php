<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Industrial_Skills
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Industrial_Skills extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for is_industrial_relation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'industrial_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'rubric_row_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('is_industrial_relation');
        
        /**
        * migration for is_industrial_skills
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
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('is_industrial_skills');
    }
    
    public function down() {
        
        /**
        * migration for is_industrial_relation
        */
        $this->dbforge->drop_table('is_industrial_relation');
        
        /**
        * migration for is_industrial_skills
        */
        $this->dbforge->drop_table('is_industrial_skills');
    }
    
}
