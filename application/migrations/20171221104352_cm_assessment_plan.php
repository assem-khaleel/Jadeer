<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Cm_Assessment_Plan
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class  Migration_Cm_Assessment_Plan extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for cm_assessment_plan
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
                'constraint' => '45',
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_assessment_plan');
        
        /**
        * migration for cm_assessment_plan_map
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'assessment_plan_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_assessment_plan_map');
    }
    
    public function down() {
        
        /**
        * migration for cm_assessment_plan
        */
        $this->dbforge->drop_table('cm_assessment_plan');
        
        /**
        * migration for cm_assessment_plan_map
        */
        $this->dbforge->drop_table('cm_assessment_plan_map');
    }
    
}
