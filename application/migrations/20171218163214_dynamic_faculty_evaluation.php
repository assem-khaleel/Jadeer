<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Dynamic_Faculty_Evaluation extends CI_Migration {
    
    public function up() {
        
        /**
        * migration for fp_eva_tab_col
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'eva_tab_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_eva_tab_col');
        
        /**
        * migration for fp_eva_tab_row
        */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TINYTEXT',
                'null' => TRUE
            ),
            'eva_tab_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_eva_tab_row');
        
        /**
        * migration for fp_eva_tabs
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
            'points' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'is_delete' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            )
        ));
        
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('fp_eva_tabs');
        
        /**
        * migration for fp_evaluation
        */
        $this->dbforge->add_column('fp_evaluation', array(
            'eva_tab_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'eva_tab_row_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            ),
            'eva_tab_col_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => TRUE
            )
        ));
        
//        $this->dbforge->add_key('eva_tab_id');
//        $this->dbforge->add_key('academic_year');
//        $this->dbforge->add_key('user_id');

//        $this->dbforge->create_table('fp_evaluation');

        /**
         * migration for fp_legend
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'title_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'is_delete' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '0'
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('fp_legend');

        $this->db->query("INSERT INTO fp_legend (title_en, title_ar, is_delete) VALUES ('Band Performance Legend', 'رموز نظاق الأداء', 0);");



        /**
         * migration for fp_legend_desc
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
                'null' => TRUE
            ),
            'legend_en' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'legend_ar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'min' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'max' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
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

        $this->dbforge->create_table('fp_legend_desc');

        $this->db->query("INSERT INTO fp_legend_desc (legend_id, legend_en, legend_ar, min, max, desc_en, desc_ar) VALUES (1, 'B1', 'B1', 0, 10, 'Poor Performance', 'أداء سيئ');");
        $this->db->query("INSERT INTO fp_legend_desc (legend_id, legend_en, legend_ar, min, max, desc_en, desc_ar) VALUES (1, 'B2', 'B2', 11, 30, 'Low Performance', 'اداء متدني');");
        $this->db->query("INSERT INTO fp_legend_desc (legend_id, legend_en, legend_ar, min, max, desc_en, desc_ar) VALUES (1, 'B3', 'B3', 31, 50, 'Below Average', 'اقل من المستوى');");
        $this->db->query("INSERT INTO fp_legend_desc (legend_id, legend_en, legend_ar, min, max, desc_en, desc_ar) VALUES (1, 'B4', 'B4', 51, 65, 'Average Performance', 'أداء متوسط');");
        $this->db->query("INSERT INTO fp_legend_desc (legend_id, legend_en, legend_ar, min, max, desc_en, desc_ar) VALUES (1, 'B5', 'B5', 66, 85, 'Good Performance', 'أداء جيد');");
        $this->db->query("INSERT INTO fp_legend_desc (legend_id, legend_en, legend_ar, min, max, desc_en, desc_ar) VALUES (1, 'B6', 'B6', 86, 100, 'Excellent Performance', 'اداء ممتاز');");
    }
    
    public function down() {
        
        /**
        * migration for fp_eva_tab_col
        */
        $this->dbforge->drop_table('fp_eva_tab_col');
        
        /**
        * migration for fp_eva_tab_row
        */
        $this->dbforge->drop_table('fp_eva_tab_row');
        
        /**
        * migration for fp_eva_tabs
        */
        $this->dbforge->drop_table('fp_eva_tabs');
        
        /**
        * migration for fp_evaluation
        */
        $this->dbforge->drop_table('fp_evaluation');

        /**
         * migration for fp_legend
         */
        $this->dbforge->drop_table('fp_legend');

        /**
         * migration for fp_legend_desc
         */
        $this->dbforge->drop_table('fp_legend_desc');
    }
    
}
