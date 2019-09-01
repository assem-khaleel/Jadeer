<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Phase_Two
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Phase_Two extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for rm_equipment
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name_ar' => array(
                'type' => 'MEDIUMTEXT',
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'MEDIUMTEXT',
                'null' => FALSE
            ),
            'additional' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id');
        
        $this->dbforge->create_table('rm_equipment');
        
        /**
        * migration for rm_room_equipment
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'room_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'equipment_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id');
        
        $this->dbforge->create_table('rm_room_equipment');
        
        /**
        * migration for rm_room_management
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name_ar' => array(
                'type' => 'MEDIUMTEXT',
                'null' => FALSE
            ),
            'name_en' => array(
                'type' => 'MEDIUMTEXT',
                'null' => FALSE
            ),
            'room_number' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'campus_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'college_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ) ,
            'room_type' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id');
        
        $this->dbforge->create_table('rm_room_management');

        /**
         * migration for mm_action
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'meeting_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'owner_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'action' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'due' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('mm_action');

        /**
         * migration for mm_agenda
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'meeting_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'topic' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('mm_agenda');

        /**
         * migration for mm_attendance
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'meeting_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'attended' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'external_user_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('mm_attendance');

        /**
         * migration for mm_meeting
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => TRUE
            ),
            'level_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'room_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'type_class' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'facilitator_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'name' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'start_date' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'end_date' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'objective' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'agenda_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            ),
            'meeting_minutes' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'meeting_minutes_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            ),
            'action_attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE
            ),
            'meeting_ref_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('mm_meeting');


        /**
         * migration for c_committee
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
                'constraint' => '250',
                'null' => FALSE
            ),
            'title_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
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
            'start_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'is_deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id');

        $this->dbforge->create_table('c_committee');

        /**
         * migration for c_committee_member
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
            'committee_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'is_leader' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id');

        $this->dbforge->create_table('c_committee_member');

        /**
         * migration for policies_procedures
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
                'null' => FALSE,
                'default' => '0'
            ),
            'unit_type' => array(
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
            'desc_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'desc_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'statement_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'statement_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'definitions_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'definitions_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'audience_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'audience_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'reason_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'reason_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'compliance_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'compliance_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'regulations_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'regulations_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'contact_def_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'contact_def_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'history_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'history_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'procedures_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'procedures_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'standard_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'standard_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'creator_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('policies_procedures');

        /**
         * migration for policies_procedures_contacts
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'policies_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'contact_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'mail' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('policies_procedures_contacts');

        /**
         * migration for policies_procedures_files
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'policy_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'form_name_en' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'form_name_ar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'file_path' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('policies_procedures_files');

        /**
         * migration for policies_procedures_managers
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'policy_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'manager_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('policies_procedures_managers');

        /**
         * migration for policies_procedures_responsible
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'policies_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => FALSE
            ),
            'responsibilities' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('policies_procedures_responsible');
    }
    
    public function down() {
        
        /**
        * migration for rm_equipment
        */
        $this->dbforge->drop_table('rm_equipment');
        
        /**
        * migration for rm_room_equipment
        */
        $this->dbforge->drop_table('rm_room_equipment');
        
        /**
        * migration for rm_room_management
        */
        $this->dbforge->drop_table('rm_room_management');

        /**
         * migration for mm_action
         */
        $this->dbforge->drop_table('mm_action');

        /**
         * migration for mm_agenda
         */
        $this->dbforge->drop_table('mm_agenda');

        /**
         * migration for mm_attendance
         */
        $this->dbforge->drop_table('mm_attendance');

        /**
         * migration for mm_meeting
         */
        $this->dbforge->drop_table('mm_meeting');

        /**
         * migration for c_committee
         */
        $this->dbforge->drop_table('c_committee');

        /**
         * migration for c_committee_member
         */
        $this->dbforge->drop_table('c_committee_member');

        /**
         * migration for policies_procedures
         */
        $this->dbforge->drop_table('policies_procedures');

        /**
         * migration for policies_procedures_contacts
         */
        $this->dbforge->drop_table('policies_procedures_contacts');

        /**
         * migration for policies_procedures_files
         */
        $this->dbforge->drop_table('policies_procedures_files');

        /**
         * migration for policies_procedures_managers
         */
        $this->dbforge->drop_table('policies_procedures_managers');

        /**
         * migration for policies_procedures_responsible
         */
        $this->dbforge->drop_table('policies_procedures_responsible');
    }
    
}
