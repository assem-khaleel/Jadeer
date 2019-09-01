<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Learning_Domain_Type_Data
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Learning_Domain_Type_Data extends CI_Migration {
    
    public function up() {

        $types = [
            [
                'name_en' => 'NCAAA 5 Learning Domain',
                'name_ar' => 'مجالات التعلم (5) الخاصة ب NCAAA',
                'is_statics' => 1,
            ],
            [
                'name_en' => 'NCAAA 3 Learning Domain',
                'name_ar' => 'مجالات التعلم (3) الخاصة ب NCAAA',
                'is_statics' => 1,
            ],
            [
                'name_en' => 'Standard Learning Domain',
                'name_ar' => 'مجالات التعلم الثابتة',
                'is_statics' => 1
            ]
        ];


        foreach($types as $type){
            $this->db->set('name_en', $type['name_en']);
            $this->db->set('name_ar', $type['name_ar']);
            $this->db->set('is_statics', $type['is_statics']);

            $this->db->insert('learning_domain_type');

        }

    }
    
    public function down() {

        $this->db->truncate('learning_domain_type');

    }
    
}
