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
class Migration_Modify_Kpi_Level_Description extends CI_Migration {

    public function up() {

        $this->dbforge->add_column(
            'kpi_level_description',
            [
                'title'=> [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE
                ]
            ],
            'description'
        );
    }

    public function down() {
        $this->dbforge->drop_column('kpi_level_description','title');
    }
}