<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Course_Section
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Survey_Evaluation extends CI_Migration {

    public function up() {

        /**
         * migration for survey_evaluation
         */
        $this->dbforge->add_column(
            'survey_evaluation',
            [
                'start'=> [
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => TRUE
                ]
            ]
        );
        $this->dbforge->add_column(
            'survey_evaluation',
            [
                'end'=> [
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => TRUE
                ]
            ]
        );
    }

    public function down() {

        /**
         * migration for survey_evaluation
         */
        $this->dbforge->drop_column('survey_evaluation','start');
        $this->dbforge->drop_column('survey_evaluation','end');
    }

}
