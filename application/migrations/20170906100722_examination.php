<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Examination
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Examination extends CI_Migration {
    
    public function up() {

        /**
         * migration for tst_exam
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
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'teacher_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'sections' => array(
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
            'type' => array(
                'type' => 'INT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'start' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'end' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'fullmark' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_exam');

        /**
         * migration for tst_exam_attachment
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'file_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'path' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_exam_attachment');

        $sql = "CREATE UNIQUE INDEX `tst_exam_attachment_id_uindex` ON tst_exam_attachment(`id`)";
        $this->db->query($sql);

        /**
         * migration for tst_exam_attendance
         */
        $this->dbforge->add_field(array(
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'student_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'monitor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'hash_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => ''
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('exam_id');
        $this->dbforge->add_key('student_id');
        $this->dbforge->add_key('monitor_id');

        $this->dbforge->create_table('tst_exam_attendance');

        /**
         * migration for tst_exam_monitors
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'monitor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_exam_monitors');

        /**
         * migration for tst_exam_questions
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'mark' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_exam_questions');

        /**
         * migration for tst_exam_response_attachment
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'path_file' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('exam_id');

        $this->dbforge->create_table('tst_exam_response_attachment');

        /**
         * migration for tst_exam_response_choice
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'choice_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('exam_id');

        $this->dbforge->create_table('tst_exam_response_choice');

        /**
         * migration for tst_exam_response_text
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'text' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('exam_id');

        $this->dbforge->create_table('tst_exam_response_text');

        /**
         * migration for tst_exam_student_mark
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'mark' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('exam_id');

        $this->dbforge->create_table('tst_exam_student_mark');

        $sql = "CREATE INDEX `tst_exam_student_mark_exam_id_index` ON tst_exam_student_mark(`exam_id`)";
        $this->db->query($sql);

        /**
         * migration for tst_question
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'difficulty' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'can_attach' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => TRUE
            ),
            'is_assignment' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_question');

        /**
         * migration for tst_question_attachment
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'file_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '11',
                'null' => TRUE
            ),
            'path' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_question_attachment');

        /**
         * migration for tst_question_option_points
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'option_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'point' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_question_option_points');

        /**
         * migration for tst_question_options
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'correct' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_question_options');

        /**
         * migration for tst_student_attachment
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'exam_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'student_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'file_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'path' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('tst_student_attachment');

        $sql = "CREATE UNIQUE INDEX `tst_student_attachment_id_uindex` ON tst_student_attachment(`id`)";
        $this->db->query($sql);


        /**
         * migration for tst_question_outcome
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('question_id');
        $this->dbforge->add_key('outcome_id');

        $this->dbforge->create_table('tst_question_outcome');
    }
    
    public function down() {

        /**
         * migration for tst_exam
         */
        $this->dbforge->drop_table('tst_exam');

        /**
         * migration for tst_exam_attachment
         */
        $this->dbforge->drop_table('tst_exam_attachment');

        /**
         * migration for tst_exam_attendance
         */
        $this->dbforge->drop_table('tst_exam_attendance');

        /**
         * migration for tst_exam_monitors
         */
        $this->dbforge->drop_table('tst_exam_monitors');

        /**
         * migration for tst_exam_questions
         */
        $this->dbforge->drop_table('tst_exam_questions');

        /**
         * migration for tst_exam_response_attachment
         */
        $this->dbforge->drop_table('tst_exam_response_attachment');

        /**
         * migration for tst_exam_response_choice
         */
        $this->dbforge->drop_table('tst_exam_response_choice');

        /**
         * migration for tst_exam_response_text
         */
        $this->dbforge->drop_table('tst_exam_response_text');

        /**
         * migration for tst_exam_student_mark
         */
        $this->dbforge->drop_table('tst_exam_student_mark');

        /**
         * migration for tst_question
         */
        $this->dbforge->drop_table('tst_question');

        /**
         * migration for tst_question_attachment
         */
        $this->dbforge->drop_table('tst_question_attachment');

        /**
         * migration for tst_question_option_points
         */
        $this->dbforge->drop_table('tst_question_option_points');

        /**
         * migration for tst_question_options
         */
        $this->dbforge->drop_table('tst_question_options');

        /**
         * migration for tst_student_attachment
         */
        $this->dbforge->drop_table('tst_student_attachment');

    }
    
}
