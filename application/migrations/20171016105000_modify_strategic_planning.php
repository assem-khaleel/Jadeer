 <?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 9/6/17
 * Time: 10:07 AM
 */

/**
 * Class Migration_Modify_Kpi_Level_Description
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Modify_Strategic_Planning extends CI_Migration {

    public function up() {

        $this->dbforge->add_column(
            'sp_strategy',
            [
                'start_year'=> [
                    'type' => 'int',
                    'constraint' => '11',
                    'null' => FALSE
                ]
            ],
            'item_id'
        );

        $this->dbforge->modify_column(
            'sp_objective_perspective',
            [

                'perspective'=> [
                    'name' => 'perspective',
                    'type' => "int",
                 ]
            ]
        );

        /**
         * migration for sp_perspective
         */
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
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
            )
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('sp_perspective');

    }

    public function down() {
        $this->dbforge->drop_column('sp_strategy','start_year');

        $this->dbforge->modify_column(
            'sp_objective_perspective',
            [
                'perspective'=> [
                    'type' => "enum('none', 'customer', 'learning_and_growth', 'internal_processes', 'finance')",
                    'null' => FALSE
                ]
            ]
        );

        $this->dbforge->drop_table('sp_perspective');
    }
}