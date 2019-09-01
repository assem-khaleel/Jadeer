<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Cm_Program_X_Matrix_Update
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Cm_Program_X_Matrix_Update extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for cm_program_x_matrix
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
                'null' => FALSE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'xmatrix' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_x_matrix');
        
        /**
        * migration for cm_program_x_matrix_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'log_program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_xmatrix' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_x_matrix_log');
        
        /**
        * migration for cm_program_x_matrix_method
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
                'null' => FALSE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'value' => array(
                'type' => 'FLOAT',
                'constraint' => '8,2',
                'null' => FALSE
            )

        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_x_matrix_method');
        
        /**
        * migration for cm_program_x_matrix_method_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'log_program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_value' => array(
                'type' => 'FLOAT',
                'constraint' => '8,2',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_x_matrix_method_log');
    }
    
    public function down() {
        /**
        * migration for cm_program_x_matrix_method_log
        */
        $this->dbforge->drop_table('cm_program_x_matrix_method_log');
    }
    
}
