<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Data_Training_Material
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Data_Training_Material extends CI_Migration {

    public function up() {

        $types = [
            ['name_en' => 'Training Courses','name_ar'=>'دورات تدريبية','is_editable'=> 1],
            ['name_en' => 'Conferences','name_ar'=>'مؤتمرات','is_editable'=>1],
            ['name_en' => 'Events','name_ar'=>'أحداث','is_editable'=>1],
            ['name_en' => 'Workshops','name_ar'=>'ورشات عمل','is_editable'=>1],
            ['name_en' => 'Scientific Visits','name_ar'=>'زيارات علمية','is_editable'=>1],

        ];

        foreach($types as $type) {
            $this->db->set('name_en', $type['name_en']);
            $this->db->set('name_ar', $type['name_ar']);
            $this->db->set('is_editable', $type['is_editable']);
            $this->db->insert('tm_type');
        }
    }

    public function down() {
        $this->db->truncate('tm_type');

    }

}
