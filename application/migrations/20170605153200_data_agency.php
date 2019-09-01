<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Data_Agency extends CI_Migration {
    
    public function up() {

        $agencies = [
            ['name' => 'NCAAA', 'accredited_years' => 5],
            ['name' => 'ABET',  'accredited_years' => 1],
            ['name' => 'AACSB', 'accredited_years' => 5],
            ['name' => 'ACPE',  'accredited_years' => 3],
            ['name' => 'JCI',   'accredited_years' => 3],
            ['name' => 'ASIIN', 'accredited_years' => 1]
        ];

        foreach($agencies as $agency) {
            $this->db->set('name_en', $agency['name']);
            $this->db->set('name_ar', $agency['name']);
            $this->db->set('accredited_years', $agency['accredited_years']);
            $this->db->insert('as_agency');
        }
    }
    
    public function down() {
        $this->db->truncate('as_agency');
    }
    
}
