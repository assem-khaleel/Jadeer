<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Migration_Data_Faculty_Performance
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Modify_Data_Faculty_Performance extends CI_Migration
{
    public function up()
    {
//        /**
//         *add table fb_form_Result_input
//         */
//        $this->dbforge->add_field(array(
//            'id' => array(
//                'type' => 'BIGINT',
//                'constraint' => 20,
//                'null' => FALSE,
//                'auto_increment' => TRUE
//            ),
//            'result_id' => array(
//                'type' => 'BIGINT',
//                'constraint' => 20,
//                'null' => FALSE
//            ),
//            'input_id' => array(
//                'type' => 'BIGINT',
//                'constraint' => 20,
//                'null' => FALSE
//            ),
//            'input_value_en' => array(
//                'type' => 'TEXT',
//                'null' => FALSE
//            ),
//            'input_value_ar' => array(
//                'type' => 'TEXT',
//                'null' => TRUE
//            ),
//        ));
//
//        $this->dbforge->add_key('id', TRUE);
//
//        $this->dbforge->create_table('fp_forms_result_input');
//
//        /**
//         * remove columns from fp_form_result
//         */
//        $this->dbforge->drop_column('fp_forms_result','input_id');
//        $this->dbforge->drop_column('fp_forms_result','input_value_en');
//        $this->dbforge->drop_column('fp_forms_result','input_value_ar');

//        /**
//         * add column called type in fp_forms
//         */
//        $this->dbforge->add_column(
//            'fp_forms_inputs',
//            [
//                'class_type'=> [
//                    'type' => 'VARCHAR',
//                    'constraint' => '45',
//                    'null' => FALSE
//                ]
//            ],
//            'form_id'
//        );


        // Ph.D. Dissertations Completed
        $this->db->update('fp_forms',['static_file'=>'phd_dissertations_completed'], array('id' => 13));

        // MS Non-Thesis Completed
        $this->db->update('fp_forms',['static_file'=>'ms_non_thesis_completed'], array('id' => 15));

        // Teaching Awards - External
        $this->db->update('fp_forms',['static_file'=>'teaching_awards_external'], array('id' => 21));

        // Post-Doctoral Students
        $this->db->update('fp_forms',['static_file'=>'post_doctoral_students'], array('id' => 29));

        // Current Ph.D. Students and Support
        $this->db->update('fp_forms',['static_file'=>'current_phd_students_and_support'], array('id' => 32));

        // Current MS Students and Support
        $this->db->update('fp_forms',['static_file'=>'current_ms_students_and_support'], array('id' => 33));

        // Course Development
//        $this->db->where('id', 5);
//        $this->db->delete('fp_forms_inputs');
//
//        // Laboratory Course Development
//        $this->db->where('id', 10);
//        $this->db->delete('fp_forms_inputs');
//
//        // Curricular Revisions
//        $this->db->where('id', 46);
//        $this->db->delete('fp_forms_inputs');
//
//        // Courses Taught
//        $this->db->where('id', 54);
//        $this->db->delete('fp_forms_inputs');

    }



    public function down()
    {
//        /**
//         *remove table fb_form_Result_input
//         */
//        $this->dbforge->drop_table('fp_forms_result_input');
//
//        /**
//         * add columns from fp_form_result
//         */
//        $this->dbforge->add_column(
//            'fp_forms_result',
//            [
//                'input_id' => [
//                    'type' => 'BIGINT',
//                    'constraint' => 20,
//                    'null' => FALSE
//                ],
//                'input_value_en' => [
//                    'type' => 'TEXT',
//                    'null' => FALSE
//                ],
//                'input_value_ar' => [
//                    'type' => 'TEXT',
//                    'null' => TRUE
//                ]
//            ],
//            'form_id'
//        );
//
//        /**
//         * drop column called type in fp_forms
//         */
//        $this->dbforge->drop_column('fp_forms_inputs','class_type');

        // Ph.D. Dissertations Completed
        $this->db->update('fp_forms',['static_file'=>'phd_dissertations_completed'], array('id' => 13));

        // MS Non-Thesis Completed
        $this->db->update('fp_forms',['static_file'=>'ms_non_thesis_completed'], array('id' => 15));

        // Teaching Awards - External
        $this->db->update('fp_forms',['static_file'=>'teaching_awards_external'], array('id' => 21));

        // Post-Doctoral Students
        $this->db->update('fp_forms',['static_file'=>'post_doctoral_students'], array('id' => 29));

        // Current Ph.D. Students and Support
        $this->db->update('fp_forms',['static_file'=>'current_phd_students_and_support'], array('id' => 32));

        // Current MS Students and Support
        $this->db->update('fp_forms',['static_file'=>'current_ms_students_and_support'], array('id' => 33));

    }
}