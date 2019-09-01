<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Course_Section
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Course_Section extends CI_Migration {
    
    public function up() {

        /**
        * migration for course_section
        */
        $this->dbforge->add_column(
            'course_section',
            [
                'room_id'=> [
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ]
            ]
        );
    }
    
    public function down() {
        
        /**
        * migration for course_section
        */
        $this->dbforge->drop_column('course_section','room_id');
    }
    
}
