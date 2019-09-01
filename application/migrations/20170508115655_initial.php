<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Initial extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for acc_independent_reviewer
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'type' => array(
                'type' => "ENUM('institution','program')",
                'null' => FALSE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'cv_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'report_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'cv_text' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'recommendations' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'report_text' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_independent_reviewer');
        
        /**
        * migration for acc_pre_visit_reviewer
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'type' => array(
                'type' => "ENUM('institution','program')",
                'null' => TRUE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_pre_visit_reviewer');
        
        /**
        * migration for acc_pre_visit_reviewer_action_plan
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'due_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'responsible' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'progress' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'recommendation_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_pre_visit_reviewer_action_plan');
        
        /**
        * migration for acc_pre_visit_reviewer_recommendation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'visit_reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'recommendation' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'type' => array(
                'type' => "ENUM('institution','program')",
                'null' => FALSE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATE',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_pre_visit_reviewer_recommendation');
        
        /**
        * migration for acc_status
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'agency' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'status_date' => array(
                'type' => 'DATE',
                'null' => FALSE,
                'default' => '0000-00-00'
            ),
            'note' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'quitity_coordinator' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'program_chair' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'dean' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'accredited' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_status');
        
        /**
        * migration for acc_visit_reviewer
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'type' => array(
                'type' => "ENUM('institution','program')",
                'null' => TRUE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_visit_reviewer');
        
        /**
        * migration for acc_visit_reviewer_action_plan
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'due_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'responsible' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'progress' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'recommendation_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_visit_reviewer_action_plan');
        
        /**
        * migration for acc_visit_reviewer_recommendation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'visit_reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'recommendation' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'type' => array(
                'type' => "ENUM('institution','program')",
                'null' => FALSE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATE',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('acc_visit_reviewer_recommendation');
        
        /**
        * migration for al_action
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'assessment_loop_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'action_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'action_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'responsible_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'responsible_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'time_frame_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'time_frame_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('al_action');
        
        /**
        * migration for al_analysis
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'assessment_loop_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('al_analysis');
        
        /**
        * migration for al_assessment_loop
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'item_class' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'item_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'item_type' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => TRUE
            ),
            'item_type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'extra_data' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'deadline' => array(
                'type' => 'DATE',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('al_assessment_loop');
        
        /**
        * migration for al_custom
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('al_custom');
        
        /**
        * migration for al_measure
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'assessment_loop_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('al_measure');
        
        /**
        * migration for al_recommendation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'assessment_loop_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('al_recommendation');
        
        /**
        * migration for al_result
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'assessment_loop_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('al_result');
        
        /**
        * migration for ams_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_added' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'is_released' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_released' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'comment' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'forms' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('ams_log');
        
        /**
        * migration for as_agency
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '125',
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '125',
                'null' => FALSE
            ),
            'accredited_years' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'notify_before' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('as_agency');
        
        /**
        * migration for as_agency_mapping
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'agency_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('as_agency_mapping');
        
        /**
        * migration for as_status
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'agency' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'status_date' => array(
                'type' => 'DATE',
                'null' => FALSE,
                'default' => '0000-00-00'
            ),
            'note' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'quality_coordinator' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'program_chair' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'chair_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'chair_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'chair_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '125',
                'null' => TRUE
            ),
            'dean' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'dean_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'dean_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'dean_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '125',
                'null' => TRUE
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'accredited' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('as_status');
        
        /**
        * migration for backup
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'is_active' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ),
            'params' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('backup');
        
        /**
        * migration for campus
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('campus');
        
        /**
        * migration for campus_college
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'campus_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('campus_college');
        
        /**
        * migration for ci_sessions
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'timestamp' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
                'default' => '0',
                'unsigned' => TRUE
            ),
            'data' => array(
                'type' => 'BLOB',
                'constraint' => '',
                'null' => FALSE
            )
        ));
        
        
        $this->dbforge->create_table('ci_sessions');
        
        $sql = "CREATE INDEX `ci_sessions_timestamp` ON ci_sessions(`timestamp`)";
        $this->db->query($sql);
        
        /**
        * migration for cm_active_data
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'is_archived' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_active_data');
        
        /**
        * migration for cm_assessment_component
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_assessment_component');
        
        /**
        * migration for cm_assessment_method
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_assessment_method');
        
        /**
        * migration for cm_course_assessment_method
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'program_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'text_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'text_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_assessment_method');
        
        $sql = "CREATE INDEX `cm_course_assessment_method_course_id_index` ON cm_course_assessment_method(`course_id`)";
        $this->db->query($sql);
        
        /**
        * migration for cm_course_assessment_method_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
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
            'log_course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_program_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_text_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'log_text_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_assessment_method_log');
        
        /**
        * migration for cm_course_learning_outcome
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
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
            'learning_domain_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_learning_outcome');
        
        $sql = "CREATE INDEX `cm_course_learning_outcome_course_id_index` ON cm_course_learning_outcome(`course_id`)";
        $this->db->query($sql);
        
        $sql = "CREATE INDEX `cm_course_learning_outcome_program_learning_outcome_id_index` ON cm_course_learning_outcome(`program_learning_outcome_id`)";
        $this->db->query($sql);
        
        $sql = "CREATE INDEX `cm_course_learning_outcome_learning_domain_id_index` ON cm_course_learning_outcome(`learning_domain_id`)";
        $this->db->query($sql);
        
        /**
        * migration for cm_course_learning_outcome_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
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
            'log_learning_domain_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'log_text_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'log_text_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'log_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_learning_outcome_log');
        
        /**
        * migration for cm_course_learning_outcome_survey
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'survey_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'factor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'statement_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_learning_outcome_survey');
        
        /**
        * migration for cm_course_learning_outcome_target
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'target' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_learning_outcome_target');
        
        /**
        * migration for cm_course_learning_outcome_target_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
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
            'log_course_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_target' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_learning_outcome_target_log');
        
        /**
        * migration for cm_course_mapping_matrix
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'course_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'course_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'course_assessment_component_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_mapping_matrix');
        
        $sql = "CREATE INDEX `cm_course_mapping_matrix_course_id_index` ON cm_course_mapping_matrix(`course_id`)";
        $this->db->query($sql);
        
        /**
        * migration for cm_course_mapping_matrix_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_course_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_course_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_course_assessment_component_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_mapping_matrix_log');
        
        /**
        * migration for cm_course_offered_program
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_course_offered_program');
        
        $sql = "CREATE INDEX `cm_course_offered_program_course_id_index` ON cm_course_offered_program(`course_id`)";
        $this->db->query($sql);
        
        /**
        * migration for cm_learning_domain
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'ncaaa_code' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_learning_domain');
        
        /**
        * migration for cm_learning_outcome
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'learning_domain_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_learning_outcome');
        
        /**
        * migration for cm_program_assessment_component
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'program_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'assessment_component_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'text_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'text_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_assessment_component');
        
        /**
        * migration for cm_program_assessment_component_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_program_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_assessment_component_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_text_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'log_text_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_assessment_component_log');
        
        /**
        * migration for cm_program_assessment_method
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
            'assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_assessment_method');
        
        /**
        * migration for cm_program_assessment_method_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
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
            'log_program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_assessment_method_log');
        
        /**
        * migration for cm_program_learning_outcome
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'learning_domain_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'text_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'text_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_learning_outcome');
        
        /**
        * migration for cm_program_learning_outcome_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_learning_domain_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_text_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'log_text_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'log_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_learning_outcome_log');
        
        /**
        * migration for cm_program_learning_outcome_survey
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'survey_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'factor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'statement_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_learning_outcome_survey');
        
        /**
        * migration for cm_program_learning_outcome_target
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'target' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_learning_outcome_target');
        
        /**
        * migration for cm_program_learning_outcome_target_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
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
            'log_program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_target' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_learning_outcome_target_log');
        
        /**
        * migration for cm_program_mapping_matrix
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
                'null' => FALSE,
                'default' => '0'
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'ipa' => array(
                'type' => "ENUM('i','a','p')",
                'null' => FALSE,
                'default' => 'i'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_mapping_matrix');
        
        /**
        * migration for cm_program_mapping_matrix_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'log_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_program_learning_outcome_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'log_ipa' => array(
                'type' => "ENUM('i','a','p')",
                'null' => FALSE,
                'default' => 'i'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_program_mapping_matrix_log');
        
        /**
        * migration for cm_section_mapping_question
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'course_assessment_method_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'full_mark' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'question' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'course_learning_outcomes_ids' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_section_mapping_question');
        
        $sql = "CREATE INDEX `cm_section_mapping_question_section_id_index` ON cm_section_mapping_question(`section_id`)";
        $this->db->query($sql);
        
        $sql = "CREATE INDEX `cm_section_mapping_question_course_assessment_method_id_index` ON cm_section_mapping_question(`course_assessment_method_id`)";
        $this->db->query($sql);
        
        /**
        * migration for cm_section_student_assessment
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'student_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'section_mapping_question_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'score' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE,
                'default' => '0.00'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cm_section_student_assessment');
        
        $sql = "CREATE INDEX `SMQ_IDX` ON cm_section_student_assessment(`section_id`,`section_mapping_question_id`)";
        $this->db->query($sql);
        
        /**
        * migration for college
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'unit_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'area' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
                'default' => '0.00'
            ),
            'size' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
                'default' => '0.00'
            ),
            'vision_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'vision_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('college');
        
        /**
        * migration for college_goal
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('college_goal');
        
        /**
        * migration for college_objective
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('college_objective');
        
        /**
        * migration for course
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'department_id' => array(
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
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => 'theoretical'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'code_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => ''
            ),
            'code_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('course');
        
        $sql = "CREATE INDEX `course_department_id_index` ON course(`department_id`)";
        $this->db->query($sql);
        
        /**
        * migration for course_section
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'campus_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'section_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE,
                'default' => ''
            ),
            'extra_params' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('course_section');
        
        $sql = "CREATE INDEX `course_section_course_id_index` ON course_section(`course_id`)";
        $this->db->query($sql);
        
        $sql = "CREATE INDEX `course_section_semester_id_index` ON course_section(`semester_id`)";
        $this->db->query($sql);
        
        /**
        * migration for course_section_student
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('course_section_student');
        
        $sql = "CREATE INDEX `course_section_student_section_id_index` ON course_section_student(`section_id`)";
        $this->db->query($sql);
        
        /**
        * migration for course_section_teacher
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('course_section_teacher');
        
        /**
        * migration for criteria
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'standard_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'is_program' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'date_modified' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('criteria');
        
        /**
        * migration for cron_job
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'job_key' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'job' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'user_added' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'is_released' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_released' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'schedule' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('cron_job');
        
        /**
        * migration for data_academic_units
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_deanships' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_colleges' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_programs' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_institutions' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_research_center' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_research_chairs' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_medical_hospital' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'no_scientific' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_academic_units');
        
        /**
        * migration for data_cohort
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
            'report_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'level_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'started_on' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'status_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'student_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_cohort');
        
        /**
        * migration for data_cohort_status
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'status_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_cohort_status');
        
        /**
        * migration for data_cohort_table
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
                'null' => TRUE
            ),
            'report_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'start_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'level_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'cohort_enroll' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'retain_till_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'withdrawn_enrolled' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'withdrawn_good' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'graduated' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_cohort_table');
        
        /**
        * migration for data_college
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'position' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_college');
        
        /**
        * migration for data_competion_rate
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
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'number_of_years' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'graduate_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_competion_rate');
        
        $sql = "CREATE INDEX `SearchIndx` ON data_competion_rate(`academic_year`,`program_id`,`gender`)";
        $this->db->query($sql);
        
        /**
        * migration for data_course_grade
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
                'null' => TRUE,
                'default' => '0'
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'grade' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE
            ),
            'student_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_course_grade');
        
        /**
        * migration for data_course_pre
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
            'pre_course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_course_pre');
        
        /**
        * migration for data_course_status
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
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'status_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'student_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_course_status');
        
        /**
        * migration for data_course_statuses
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'status_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_course_statuses');
        
        /**
        * migration for data_course_students
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
                'null' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'student_start_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'student_complete_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_course_students');
        
        /**
        * migration for data_faculty
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
                'null' => TRUE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'teaching_assistant_male' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'teaching_assistant_female' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'instructor_male' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'instructor_female' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'assistant_prof_male' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'assistant_prof_female' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'associate_prof_male' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'associate_prof_female' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'prof_male' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'prof_female' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_faculty');
        
        /**
        * migration for data_graduate
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
            'academic_year' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'gender' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'nationality' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'major' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'graduate_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'enrolled_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_graduate');
        
        $sql = "CREATE INDEX `SearchIndx` ON data_graduate(`academic_year`,`program_id`)";
        $this->db->query($sql);
        
        /**
        * migration for data_institution
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'full_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'telephone' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'position' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_institution');
        
        /**
        * migration for data_level_enrolled
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
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'enrolled_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'nationality' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_level_enrolled');
        
        /**
        * migration for data_periodic_program
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
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'nationality' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'phd_holder_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'teaching_staff_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_periodic_program');
        
        /**
        * migration for data_periodic_program_ext
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
                'null' => TRUE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'work_load' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'class_size' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_periodic_program_ext');
        
        /**
        * migration for data_preparatory_year
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'stream' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'nationality' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'student_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'teaching_staff_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'completion_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_preparatory_year');
        
        /**
        * migration for data_preparatory_year_faculty
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'stream' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'gender' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'teacher_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_preparatory_year_faculty');
        
        /**
        * migration for data_research_budget
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
            'academic_year' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'research_budget_total_amount' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'research_budget_actual_expenditure' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'publications_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'conferece_presentation_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'male_faculty_member_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'female_faculty_member_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_research_budget');
        
        /**
        * migration for data_workload
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
                'null' => TRUE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'semester' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'work_load' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE
            ),
            'class_size' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('data_workload');
        
        /**
        * migration for degree
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'is_undergraduate' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('degree');
        
        /**
        * migration for department
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('department');
        
        /**
        * migration for fp_academic_article
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
            'authors' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'author_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'publisher' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_academic_article');
        
        /**
        * migration for fp_academic_qualification
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
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'university' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'college' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'date_from' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'date_to' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'degree' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'grade' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'speciality' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'supervisor_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'thises_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_academic_qualification');
        
        /**
        * migration for fp_academic_rank
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
            'academic_rank' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'rank_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_academic_rank');
        
        /**
        * migration for fp_administrative_work
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
            'start_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'position' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'department_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'deanship_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'vice_recotrate' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_administrative_work');
        
        /**
        * migration for fp_advising
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
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'number_of_students' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'number_of_sections' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'subject_taught' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_advising');
        
        /**
        * migration for fp_award
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'domain' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'party' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'null' => TRUE
            ),
            'material_value' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'moral_value' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_award');
        
        /**
        * migration for fp_book
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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'author_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'authors' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'authors_no' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'publish_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'publisher' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'pages_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'is_translate' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_book');
        
        /**
        * migration for fp_committee
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_committee');
        
        /**
        * migration for fp_conference
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
            'is_workshop' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'location' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'participation_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_conference');
        
        /**
        * migration for fp_creative_work
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'owner_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'dissemination_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'funds_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'funds' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_creative_work');
        
        /**
        * migration for fp_dissertation
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
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'is_new' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'is_main' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'dissertation_no' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_dissertation');
        
        /**
        * migration for fp_evaluation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'user_score' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => TRUE
            ),
            'peer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'peer_score' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => TRUE
            ),
            'supervisor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'supervisor_score' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_evaluation');
        
        /**
        * migration for fp_experience
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
                'null' => TRUE
            ),
            'organization' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'date_from' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'date_to' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'position' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'address' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_experience');

        /**
         * migration for fp_forms
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'form_name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => FALSE
            ),
            'form_name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'default' => '0000-00-00 00:00:00'
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'default' => '0000-00-00 00:00:00'
            ),
            'deleted_at' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'static_file' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'is_hidden' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_editable' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms');

        /**
         * migration for fp_forms_deadline
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'start_date' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'end_date' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'deleted_at' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms_deadline');

        /**
         * migration for fp_forms_evaluations
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
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'value' => array(
                'type' => 'DOUBLE',
                'constraint' => '',
                'null' => FALSE
            ),
            'deadline_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'deleted_at' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms_evaluations');

        /**
         * migration for fp_forms_inputs
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'form_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'input_label_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => FALSE
            ),
            'input_label_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'deleted_at' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms_inputs');

        /**
         * migration for fp_forms_rate
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'deadline_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'rate' => array(
                'type' => 'DOUBLE',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'deleted_at' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms_rate');

        /**
         * migration for fp_forms_recommendation
         */
        $this->dbforge->add_field(array(
            'recommendation_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => TRUE
            ),
            'recommendation_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => TRUE
            ),
            'action_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => TRUE
            ),
            'action_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => TRUE
            ),
            'deadline_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'category_id' => array(
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
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms_recommendation');

        /**
         * migration for fp_forms_result
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'form_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'input_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'input_value_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'input_value_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'deadline_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'deleted_at' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms_result');

        /**
         * migration for fp_forms_type
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'type_name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'type_name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'default' => '0000-00-00 00:00:00'
            ),
            'deleted_at' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_removable' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_forms_type');
        
        /**
        * migration for fp_general_information
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
            'mobile_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'personal_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'contract_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'contract_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'contract_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'cv_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'cv_text_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'cv_text_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'website' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'twitter' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'facebook' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'linkedin' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_general_information');
        
        /**
        * migration for fp_language
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
            'language' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'is_native' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_language');
        
        /**
        * migration for fp_project
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'date_from' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'date_to' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'location' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'membership' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_project');
        
        /**
        * migration for fp_research
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
            'number' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'publish_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'publish_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'language' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'summary' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'comments' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'issn' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'isi' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'other' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'isbn' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'source' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'published_in' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'page_from' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'page_to' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'page_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'original_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'original_language' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'original_researcher' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'authors' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'participant_count' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'position_rank' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'agreement_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'agreement_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'research_center' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'research_budget' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'support_party' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'paper_status' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_research');
        
        /**
        * migration for fp_skill
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'null' => TRUE
            ),
            'rank' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_skill');
        
        /**
        * migration for fp_supervision
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
            'thises_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => TRUE
            ),
            'level' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => TRUE
            ),
            'thises_title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'thises_title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'grant_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'researcher' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'summary_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'summary_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_supervision');
        
        /**
        * migration for fp_training
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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'duration' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'address' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_training');
        
        /**
        * migration for institution
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
                'null' => TRUE
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'univ_logo_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'univ_logo_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'login_bg_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'login_bg_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'cs_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'cr_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'fes_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'fer_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'ps_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'pr_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'ssr_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'sesr_cover' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'vision_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'vision_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('institution');
        
        /**
        * migration for institution_goal
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'institution_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('institution_goal');
        
        /**
        * migration for institution_objective
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'institution_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('institution_objective');
        
        /**
        * migration for item
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'title' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'criteria_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('item');
        
        /**
        * migration for kpi
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'criteria_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => FALSE
            ),
            'title' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'kpi_type' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'chart_y_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE,
                'default' => ''
            ),
            'college_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => '0'
            ),
            'unit_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => '0'
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'category_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_semester' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            ),
            'overall' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_core' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'institution_score' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'college_score' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'ncaaa' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi');
        
        /**
        * migration for kpi_college_value
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'detail_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'actual_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE
            ),
            'internal_college_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'internal_institution_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'target_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'new_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'external_benchmark' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_college_value');
        
        /**
        * migration for kpi_detail
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'legend_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_detail');
        
        /**
        * migration for kpi_escalation_legend_value
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'escalation_level_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'legend_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'value' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE
            ),
            'is_less' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_escalation_legend_value');
        
        /**
        * migration for kpi_escalation_level
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'color' => array(
                'type' => 'VARCHAR',
                'constraint' => '7',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_escalation_level');
        
        /**
        * migration for kpi_escalation_plan
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'legend_value_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'plan' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_escalation_plan');
        
        /**
        * migration for kpi_escalation_polarity
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'kpi_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'polarity' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_escalation_polarity');
        
        /**
        * migration for kpi_escalation_user
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'escalation_level_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_escalation_user');
        
        /**
        * migration for kpi_institution_value
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'detail_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'actual_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE
            ),
            'internal_college_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'internal_institution_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'target_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'new_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'external_benchmark' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_institution_value');
        
        /**
        * migration for kpi_legend
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'level_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_legend');
        
        /**
        * migration for kpi_level
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'level' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'kpi_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_level');
        
        /**
        * migration for kpi_level_description
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'kpi_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'level_number' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_level_description');
        
        $sql = "CREATE UNIQUE INDEX `kpi_level_description_id_uindex` ON kpi_level_description(`id`)";
        $this->db->query($sql);
        
        /**
        * migration for kpi_level_settings
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'label_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'label_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_level_settings');

        /**
        * migration for kpi_program_value
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'detail_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'actual_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE
            ),
            'internal_college_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'internal_institution_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'target_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'new_benchmark' => array(
                'type' => 'DECIMAL',
                'constraint' => '11,3',
                'null' => FALSE,
                'default' => '0.000'
            ),
            'external_benchmark' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_program_value');
        
        /**
        * migration for kpi_survey
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'kpi_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'survey_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'factor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'statement_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('kpi_survey');
        
        $sql = "CREATE UNIQUE INDEX `UNIQ` ON kpi_survey(`kpi_id`,`survey_id`,`factor_id`,`statement_id`)";
        $this->db->query($sql);
        
        /**
        * migration for major
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('major');
        
        /**
        * migration for manual
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'label_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE,
                'default' => ''
            ),
            'label_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE,
                'default' => ''
            ),
            'link_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE,
                'default' => ''
            ),
            'link_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('manual');
        
        /**
        * migration for node
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_lft' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_rgt' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'system_number' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'item_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_finished' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_form' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_shared' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'shared_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'due_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'review_status' => array(
                'type' => "ENUM('none','compliant','not_compliant','partly_compliant')",
                'null' => FALSE,
                'default' => 'none'
            ),
            'properties' => array(
                'type' => 'LONGTEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('node');
        
        $sql = "CREATE INDEX `LftIndx` ON node(`parent_lft`)";
        $this->db->query($sql);
        
        /**
        * migration for node_assessor
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'node_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'assessor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('node_assessor');
        
        /**
        * migration for node_builder
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'form_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'agency_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'version' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'link_pdf' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'link_view' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'link_edit' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'components' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('node_builder');
        
        /**
        * migration for node_log
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'logged_user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'node_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'node_parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'node_item_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'node_system_number' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'node_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'node_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'node_class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'node_date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'node_is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'node_is_finished' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'node_due_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'node_review_status' => array(
                'type' => "ENUM('none','compliant','not_compliant','partly_compliant')",
                'null' => FALSE,
                'default' => 'none'
            ),
            'node_properties' => array(
                'type' => 'LONGTEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('node_log');
        
        /**
        * migration for node_review
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'node_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'status' => array(
                'type' => "ENUM('none','compliant','not_compliant','partly_compliant')",
                'null' => FALSE,
                'default' => 'none'
            ),
            'comment' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('node_review');
        
        /**
        * migration for node_reviewer
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'node_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'reviewer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('node_reviewer');
        
        /**
        * migration for notification
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'sender_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'receiver_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'body' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'is_read' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('notification');
        
        /**
        * migration for notification_settings
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
            'notification_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'allow_email' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ),
            'allow_sms' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('notification_settings');
        
        /**
        * migration for notification_template
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            'body' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('notification_template');
        
        /**
        * migration for pc_assignment
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'SMALLINT',
                'constraint' => 6,
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'file_path' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_assignment');
        
        /**
        * migration for pc_catalog_information
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'credit_hours' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_catalog_information');
        
        /**
        * migration for pc_category
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            ),
            'description_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            ),
            'level' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            'deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'create_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'update_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'updated_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_category');
        
        /**
        * migration for pc_course_policies
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'grading_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'grading_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'attendance_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'attendance_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lateness_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lateness_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'class_participation_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'class_participation_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'missed_exam_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'missed_exam_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'missed_assignment_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'missed_assignment_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'academic_dishonesty_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'academic_dishonesty_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'academic_plagiarism_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'academic_plagiarism_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_course_policies');
        
        /**
        * migration for pc_format
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'assignment_format_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'homework_format_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lab_experiment_format_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'class_exercise_format_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'file_name_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'file_name_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_format');
        
        /**
        * migration for pc_instructor_information
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
            'section_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'office_location' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'office_hours' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_instructor_information');
        
        /**
        * migration for pc_material
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'material_type' => array(
                'type' => 'SMALLINT',
                'constraint' => 6,
                'null' => FALSE
            ),
            'material_location' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'author' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'release_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'edition' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'publisher' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_material');
        
        /**
        * migration for pc_report
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_report');
        
        /**
        * migration for pc_report_components
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'report_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'component_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'is_core' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_report_components');
        
        /**
        * migration for pc_settings
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'entity_key' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'entity_value' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_settings');
        
        /**
        * migration for pc_student_work
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'student_project_file' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'grading_guideline_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'grading_guideline_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_student_work');
        
        /**
        * migration for pc_support_material
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'construction_technique_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'equipment_documentation_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'computer_documentation_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'troubleshooting_tip_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'debugging_tip_file' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'addition_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'addition_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'file_name_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'file_name_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_support_material');
        
        /**
        * migration for pc_support_service
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'available_support_service_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'available_support_service_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_support_service');
        
        /**
        * migration for pc_syllabus_fields
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'category_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'field_type' => array(
                'type' => "ENUM('text','richtext','date','checkbox','file','radio')",
                'null' => FALSE
            ),
            'value' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'required' => array(
                'type' => "ENUM('0','1')",
                'null' => FALSE
            ),
            'display' => array(
                'type' => "ENUM('0','1')",
                'null' => FALSE
            ),
            'deleted' => array(
                'type' => "ENUM('0','1')",
                'null' => FALSE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'updated_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'create_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'update_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_syllabus_fields');
        
        $sql = "CREATE INDEX `category_id` ON pc_syllabus_fields(`category_id`)";
        $this->db->query($sql);
        
        /**
        * migration for pc_syllabus_fields_value
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'category_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'value' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'deleted' => array(
                'type' => "ENUM('0','1')",
                'null' => FALSE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'updated_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'create_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'update_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_syllabus_fields_value');
        
        $sql = "CREATE INDEX `category_id` ON pc_syllabus_fields_value(`category_id`)";
        $this->db->query($sql);
        
        /**
        * migration for pc_teaching_material
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'course_manual_file' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'lecture_note_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'lecture_note_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'addition_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'addition_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'course_manual_title_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'course_manual_title_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_teaching_material');
        
        /**
        * migration for pc_topic
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'course_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pc_topic');
        
        /**
        * migration for program
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'department_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'code_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'code_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'credit_hours' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
                'default' => '0'
            ),
            'duration' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
                'default' => '0'
            ),
            'degree_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'vision_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'vision_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('program');
        
        /**
        * migration for program_goal
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
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('program_goal');
        
        /**
        * migration for program_objective
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
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('program_objective');
        
        /**
        * migration for program_plan
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
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'credit_hours' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_required' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('program_plan');
        
        $sql = "CREATE INDEX `PP_IDX` ON program_plan(`program_id`,`course_id`)";
        $this->db->query($sql);
        
        /**
        * migration for pt_college_program_relation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'kcollege_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'kprogram_id' => array(
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
        
        $this->dbforge->create_table('pt_college_program_relation');
        
        /**
        * migration for pt_goal_program
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pt_goal_program');
        
        /**
        * migration for pt_keyword
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pt_keyword');
        
        /**
        * migration for pt_keyword_college
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'keyword_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pt_keyword_college');
        
        /**
        * migration for pt_keyword_program
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'keyword_id' => array(
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
        
        $this->dbforge->create_table('pt_keyword_program');
        
        /**
        * migration for pt_keyword_uni
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'keyword_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pt_keyword_uni');
        
        /**
        * migration for pt_kpi_major_relation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'major_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'kpi_id' => array(
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
        
        $this->dbforge->create_table('pt_kpi_major_relation');
        
        /**
        * migration for pt_obj_plo_relation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'obj_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'plo_id' => array(
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
        
        $this->dbforge->create_table('pt_obj_plo_relation');
        
        /**
        * migration for pt_obj_program_relation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'obj_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'kprogram_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pt_obj_program_relation');
        
        /**
        * migration for pt_uni_college_relation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'kuni_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'kcollege_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('pt_uni_college_relation');
        
        /**
        * migration for role
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'credential' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'admin_level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('role');
        
        /**
        * migration for semester
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'start' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'end' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('semester');
        
        /**
        * migration for sp_action_plan
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'initiative_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'responsible_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'budget' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE,
                'default' => '0.00'
            ),
            'resources' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_action_plan');
        
        /**
        * migration for sp_action_plan_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'action_plan_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_action_plan_history');
        
        /**
        * migration for sp_action_plan_recommend
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'action_plan_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'recommend_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_action_plan_recommend');
        
        $sql = "CREATE INDEX `action_plan_idx` ON sp_action_plan_recommend(`action_plan_id`,`recommend_id`)";
        $this->db->query($sql);
        
        /**
        * migration for sp_activity
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'project_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'weight' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => '0'
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_activity');
        
        /**
        * migration for sp_activity_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'activity_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_activity_history');
        
        /**
        * migration for sp_activity_milestone
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'activity_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'value' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_activity_milestone');
        
        /**
        * migration for sp_bi_monthly_report
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'action_plan_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_generated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'approved_by' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'summary_report' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'completion_certifed' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'date_completed' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'next_steps' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'timeline_actions' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'overall_approval_by' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_bi_monthly_report');
        
        $sql = "CREATE INDEX `action_plan_idx` ON sp_bi_monthly_report(`action_plan_id`,`date_generated`)";
        $this->db->query($sql);
        
        /**
        * migration for sp_bi_monthly_summary
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'action_plan_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_generated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'contact' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'signatory_program' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'signatory_mentor' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_bi_monthly_summary');
        
        $sql = "CREATE INDEX `action_plan_idx` ON sp_bi_monthly_summary(`action_plan_id`,`date_generated`)";
        $this->db->query($sql);
        
        /**
        * migration for sp_goal
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'strategy_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'goal_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_lft' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_rtl' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_goal');
        
        /**
        * migration for sp_goal_goal
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'sp_goal_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'goal_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'goal_class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_goal_goal');
        
        /**
        * migration for sp_goal_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'goal_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_goal_history');
        
        /**
        * migration for sp_initiative
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'objective_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'owner_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE,
                'default' => '0'
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_initiative');
        
        /**
        * migration for sp_initiative_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'initiative_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_initiative_history');
        
        /**
        * migration for sp_initiative_milestone
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'initiative_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'target' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_initiative_milestone');
        
        /**
        * migration for sp_kpi
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'kpi_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'polarity' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'band' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_kpi');
        
        /**
        * migration for sp_kpi_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'kpi_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'band' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_kpi_history');
        
        /**
        * migration for sp_objective
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'strategy_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'goal_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'objective_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_lft' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_rtl' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'owner_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'budget' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'resources' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_objective');
        
        /**
        * migration for sp_objective_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'objective_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_objective_history');
        
        /**
        * migration for sp_objective_milestone
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'objective_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'target' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_objective_milestone');
        
        /**
        * migration for sp_objective_objective
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'sp_objective_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'objective_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'objective_class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_objective_objective');
        
        /**
        * migration for sp_objective_perspective
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'objective_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'perspective' => array(
                'type' => "ENUM('none','customer','learning_and_growth','internal_processes','finance')",
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_objective_perspective');
        
        /**
        * migration for sp_overall_action_plan
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'action_plan_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_generated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'academic_year' => array(
                'type' => 'VARCHAR',
                'constraint' => '125',
                'null' => TRUE
            ),
            'completion_certifed' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'date_completed' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'perpared_by' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'accepted_by' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_overall_action_plan');
        
        $sql = "CREATE INDEX `action_plan_idx` ON sp_overall_action_plan(`action_plan_id`,`date_generated`)";
        $this->db->query($sql);
        
        /**
        * migration for sp_project
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'action_plan_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'project_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_lft' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_rtl' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'budget' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE
            ),
            'resources' => array(
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
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_project');
        
        /**
        * migration for sp_project_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'project_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_project_history');
        
        /**
        * migration for sp_reason_action_plan
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'overall_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'reason_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '125',
                'null' => TRUE
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_reason_action_plan');
        
        $sql = "CREATE INDEX `overall_idx` ON sp_reason_action_plan(`overall_id`)";
        $this->db->query($sql);
        
        /**
        * migration for sp_recommendation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'recommendation_type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'academic_year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_recommendation');
        
        /**
        * migration for sp_recommendation_type
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_recommendation_type');
        
        /**
        * migration for sp_risk_tab
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'risk' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'impact' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_risk_tab');
        
        /**
        * migration for sp_strategy
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'strategy_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_lft' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_rgt' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'item_class' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'item_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'vision_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'vision_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'mission_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'mission_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_en' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_ar' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_strategy');
        
        /**
        * migration for sp_strategy_history
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'strategy_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'lead' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            ),
            'lag' => array(
                'type' => 'FLOAT',
                'constraint' => '',
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_strategy_history');
        
        /**
        * migration for sp_values
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'strategy_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'desc_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'desc_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('sp_values');
        
        /**
        * migration for standard
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '155',
                'null' => FALSE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'date_modified' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('standard');
        
        /**
        * migration for stp_academic
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
            'lms_link' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'edugate_link' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'student_academic_advicing' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('student_id', TRUE);
        
        $this->dbforge->create_table('stp_academic');
        
        /**
        * migration for stp_activities
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
                'null' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_activities');
        
        /**
        * migration for stp_awards_and_publications
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
                'null' => TRUE
            ),
            'title' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'publish_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'attachement' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_awards_and_publications');
        
        /**
        * migration for stp_community_services
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
                'null' => TRUE
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'location' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'number_of_hours' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE
            ),
            'supervisor' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_community_services');
        
        /**
        * migration for stp_complaints
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
                'null' => TRUE
            ),
            'attachement' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'complaints' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_complaints');
        
        /**
        * migration for stp_personal
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
                'null' => TRUE
            ),
            'resume' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            ),
            'personal_goals' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'hobbies' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_personal');
        
        /**
        * migration for stp_recommendations
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
                'null' => TRUE
            ),
            'added_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'attachement' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_recommendations');
        
        /**
        * migration for stp_social
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
                'null' => TRUE
            ),
            'facebook' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'tweeter' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            ),
            'linkedin' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('stp_social');
        
        /**
        * migration for student_status
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('student_status');
        
        /**
        * migration for student_status_log
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
            'status_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'date_added' => array(
                'type' => 'DATE',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('student_status_log');
        
        /**
        * migration for survey
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'title_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey');
        
        /**
        * migration for survey_evaluation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'survey_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'semester_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'description_english' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_arabic' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'criteria' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'date_added' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_evaluation');
        
        /**
        * migration for survey_evaluator
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'survey_evaluation_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'hash_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => ''
            ),
            'response_status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'response_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_evaluator');
        
        /**
        * migration for survey_page
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'survey_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'title_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'description_english' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_arabic' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'order' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_page');
        
        $sql = "CREATE INDEX `fk_survey_page_survey_id` ON survey_page(`survey_id`)";
        $this->db->query($sql);
        
        /**
        * migration for survey_question
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'page_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'question_english' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'question_arabic' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_english' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'description_arabic' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'order' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_require' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_question');
        
        $sql = "CREATE INDEX `fk_survey_question_page_id` ON survey_question(`page_id`)";
        $this->db->query($sql);
        
        $sql = "CREATE INDEX `fk_survey_question_question_type_id` ON survey_question(`class_type`)";
        $this->db->query($sql);
        
        /**
        * migration for survey_question_choice
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
                'null' => FALSE,
                'default' => '0'
            ),
            'choice_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'choice_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_question_choice');
        
        $sql = "CREATE INDEX `fk_survey_question_choice_question_id` ON survey_question_choice(`question_id`)";
        $this->db->query($sql);
        
        /**
        * migration for survey_question_factor
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
                'null' => FALSE,
                'default' => '0'
            ),
            'title_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'title_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'abbreviation_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'abbreviation_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_question_factor');
        
        $sql = "CREATE INDEX `fk_survey_question_column_label_question_id` ON survey_question_factor(`question_id`)";
        $this->db->query($sql);
        
        /**
        * migration for survey_question_statement
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'factor_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'title_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'title_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'abbreviation_english' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'abbreviation_arabic' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_question_statement');
        
        /**
        * migration for survey_user_response_choice
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
                'null' => FALSE,
                'default' => '0'
            ),
            'survey_evaluator_id' => array(
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
        
        $this->dbforge->create_table('survey_user_response_choice');
        
        /**
        * migration for survey_user_response_factor
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
                'null' => FALSE,
                'default' => '0'
            ),
            'survey_evaluator_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'statement_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'rank' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_user_response_factor');
        
        /**
        * migration for survey_user_response_text
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
                'null' => FALSE,
                'default' => '0'
            ),
            'survey_evaluator_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'value' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('survey_user_response_text');
        
        /**
        * migration for tasks
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'from' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'to' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'text' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'time' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'done' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            ),
            'title' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('tasks');
        
        /**
        * migration for thread
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'last_message_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('thread');
        
        /**
        * migration for thread_group
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'group_name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'group_name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'group_desc_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'group_desc_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'creator_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('thread_group');
        
        /**
        * migration for thread_group_members
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'group_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('thread_group_members');
        
        /**
        * migration for thread_message
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'thread_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'sender_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'sent_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'body' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('thread_message');
        
        /**
        * migration for thread_message_read_state
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'thread_message_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'read_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('thread_message_read_state');
        
        /**
        * migration for thread_participant
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'thread_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'user_id' => array(
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
            'is_important' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('thread_participant');
        
        /**
        * migration for thread_participant_group
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'thread_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'type_class' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('thread_participant_group');
        
        /**
        * migration for translation
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'string' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'translation' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'language_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('translation');
        
        $sql = "CREATE INDEX `string` ON translation(`string`(255))";
        $this->db->query($sql);
        
        $sql = "CREATE INDEX `language_id` ON translation(`language_id`)";
        $this->db->query($sql);
        
        /**
        * migration for unit
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'parent_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => TRUE
            ),
            'is_academic' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'vision_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'vision_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'mission_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('unit');
        
        /**
        * migration for unit_goal
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'unit_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('unit_goal');
        
        /**
        * migration for unit_log
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
            'unit_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'year' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('unit_log');
        
        /**
        * migration for unit_objective
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'unit_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('unit_objective');
        
        /**
        * migration for user
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'class_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'integration_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => '0'
            ),
            'login_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => ''
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'birth_date' => array(
                'type' => 'DATE',
                'null' => FALSE,
                'default' => '2012-06-01'
            ),
            'last_login' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'is_active' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ),
            'avatar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => ''
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => ''
            ),
            'gender' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'nationality' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'fax_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'office_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
                'default' => ''
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => ''
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE,
                'default' => ''
            ),
            'theme' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
                'default' => 'ksu'
            ),
            'theme_fixed_navbar' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            ),
            'theme_fixed_menu' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            ),
            'theme_flip_menu' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            ),
            'about_me' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('user');
        
        /**
        * migration for user_alumni
        */
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
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
            'graduated' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'job_status' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'professional_category' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'activity' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'employer_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('user_id', TRUE);
        
        $this->dbforge->create_table('user_alumni');
        
        /**
        * migration for user_employer
        */
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'position' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'employed_duration' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'employed_in' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'activity' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '0'
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'department_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('user_id', TRUE);
        
        $this->dbforge->create_table('user_employer');
        
        /**
        * migration for user_faculty
        */
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'role_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '6'
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'department_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'service_time' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '1'
            ),
            'job_position' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'academic_rank' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '1'
            ),
            'general_specialty' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'specific_specialty' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'graduate_from' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'degree' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('user_id', TRUE);
        
        $this->dbforge->create_table('user_faculty');
        
        /**
        * migration for user_staff
        */
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'role_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'default' => '8'
            ),
            'unit_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'department_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'program_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'service_time' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '1'
            ),
            'job_position' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '0'
            ),
            'campus_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('user_id', TRUE);
        
        $this->dbforge->create_table('user_staff');
        
        /**
        * migration for user_student
        */
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
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
            'level_of_study' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => '1'
            ),
            'status_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('user_id', TRUE);
        
        $this->dbforge->create_table('user_student');
    }
    
    public function down() {
        
        /**
        * migration for acc_independent_reviewer
        */
        $this->dbforge->drop_table('acc_independent_reviewer');
        
        /**
        * migration for acc_pre_visit_reviewer
        */
        $this->dbforge->drop_table('acc_pre_visit_reviewer');
        
        /**
        * migration for acc_pre_visit_reviewer_action_plan
        */
        $this->dbforge->drop_table('acc_pre_visit_reviewer_action_plan');
        
        /**
        * migration for acc_pre_visit_reviewer_recommendation
        */
        $this->dbforge->drop_table('acc_pre_visit_reviewer_recommendation');
        
        /**
        * migration for acc_status
        */
        $this->dbforge->drop_table('acc_status');
        
        /**
        * migration for acc_visit_reviewer
        */
        $this->dbforge->drop_table('acc_visit_reviewer');
        
        /**
        * migration for acc_visit_reviewer_action_plan
        */
        $this->dbforge->drop_table('acc_visit_reviewer_action_plan');
        
        /**
        * migration for acc_visit_reviewer_recommendation
        */
        $this->dbforge->drop_table('acc_visit_reviewer_recommendation');
        
        /**
        * migration for al_action
        */
        $this->dbforge->drop_table('al_action');
        
        /**
        * migration for al_analysis
        */
        $this->dbforge->drop_table('al_analysis');
        
        /**
        * migration for al_assessment_loop
        */
        $this->dbforge->drop_table('al_assessment_loop');
        
        /**
        * migration for al_custom
        */
        $this->dbforge->drop_table('al_custom');
        
        /**
        * migration for al_measure
        */
        $this->dbforge->drop_table('al_measure');
        
        /**
        * migration for al_recommendation
        */
        $this->dbforge->drop_table('al_recommendation');
        
        /**
        * migration for al_result
        */
        $this->dbforge->drop_table('al_result');
        
        /**
        * migration for ams_log
        */
        $this->dbforge->drop_table('ams_log');
        
        /**
        * migration for as_agency
        */
        $this->dbforge->drop_table('as_agency');
        
        /**
        * migration for as_agency_mapping
        */
        $this->dbforge->drop_table('as_agency_mapping');
        
        /**
        * migration for as_status
        */
        $this->dbforge->drop_table('as_status');
        
        /**
        * migration for backup
        */
        $this->dbforge->drop_table('backup');
        
        /**
        * migration for campus
        */
        $this->dbforge->drop_table('campus');
        
        /**
        * migration for campus_college
        */
        $this->dbforge->drop_table('campus_college');
        
        /**
        * migration for ci_sessions
        */
        $this->dbforge->drop_table('ci_sessions');
        
        /**
        * migration for cm_active_data
        */
        $this->dbforge->drop_table('cm_active_data');
        
        /**
        * migration for cm_assessment_component
        */
        $this->dbforge->drop_table('cm_assessment_component');
        
        /**
        * migration for cm_assessment_method
        */
        $this->dbforge->drop_table('cm_assessment_method');
        
        /**
        * migration for cm_course_assessment_method
        */
        $this->dbforge->drop_table('cm_course_assessment_method');
        
        /**
        * migration for cm_course_assessment_method_log
        */
        $this->dbforge->drop_table('cm_course_assessment_method_log');
        
        /**
        * migration for cm_course_learning_outcome
        */
        $this->dbforge->drop_table('cm_course_learning_outcome');
        
        /**
        * migration for cm_course_learning_outcome_log
        */
        $this->dbforge->drop_table('cm_course_learning_outcome_log');
        
        /**
        * migration for cm_course_learning_outcome_survey
        */
        $this->dbforge->drop_table('cm_course_learning_outcome_survey');
        
        /**
        * migration for cm_course_learning_outcome_target
        */
        $this->dbforge->drop_table('cm_course_learning_outcome_target');
        
        /**
        * migration for cm_course_learning_outcome_target_log
        */
        $this->dbforge->drop_table('cm_course_learning_outcome_target_log');
        
        /**
        * migration for cm_course_mapping_matrix
        */
        $this->dbforge->drop_table('cm_course_mapping_matrix');
        
        /**
        * migration for cm_course_mapping_matrix_log
        */
        $this->dbforge->drop_table('cm_course_mapping_matrix_log');
        
        /**
        * migration for cm_course_offered_program
        */
        $this->dbforge->drop_table('cm_course_offered_program');
        
        /**
        * migration for cm_learning_domain
        */
        $this->dbforge->drop_table('cm_learning_domain');
        
        /**
        * migration for cm_learning_outcome
        */
        $this->dbforge->drop_table('cm_learning_outcome');
        
        /**
        * migration for cm_program_assessment_component
        */
        $this->dbforge->drop_table('cm_program_assessment_component');
        
        /**
        * migration for cm_program_assessment_component_log
        */
        $this->dbforge->drop_table('cm_program_assessment_component_log');
        
        /**
        * migration for cm_program_assessment_method
        */
        $this->dbforge->drop_table('cm_program_assessment_method');
        
        /**
        * migration for cm_program_assessment_method_log
        */
        $this->dbforge->drop_table('cm_program_assessment_method_log');
        
        /**
        * migration for cm_program_learning_outcome
        */
        $this->dbforge->drop_table('cm_program_learning_outcome');
        
        /**
        * migration for cm_program_learning_outcome_log
        */
        $this->dbforge->drop_table('cm_program_learning_outcome_log');
        
        /**
        * migration for cm_program_learning_outcome_survey
        */
        $this->dbforge->drop_table('cm_program_learning_outcome_survey');
        
        /**
        * migration for cm_program_learning_outcome_target
        */
        $this->dbforge->drop_table('cm_program_learning_outcome_target');
        
        /**
        * migration for cm_program_learning_outcome_target_log
        */
        $this->dbforge->drop_table('cm_program_learning_outcome_target_log');
        
        /**
        * migration for cm_program_mapping_matrix
        */
        $this->dbforge->drop_table('cm_program_mapping_matrix');
        
        /**
        * migration for cm_program_mapping_matrix_log
        */
        $this->dbforge->drop_table('cm_program_mapping_matrix_log');
        
        /**
        * migration for cm_section_mapping_question
        */
        $this->dbforge->drop_table('cm_section_mapping_question');
        
        /**
        * migration for cm_section_student_assessment
        */
        $this->dbforge->drop_table('cm_section_student_assessment');
        
        /**
        * migration for college
        */
        $this->dbforge->drop_table('college');
        
        /**
        * migration for college_goal
        */
        $this->dbforge->drop_table('college_goal');
        
        /**
        * migration for college_objective
        */
        $this->dbforge->drop_table('college_objective');
        
        /**
        * migration for course
        */
        $this->dbforge->drop_table('course');
        
        /**
        * migration for course_section
        */
        $this->dbforge->drop_table('course_section');
        
        /**
        * migration for course_section_student
        */
        $this->dbforge->drop_table('course_section_student');
        
        /**
        * migration for course_section_teacher
        */
        $this->dbforge->drop_table('course_section_teacher');
        
        /**
        * migration for criteria
        */
        $this->dbforge->drop_table('criteria');
        
        /**
        * migration for cron_job
        */
        $this->dbforge->drop_table('cron_job');
        
        /**
        * migration for data_academic_units
        */
        $this->dbforge->drop_table('data_academic_units');
        
        /**
        * migration for data_cohort
        */
        $this->dbforge->drop_table('data_cohort');
        
        /**
        * migration for data_cohort_status
        */
        $this->dbforge->drop_table('data_cohort_status');
        
        /**
        * migration for data_cohort_table
        */
        $this->dbforge->drop_table('data_cohort_table');
        
        /**
        * migration for data_college
        */
        $this->dbforge->drop_table('data_college');
        
        /**
        * migration for data_competion_rate
        */
        $this->dbforge->drop_table('data_competion_rate');
        
        /**
        * migration for data_course_grade
        */
        $this->dbforge->drop_table('data_course_grade');
        
        /**
        * migration for data_course_pre
        */
        $this->dbforge->drop_table('data_course_pre');
        
        /**
        * migration for data_course_status
        */
        $this->dbforge->drop_table('data_course_status');
        
        /**
        * migration for data_course_statuses
        */
        $this->dbforge->drop_table('data_course_statuses');
        
        /**
        * migration for data_course_students
        */
        $this->dbforge->drop_table('data_course_students');
        
        /**
        * migration for data_faculty
        */
        $this->dbforge->drop_table('data_faculty');
        
        /**
        * migration for data_graduate
        */
        $this->dbforge->drop_table('data_graduate');
        
        /**
        * migration for data_institution
        */
        $this->dbforge->drop_table('data_institution');
        
        /**
        * migration for data_level_enrolled
        */
        $this->dbforge->drop_table('data_level_enrolled');
        
        /**
        * migration for data_periodic_program
        */
        $this->dbforge->drop_table('data_periodic_program');
        
        /**
        * migration for data_periodic_program_ext
        */
        $this->dbforge->drop_table('data_periodic_program_ext');
        
        /**
        * migration for data_preparatory_year
        */
        $this->dbforge->drop_table('data_preparatory_year');
        
        /**
        * migration for data_preparatory_year_faculty
        */
        $this->dbforge->drop_table('data_preparatory_year_faculty');
        
        /**
        * migration for data_research_budget
        */
        $this->dbforge->drop_table('data_research_budget');
        
        /**
        * migration for data_workload
        */
        $this->dbforge->drop_table('data_workload');
        
        /**
        * migration for degree
        */
        $this->dbforge->drop_table('degree');
        
        /**
        * migration for department
        */
        $this->dbforge->drop_table('department');
        
        /**
        * migration for fp_academic_article
        */
        $this->dbforge->drop_table('fp_academic_article');
        
        /**
        * migration for fp_academic_qualification
        */
        $this->dbforge->drop_table('fp_academic_qualification');
        
        /**
        * migration for fp_academic_rank
        */
        $this->dbforge->drop_table('fp_academic_rank');
        
        /**
        * migration for fp_administrative_work
        */
        $this->dbforge->drop_table('fp_administrative_work');
        
        /**
        * migration for fp_advising
        */
        $this->dbforge->drop_table('fp_advising');
        
        /**
        * migration for fp_award
        */
        $this->dbforge->drop_table('fp_award');
        
        /**
        * migration for fp_book
        */
        $this->dbforge->drop_table('fp_book');
        
        /**
        * migration for fp_committee
        */
        $this->dbforge->drop_table('fp_committee');
        
        /**
        * migration for fp_conference
        */
        $this->dbforge->drop_table('fp_conference');
        
        /**
        * migration for fp_creative_work
        */
        $this->dbforge->drop_table('fp_creative_work');
        
        /**
        * migration for fp_dissertation
        */
        $this->dbforge->drop_table('fp_dissertation');
        
        /**
        * migration for fp_evaluation
        */
        $this->dbforge->drop_table('fp_evaluation');
        
        /**
        * migration for fp_experience
        */
        $this->dbforge->drop_table('fp_experience');
        
        /**
        * migration for fp_forms
        */
        $this->dbforge->drop_table('fp_forms');
        
        /**
        * migration for fp_forms_deadline
        */
        $this->dbforge->drop_table('fp_forms_deadline');
        
        /**
        * migration for fp_forms_evaluations
        */
        $this->dbforge->drop_table('fp_forms_evaluations');
        
        /**
        * migration for fp_forms_inputs
        */
        $this->dbforge->drop_table('fp_forms_inputs');
        
        /**
        * migration for fp_forms_rate
        */
        $this->dbforge->drop_table('fp_forms_rate');
        
        /**
        * migration for fp_forms_recommendation
        */
        $this->dbforge->drop_table('fp_forms_recommendation');
        
        /**
        * migration for fp_forms_result
        */
        $this->dbforge->drop_table('fp_forms_result');
        
        /**
        * migration for fp_forms_type
        */
        $this->dbforge->drop_table('fp_forms_type');
        
        /**
        * migration for fp_general_information
        */
        $this->dbforge->drop_table('fp_general_information');
        
        /**
        * migration for fp_language
        */
        $this->dbforge->drop_table('fp_language');
        
        /**
        * migration for fp_project
        */
        $this->dbforge->drop_table('fp_project');
        
        /**
        * migration for fp_research
        */
        $this->dbforge->drop_table('fp_research');
        
        /**
        * migration for fp_skill
        */
        $this->dbforge->drop_table('fp_skill');
        
        /**
        * migration for fp_supervision
        */
        $this->dbforge->drop_table('fp_supervision');
        
        /**
        * migration for fp_training
        */
        $this->dbforge->drop_table('fp_training');
        
        /**
        * migration for institution
        */
        $this->dbforge->drop_table('institution');
        
        /**
        * migration for institution_goal
        */
        $this->dbforge->drop_table('institution_goal');
        
        /**
        * migration for institution_objective
        */
        $this->dbforge->drop_table('institution_objective');
        
        /**
        * migration for item
        */
        $this->dbforge->drop_table('item');
        
        /**
        * migration for kpi
        */
        $this->dbforge->drop_table('kpi');
        
        /**
        * migration for kpi_college_value
        */
        $this->dbforge->drop_table('kpi_college_value');
        
        /**
        * migration for kpi_detail
        */
        $this->dbforge->drop_table('kpi_detail');
        
        /**
        * migration for kpi_escalation_legend_value
        */
        $this->dbforge->drop_table('kpi_escalation_legend_value');
        
        /**
        * migration for kpi_escalation_level
        */
        $this->dbforge->drop_table('kpi_escalation_level');
        
        /**
        * migration for kpi_escalation_plan
        */
        $this->dbforge->drop_table('kpi_escalation_plan');
        
        /**
        * migration for kpi_escalation_polarity
        */
        $this->dbforge->drop_table('kpi_escalation_polarity');
        
        /**
        * migration for kpi_escalation_user
        */
        $this->dbforge->drop_table('kpi_escalation_user');
        
        /**
        * migration for kpi_institution_value
        */
        $this->dbforge->drop_table('kpi_institution_value');
        
        /**
        * migration for kpi_legend
        */
        $this->dbforge->drop_table('kpi_legend');
        
        /**
        * migration for kpi_level
        */
        $this->dbforge->drop_table('kpi_level');
        
        /**
        * migration for kpi_level_description
        */
        $this->dbforge->drop_table('kpi_level_description');
        
        /**
        * migration for kpi_level_settings
        */
        $this->dbforge->drop_table('kpi_level_settings');
        
        /**
        * migration for kpi_program_value
        */
        $this->dbforge->drop_table('kpi_program_value');
        
        /**
        * migration for kpi_survey
        */
        $this->dbforge->drop_table('kpi_survey');
        
        /**
        * migration for major
        */
        $this->dbforge->drop_table('major');
        
        /**
        * migration for manual
        */
        $this->dbforge->drop_table('manual');
        
        /**
        * migration for node
        */
        $this->dbforge->drop_table('node');
        
        /**
        * migration for node_assessor
        */
        $this->dbforge->drop_table('node_assessor');
        
        /**
        * migration for node_builder
        */
        $this->dbforge->drop_table('node_builder');
        
        /**
        * migration for node_log
        */
        $this->dbforge->drop_table('node_log');
        
        /**
        * migration for node_review
        */
        $this->dbforge->drop_table('node_review');
        
        /**
        * migration for node_reviewer
        */
        $this->dbforge->drop_table('node_reviewer');
        
        /**
        * migration for notification
        */
        $this->dbforge->drop_table('notification');
        
        /**
        * migration for notification_settings
        */
        $this->dbforge->drop_table('notification_settings');
        
        /**
        * migration for notification_template
        */
        $this->dbforge->drop_table('notification_template');
        
        /**
        * migration for pc_assignment
        */
        $this->dbforge->drop_table('pc_assignment');
        
        /**
        * migration for pc_catalog_information
        */
        $this->dbforge->drop_table('pc_catalog_information');
        
        /**
        * migration for pc_category
        */
        $this->dbforge->drop_table('pc_category');
        
        /**
        * migration for pc_course_policies
        */
        $this->dbforge->drop_table('pc_course_policies');
        
        /**
        * migration for pc_format
        */
        $this->dbforge->drop_table('pc_format');
        
        /**
        * migration for pc_instructor_information
        */
        $this->dbforge->drop_table('pc_instructor_information');
        
        /**
        * migration for pc_material
        */
        $this->dbforge->drop_table('pc_material');
        
        /**
        * migration for pc_report
        */
        $this->dbforge->drop_table('pc_report');
        
        /**
        * migration for pc_report_components
        */
        $this->dbforge->drop_table('pc_report_components');
        
        /**
        * migration for pc_settings
        */
        $this->dbforge->drop_table('pc_settings');
        
        /**
        * migration for pc_student_work
        */
        $this->dbforge->drop_table('pc_student_work');
        
        /**
        * migration for pc_support_material
        */
        $this->dbforge->drop_table('pc_support_material');
        
        /**
        * migration for pc_support_service
        */
        $this->dbforge->drop_table('pc_support_service');
        
        /**
        * migration for pc_syllabus_fields
        */
        $this->dbforge->drop_table('pc_syllabus_fields');
        
        /**
        * migration for pc_syllabus_fields_value
        */
        $this->dbforge->drop_table('pc_syllabus_fields_value');
        
        /**
        * migration for pc_teaching_material
        */
        $this->dbforge->drop_table('pc_teaching_material');
        
        /**
        * migration for pc_topic
        */
        $this->dbforge->drop_table('pc_topic');
        
        /**
        * migration for program
        */
        $this->dbforge->drop_table('program');
        
        /**
        * migration for program_goal
        */
        $this->dbforge->drop_table('program_goal');
        
        /**
        * migration for program_objective
        */
        $this->dbforge->drop_table('program_objective');
        
        /**
        * migration for program_plan
        */
        $this->dbforge->drop_table('program_plan');
        
        /**
        * migration for pt_college_program_relation
        */
        $this->dbforge->drop_table('pt_college_program_relation');
        
        /**
        * migration for pt_goal_program
        */
        $this->dbforge->drop_table('pt_goal_program');
        
        /**
        * migration for pt_keyword
        */
        $this->dbforge->drop_table('pt_keyword');
        
        /**
        * migration for pt_keyword_college
        */
        $this->dbforge->drop_table('pt_keyword_college');
        
        /**
        * migration for pt_keyword_program
        */
        $this->dbforge->drop_table('pt_keyword_program');
        
        /**
        * migration for pt_keyword_uni
        */
        $this->dbforge->drop_table('pt_keyword_uni');
        
        /**
        * migration for pt_kpi_major_relation
        */
        $this->dbforge->drop_table('pt_kpi_major_relation');
        
        /**
        * migration for pt_obj_plo_relation
        */
        $this->dbforge->drop_table('pt_obj_plo_relation');
        
        /**
        * migration for pt_obj_program_relation
        */
        $this->dbforge->drop_table('pt_obj_program_relation');
        
        /**
        * migration for pt_uni_college_relation
        */
        $this->dbforge->drop_table('pt_uni_college_relation');
        
        /**
        * migration for role
        */
        $this->dbforge->drop_table('role');
        
        /**
        * migration for semester
        */
        $this->dbforge->drop_table('semester');
        
        /**
        * migration for sp_action_plan
        */
        $this->dbforge->drop_table('sp_action_plan');
        
        /**
        * migration for sp_action_plan_history
        */
        $this->dbforge->drop_table('sp_action_plan_history');
        
        /**
        * migration for sp_action_plan_recommend
        */
        $this->dbforge->drop_table('sp_action_plan_recommend');
        
        /**
        * migration for sp_activity
        */
        $this->dbforge->drop_table('sp_activity');
        
        /**
        * migration for sp_activity_history
        */
        $this->dbforge->drop_table('sp_activity_history');
        
        /**
        * migration for sp_activity_milestone
        */
        $this->dbforge->drop_table('sp_activity_milestone');
        
        /**
        * migration for sp_bi_monthly_report
        */
        $this->dbforge->drop_table('sp_bi_monthly_report');
        
        /**
        * migration for sp_bi_monthly_summary
        */
        $this->dbforge->drop_table('sp_bi_monthly_summary');
        
        /**
        * migration for sp_goal
        */
        $this->dbforge->drop_table('sp_goal');
        
        /**
        * migration for sp_goal_goal
        */
        $this->dbforge->drop_table('sp_goal_goal');
        
        /**
        * migration for sp_goal_history
        */
        $this->dbforge->drop_table('sp_goal_history');
        
        /**
        * migration for sp_initiative
        */
        $this->dbforge->drop_table('sp_initiative');
        
        /**
        * migration for sp_initiative_history
        */
        $this->dbforge->drop_table('sp_initiative_history');
        
        /**
        * migration for sp_initiative_milestone
        */
        $this->dbforge->drop_table('sp_initiative_milestone');
        
        /**
        * migration for sp_kpi
        */
        $this->dbforge->drop_table('sp_kpi');
        
        /**
        * migration for sp_kpi_history
        */
        $this->dbforge->drop_table('sp_kpi_history');
        
        /**
        * migration for sp_objective
        */
        $this->dbforge->drop_table('sp_objective');
        
        /**
        * migration for sp_objective_history
        */
        $this->dbforge->drop_table('sp_objective_history');
        
        /**
        * migration for sp_objective_milestone
        */
        $this->dbforge->drop_table('sp_objective_milestone');
        
        /**
        * migration for sp_objective_objective
        */
        $this->dbforge->drop_table('sp_objective_objective');
        
        /**
        * migration for sp_objective_perspective
        */
        $this->dbforge->drop_table('sp_objective_perspective');
        
        /**
        * migration for sp_overall_action_plan
        */
        $this->dbforge->drop_table('sp_overall_action_plan');
        
        /**
        * migration for sp_project
        */
        $this->dbforge->drop_table('sp_project');
        
        /**
        * migration for sp_project_history
        */
        $this->dbforge->drop_table('sp_project_history');
        
        /**
        * migration for sp_reason_action_plan
        */
        $this->dbforge->drop_table('sp_reason_action_plan');
        
        /**
        * migration for sp_recommendation
        */
        $this->dbforge->drop_table('sp_recommendation');
        
        /**
        * migration for sp_recommendation_type
        */
        $this->dbforge->drop_table('sp_recommendation_type');
        
        /**
        * migration for sp_risk_tab
        */
        $this->dbforge->drop_table('sp_risk_tab');
        
        /**
        * migration for sp_strategy
        */
        $this->dbforge->drop_table('sp_strategy');
        
        /**
        * migration for sp_strategy_history
        */
        $this->dbforge->drop_table('sp_strategy_history');
        
        /**
        * migration for sp_values
        */
        $this->dbforge->drop_table('sp_values');
        
        /**
        * migration for standard
        */
        $this->dbforge->drop_table('standard');
        
        /**
        * migration for stp_academic
        */
        $this->dbforge->drop_table('stp_academic');
        
        /**
        * migration for stp_activities
        */
        $this->dbforge->drop_table('stp_activities');
        
        /**
        * migration for stp_awards_and_publications
        */
        $this->dbforge->drop_table('stp_awards_and_publications');
        
        /**
        * migration for stp_community_services
        */
        $this->dbforge->drop_table('stp_community_services');
        
        /**
        * migration for stp_complaints
        */
        $this->dbforge->drop_table('stp_complaints');
        
        /**
        * migration for stp_personal
        */
        $this->dbforge->drop_table('stp_personal');
        
        /**
        * migration for stp_recommendations
        */
        $this->dbforge->drop_table('stp_recommendations');
        
        /**
        * migration for stp_social
        */
        $this->dbforge->drop_table('stp_social');
        
        /**
        * migration for student_status
        */
        $this->dbforge->drop_table('student_status');
        
        /**
        * migration for student_status_log
        */
        $this->dbforge->drop_table('student_status_log');
        
        /**
        * migration for survey
        */
        $this->dbforge->drop_table('survey');
        
        /**
        * migration for survey_evaluation
        */
        $this->dbforge->drop_table('survey_evaluation');
        
        /**
        * migration for survey_evaluator
        */
        $this->dbforge->drop_table('survey_evaluator');
        
        /**
        * migration for survey_page
        */
        $this->dbforge->drop_table('survey_page');
        
        /**
        * migration for survey_question
        */
        $this->dbforge->drop_table('survey_question');
        
        /**
        * migration for survey_question_choice
        */
        $this->dbforge->drop_table('survey_question_choice');
        
        /**
        * migration for survey_question_factor
        */
        $this->dbforge->drop_table('survey_question_factor');
        
        /**
        * migration for survey_question_statement
        */
        $this->dbforge->drop_table('survey_question_statement');
        
        /**
        * migration for survey_user_response_choice
        */
        $this->dbforge->drop_table('survey_user_response_choice');
        
        /**
        * migration for survey_user_response_factor
        */
        $this->dbforge->drop_table('survey_user_response_factor');
        
        /**
        * migration for survey_user_response_text
        */
        $this->dbforge->drop_table('survey_user_response_text');
        
        /**
        * migration for tasks
        */
        $this->dbforge->drop_table('tasks');
        
        /**
        * migration for thread
        */
        $this->dbforge->drop_table('thread');
        
        /**
        * migration for thread_group
        */
        $this->dbforge->drop_table('thread_group');
        
        /**
        * migration for thread_group_members
        */
        $this->dbforge->drop_table('thread_group_members');
        
        /**
        * migration for thread_message
        */
        $this->dbforge->drop_table('thread_message');
        
        /**
        * migration for thread_message_read_state
        */
        $this->dbforge->drop_table('thread_message_read_state');
        
        /**
        * migration for thread_participant
        */
        $this->dbforge->drop_table('thread_participant');
        
        /**
        * migration for thread_participant_group
        */
        $this->dbforge->drop_table('thread_participant_group');
        
        /**
        * migration for translation
        */
        $this->dbforge->drop_table('translation');
        
        /**
        * migration for unit
        */
        $this->dbforge->drop_table('unit');
        
        /**
        * migration for unit_goal
        */
        $this->dbforge->drop_table('unit_goal');
        
        /**
        * migration for unit_log
        */
        $this->dbforge->drop_table('unit_log');
        
        /**
        * migration for unit_objective
        */
        $this->dbforge->drop_table('unit_objective');
        
        /**
        * migration for user
        */
        $this->dbforge->drop_table('user');
        
        /**
        * migration for user_alumni
        */
        $this->dbforge->drop_table('user_alumni');
        
        /**
        * migration for user_employer
        */
        $this->dbforge->drop_table('user_employer');
        
        /**
        * migration for user_faculty
        */
        $this->dbforge->drop_table('user_faculty');
        
        /**
        * migration for user_staff
        */
        $this->dbforge->drop_table('user_staff');
        
        /**
        * migration for user_student
        */
        $this->dbforge->drop_table('user_student');
    }
    
}
