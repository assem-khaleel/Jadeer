<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Academic_Units_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return array
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('dau.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Academic_Units::get_table_name().' AS dau');
        
        if (isset($filters['id'])) {
            $this->db->where('dau.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dau.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dau.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dau.id', $filters['not_in_id']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('dau.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['no_deanships'])) {
            $this->db->where('dau.no_deanships', $filters['no_deanships']);
        }
        if (!empty($filters['no_colleges'])) {
            $this->db->where('dau.no_colleges', $filters['no_colleges']);
        }
        if (!empty($filters['no_programs'])) {
            $this->db->where('dau.no_programs', $filters['no_programs']);
        }
        if (!empty($filters['no_institutions'])) {
            $this->db->where('dau.no_institutions', $filters['no_institutions']);
        }
        if (!empty($filters['no_research_center'])) {
            $this->db->where('dau.no_research_center', $filters['no_research_center']);
        }
        if (!empty($filters['no_research_chairs'])) {
            $this->db->where('dau.no_research_chairs', $filters['no_research_chairs']);
        }
        if (!empty($filters['no_medical_hospital'])) {
            $this->db->where('dau.no_medical_hospital', $filters['no_medical_hospital']);
        }
        if (!empty($filters['no_scientific'])) {
            $this->db->where('dau.no_scientific', $filters['no_scientific']);
        }
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Data_Academic_Units::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Academic_Units::to_object($row);
            }
            return $objects;
            break;
            case Orm::FETCH_ARRAY:
            return $this->db->get()->result_array();
            break;
            case Orm::FETCH_COUNT:
            return $this->db->count_all_results();
            break;
        }
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Academic_Units::get_table_name(), $params);
        return $this->db->insert_id();
    }
    
    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Data_Academic_Units::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Academic_Units::get_table_name(), array('id' => (int) $id));
    }
    
}

