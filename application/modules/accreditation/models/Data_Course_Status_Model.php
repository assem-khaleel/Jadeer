<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Course_Status_Model
 */
class Data_Course_Status_Model extends CI_Model {
    
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
        
        $this->db->select('dcs.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Course_Status::get_table_name().' AS dcs');
        
        $this->get_filters($filters);
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Data_Course_Status::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Course_Status::to_object($row);
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
    
    public function get_filters($filters = array()) {
        if (isset($filters['id'])) {
            $this->db->where('dcs.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dcs.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dcs.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dcs.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dcs.program_id', $filters['program_id']);
        }
        if (isset($filters['college_id'])) {
            $this->db->join(Orm_Course::get_table_name().' AS c','c.id = dcs.course_id','inner');
            $this->db->join(Orm_Department::get_table_name().' AS d', 'd.id = c.department_id', 'inner');
            $this->db->where('d.college_id', $filters['college_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('dcs.course_id', $filters['course_id']);
        }
        if (isset($filters['section_id'])) {
            $this->db->where('dcs.section_id', $filters['section_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('dcs.semester_id', $filters['semester_id']);
        }
        if (isset($filters['status_id'])) {
            $this->db->where('dcs.status_id', $filters['status_id']);
        }
        if (!empty($filters['student_count'])) {
            $this->db->where('dcs.student_count', $filters['student_count']);
        }
    }

        /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Course_Status::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Course_Status::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Course_Status::get_table_name(), array('id' => (int) $id));
    }
    
    public function get_sum($filters = array()) {
        $this->db->select_sum('dcs.student_count','students');
        $this->db->from(Orm_Data_Course_Status::get_table_name().' AS dcs');
        
        $this->get_filters($filters);
        
        $result = $this->db->get()->row_array();
        
        return isset($result['students']) ? $result['students'] : 0;
    }
}

