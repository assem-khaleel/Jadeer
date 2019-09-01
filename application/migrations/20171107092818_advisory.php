<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Advisory
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Advisory extends CI_Migration {
    
    public function up() {

        /**
        * migration for ad_advice_topic
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'topic_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'topic_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'default' => '0000-00-00 00:00:00'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('ad_advice_topic');
        
        /**
        * migration for ad_faculty_program
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
            'faculty_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'survey_status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('ad_faculty_program');
        
        /**
        * migration for ad_student_faculty
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'student_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'faculty_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('ad_student_faculty');

        /**
         * migration for ad_survey
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'faculty_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'survey_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'survey_status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('ad_survey');
    }
    
    public function down()
    {

        /**
         * migration for ad_advice_topic
         */
        $this->dbforge->drop_table('ad_advice_topic');

        /**
         * migration for ad_faculty_program
         */
        $this->dbforge->drop_table('ad_faculty_program');

        /**
         * migration for ad_student_faculty
         */
        $this->dbforge->drop_table('ad_student_faculty');
        
        /**
         * migration for ad_survey
         */
        $this->dbforge->drop_table('ad_survey');
    }
    
}
