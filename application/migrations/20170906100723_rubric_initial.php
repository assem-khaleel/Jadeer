<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Migration_Rubric_Initial
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Rubric_Initial extends CI_Migration
{
    function up() {

        /**
         * migration for rb_rubrics
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'name_ar' => array(
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
            'rubric_class' => array(
                'type' => 'tinytext',
                'null' => false
            ),
            'weight_type' => array(
                'type' => 'int',
                'constraint' => 1,
                'null' => false,
                'default' => '0'
            ),
            'extra_data' => array(
                'type' => 'text',
                'null' => false
            ),
            'rubric_type' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'creator' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'publisher' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'int',
                'constraint' => 11,
                'null' => TRUE
            ),
            'end_date' => array(
                'type' => 'int',
                'constraint' => 11,
                'null' => TRUE
            ),
            'date_added' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'date_modified' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('rb_rubrics');

        /**
         * migration for rb_evaluations
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'rubrics_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'date_added' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'criteria' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )

        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('rubrics_id', false);

        $this->dbforge->create_table('rb_evaluations');


        /**
         * migration for rb_scale
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 21,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'rubrics_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'name_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'weight' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_key('rubrics_id', false);

        $this->dbforge->create_table('rb_scale');

        /**
         * migration for rb_skills
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 21,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'rubrics_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'name_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'value' => array(
                'type' => 'INT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'extra_data' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'date_added' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_modified' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_key('rubrics_id', false);

        $this->dbforge->create_table('rb_skills');

        /**
         * migration for rb_table
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 25,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'rubric_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'skill_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'scale_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'target' => array(
                'type' => 'INT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'description_en' => array(
                'type' => 'text',
                'null' => true
            ),
            'description_ar' => array(
                'type' => 'text',
                'null' => true
            ),
            'date_added' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_modified' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('rubric_id', false);

        $this->dbforge->add_key(['skill_id', 'scale_id'], false);

        $this->dbforge->create_table('rb_table');

        /**
         * migration for rb_result
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 25,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'evaluator' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'rubric_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'skill_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'scale_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_key('evaluator', false);
        $this->dbforge->add_key('user_id', false);

        $this->dbforge->add_key('semester_id', false);
        $this->dbforge->add_key('rubric_id', false);

        $this->dbforge->add_key('skill_id', false);

        $this->dbforge->create_table('rb_result');


        /**
         * migration for rb_settings
         */
        $this->dbforge->add_field(array(

            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'key_text' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'key_value' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('rb_settings');

        $this->db->insert('rb_settings',['key_text'=>'scale_count', 'key_value'=>3]);
        $this->db->insert('rb_settings',['key_text'=>'scale_text_en', 'key_value'=>lang('scale')]);
        $this->db->insert('rb_settings',['key_text'=>'scale_text_ar', 'key_value'=>lang('scale')]);

    }

    public function down() {
        $this->dbforge->drop_table('rb_evaluations');
        $this->dbforge->drop_table('rb_result');
        $this->dbforge->drop_table('rb_rubrics');
        $this->dbforge->drop_table('rb_scale');
        $this->dbforge->drop_table('rb_settings');
        $this->dbforge->drop_table('rb_skills');
        $this->dbforge->drop_table('rb_table');
    }

}