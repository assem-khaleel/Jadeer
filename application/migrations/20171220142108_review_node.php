<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Review_Node extends CI_Migration {
    
    public function up()
    {

        /**
         * migration for node_review_comments
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'review_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => FALSE
            ),
            'comment' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('node_review_comments');
    }
    
    public function down() {

        /**
         * migration for node_review_comments
         */
        $this->dbforge->drop_table('node_review_comments');
    }
    
}
