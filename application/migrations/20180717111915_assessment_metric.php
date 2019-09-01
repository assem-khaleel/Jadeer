<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Assessment_Metric
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Assessment_Metric extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for am_assessment_metric
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
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => TRUE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => FALSE
            ),
            'target' => array(
                'type' => 'FLOAT',
                'constraint' => '8,2',
                'null' => FALSE
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'item_class' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'extra_data' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'item_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'department_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'weakness_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'weakness_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'strength_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'strength_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
        ));


        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('am_assessment_metric');
        
        /**
        * migration for am_metric_item
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'component_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'component_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'weight' => array(
                'type' => 'FLOAT',
                'constraint' => '8,2',
                'null' => FALSE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'high_score' => array(
                'type' => 'FLOAT',
                'constraint' => '8,2',
                'null' => FALSE
            ),
            'average' => array(
                'type' => 'FLOAT',
                'constraint' => '8,2',
                'null' => FALSE
            ),
            'result' => array(
                'type' => 'FLOAT',
                'constraint' => '8,2',
                'null' => FALSE
            ),
            'assessment_metric_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'component_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => true
            ),
            'component_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => true
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('am_metric_item');

    }
    
    public function down() {
        
        /**
        * migration for am_assessment_metric
        */
        $this->dbforge->drop_table('am_assessment_metric');
        
        /**
        * migration for am_metric_item
        */
        $this->dbforge->drop_table('am_metric_item');
    }
    
}
