<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Cm_Program_Ipa
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Cm_Program_Ipa extends CI_Migration {
    
    public function up() {
        $this->dbforge->modify_column(
            'cm_program_mapping_matrix',
            [

                'ipa' => array(
                    'type' => "ENUM('i','a','m','p')",
                    'null' => FALSE,
                    'default' => 'i'
                )
            ]
        );

        $this->dbforge->modify_column(
            'cm_program_mapping_matrix_log',
            [

                'log_ipa' => array(
                    'type' => "ENUM('i','a','m','p')",
                    'null' => FALSE,
                    'default' => 'i'
                )
            ]
        );
    }

    public function down() {
        $this->dbforge->modify_column(
            'cm_program_mapping_matrix',
            [
                'ipa' => array(
                    'type' => "ENUM('i','a','p')",
                    'null' => FALSE,
                    'default' => 'i'
                )
            ]
        );
        $this->dbforge->modify_column(
            'cm_program_mapping_matrix_log',
            [
                'log_ipa' => array(
                    'type' => "ENUM('i','a','p')",
                    'null' => FALSE,
                    'default' => 'i'
                )
            ]
        );
    }

    
}
