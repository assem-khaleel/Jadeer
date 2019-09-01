<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Cohort_Table_Model
 */
class Data_Cohort_Table_Model extends CI_Model {
    
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
        
        $this->db->select('dct.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Cohort_Table::get_table_name().' AS dct');
        
        if (isset($filters['id'])) {
            $this->db->where('dct.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dct.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dct.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dct.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dct.program_id', $filters['program_id']);
        }
        if (!empty($filters['report_year'])) {
            $this->db->where('dct.report_year', $filters['report_year']);
        }
        if (!empty($filters['start_year'])) {
            $this->db->where('dct.start_year', $filters['start_year']);
        }
        if (!empty($filters['level_year'])) {
            $this->db->where('dct.level_year', $filters['level_year']);
        }
        if (!empty($filters['cohort_enroll'])) {
            $this->db->where('dct.cohort_enroll', $filters['cohort_enroll']);
        }
        if (!empty($filters['retain_till_year'])) {
            $this->db->where('dct.retain_till_year', $filters['retain_till_year']);
        }
        if (!empty($filters['withdrawn_enrolled'])) {
            $this->db->where('dct.withdrawn_enrolled', $filters['withdrawn_enrolled']);
        }
        if (!empty($filters['withdrawn_good'])) {
            $this->db->where('dct.withdrawn_good', $filters['withdrawn_good']);
        }
        if (!empty($filters['graduated'])) {
            $this->db->where('dct.graduated', $filters['graduated']);
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
            return Orm_Data_Cohort_Table::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Cohort_Table::to_object($row);
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
        $this->db->insert(Orm_Data_Cohort_Table::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Cohort_Table::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Cohort_Table::get_table_name(), array('id' => (int) $id));
    }
    
}

