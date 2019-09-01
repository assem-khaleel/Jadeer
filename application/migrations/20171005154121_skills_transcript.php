<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Skills_Transcript
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Skills_Transcript extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for sst_criteria
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
            'group_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sst_criteria');
        
        /**
        * migration for sst_criteria_map
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
            'criteria_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'rubric_skill_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sst_criteria_map');
        
        /**
        * migration for sst_group
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
            'creator_id' => array(
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
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sst_group');
    }
    
    public function down() {
        
        /**
        * migration for sst_criteria
        */
        $this->dbforge->drop_table('sst_criteria');
        
        /**
        * migration for sst_criteria_map
        */
        $this->dbforge->drop_table('sst_criteria_map');
        
        /**
        * migration for sst_group
        */
        $this->dbforge->drop_table('sst_group');
    }
    
}
