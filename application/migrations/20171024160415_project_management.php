<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_project_management extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for pm_phase
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'desc_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'desc_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pm_phase');
        
        /**
        * migration for pm_project
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'budget' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            ),
            'resources' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'desc_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'desc_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'responsible_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pm_project');
        
        /**
        * migration for pm_project_phase
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'project_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'phase_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'project_type' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pm_project_phase');
        
        /**
        * migration for pm_sub_phase
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'desc_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'desc_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'phase_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'responsible' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'is_complete' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pm_sub_phase');
    }
    
    public function down() {
        
        /**
        * migration for pm_phase
        */
        $this->dbforge->drop_table('pm_phase');
        
        /**
        * migration for pm_project
        */
        $this->dbforge->drop_table('pm_project');
        
        /**
        * migration for pm_project_phase
        */
        $this->dbforge->drop_table('pm_project_phase');
        
        /**
        * migration for pm_sub_phase
        */
        $this->dbforge->drop_table('pm_sub_phase');
    }
    
}
