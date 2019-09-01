<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Assessment_Loop_Modify
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Assessment_Loop_Modify extends CI_Migration {
    
    public function up() {

        $this->dbforge->add_column(
            'al_assessment_loop',
            [
                'type_id'=> [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'null' => FALSE,
                    'default' => '0'
                ]
            ],
            'deadline'
        );
    }
    
    public function down() {

        $this->dbforge->drop_column('al_assessment_loop','type_id');
    }
    
}
