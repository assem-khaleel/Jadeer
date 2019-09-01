<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Advising_Model extends CI_Model {
    
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
        
        $this->db->select('fa.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Advising::get_table_name().' AS fa');
        
        if (isset($filters['id'])) {
            $this->db->where('fa.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fa.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fa.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fa.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fa.user_id', $filters['user_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('fa.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['level'])) {
            $this->db->where('fa.level', $filters['level']);
        }
        if (!empty($filters['number_of_students'])) {
            $this->db->where('fa.number_of_students', $filters['number_of_students']);
        }
        if (!empty($filters['number_of_sections'])) {
            $this->db->where('fa.number_of_sections', $filters['number_of_sections']);
        }
        if (!empty($filters['subject_taught'])) {
            $this->db->where('fa.subject_taught', $filters['subject_taught']);
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
            return Orm_Fp_Advising::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Advising::to_object($row);
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
        $this->db->insert(Orm_Fp_Advising::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Advising::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Advising::get_table_name(), array('id' => (int) $id));
    }
    
}

