<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Risk_management extends CI_Migration {
    
    public function up() {

        /**
        * migration for rim_risk_management
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'level_type' => array(
                'type' => 'TINYTEXT',
                'null' => FALSE
            ),
            'level_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'TINYTEXT',
                'null' => FALSE
            ),
            'type_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'likely' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'severity' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id');
        
        $this->dbforge->create_table('rim_risk_management');
        
        /**
        * migration for rim_risk_treatment
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'responsible_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'Risk_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'desc_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'desc_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
             'risk_desc_ar' => array(
            'type' => 'TEXT',
            'null' => TRUE
            ),
             'risk_desc_en' => array(
            'type' => 'TEXT',
            'null' => TRUE
            ),
            'impact_ar' => array(
            'type' => 'TEXT',
            'null' => TRUE
            ),
           'impact_en' => array(
            'type' => 'TEXT',
            'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id');
        
        $this->dbforge->create_table('rim_risk_treatment');

    }
    
    public function down() {

        /**
        * migration for rim_risk_management
        */
        $this->dbforge->drop_table('rim_risk_management');
        
        /**
        * migration for rim_risk_treatment
        */
        $this->dbforge->drop_table('rim_risk_treatment');
       }
    
}
