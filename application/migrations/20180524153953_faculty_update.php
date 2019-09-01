<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Faculty_update
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Faculty_update extends CI_Migration
{

    public function up()
    {

        $this->dbforge->modify_column(
            'user_faculty',
            [
                'program_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                )
            ]
        );


    }

    public function down()
    {

        $this->dbforge->modify_column(
            'user_faculty',
            [
                'program_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
            ]
        );
    }

}
