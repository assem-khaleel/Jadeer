<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Cm_Course_Matrix
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Cm_Course_Matrix extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for matrix
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'clo_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'plo_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_matrix');
    }
    
    public function down() {
        
        /**
        * migration for cm_course_matrix
        */
        $this->dbforge->drop_table('cm_course_matrix');
    }
    
}
