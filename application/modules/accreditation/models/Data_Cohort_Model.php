<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Cohort_Model extends CI_Model {
    
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
        
        $this->db->select('dc.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Cohort::get_table_name().' AS dc');
        
        if (isset($filters['id'])) {
            $this->db->where('dc.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dc.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dc.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dc.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dc.program_id', $filters['program_id']);
        }
        if (!empty($filters['report_year'])) {
            $this->db->where('dc.report_year', $filters['report_year']);
        }
        if (!empty($filters['level_year'])) {
            $this->db->where('dc.level_year', $filters['level_year']);
        }
        if (!empty($filters['started_on'])) {
            $this->db->where('dc.started_on', $filters['started_on']);
        }
        if (isset($filters['status_id'])) {
            $this->db->where('dc.status_id', $filters['status_id']);
        }
        if (!empty($filters['student_count'])) {
            $this->db->where('dc.student_count', $filters['student_count']);
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
            return Orm_Data_Cohort::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Cohort::to_object($row);
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
        $this->db->insert(Orm_Data_Cohort::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Cohort::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Cohort::get_table_name(), array('id' => (int) $id));
    }
    
}

