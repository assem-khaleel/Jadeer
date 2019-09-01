<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Format_Model extends CI_Model {
    
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
        
        $this->db->select('pf.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Format::get_table_name() . ' AS pf');
        
        if (isset($filters['id'])) {
            $this->db->where('pf.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pf.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pf.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pf.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('pf.course_id', $filters['course_id']);
        }
        if (!empty($filters['assignment_format_file'])) {
            $this->db->where('pf.assignment_format_file', $filters['assignment_format_file']);
        }
        if (!empty($filters['homework_format_file'])) {
            $this->db->where('pf.homework_format_file', $filters['homework_format_file']);
        }
        if (!empty($filters['lab_experiment_format_file'])) {
            $this->db->where('pf.lab_experiment_format_file', $filters['lab_experiment_format_file']);
        }
        if (!empty($filters['class_exercise_format_file'])) {
            $this->db->where('pf.class_exercise_format_file', $filters['class_exercise_format_file']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('pf.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['file_name_ar'])) {
            $this->db->where('pf.file_name_ar', $filters['file_name_ar']);
        }
        if (!empty($filters['file_name_en'])) {
            $this->db->where('pf.file_name_en', $filters['file_name_en']);
        }
        if (isset($filters['is_not_null'])) {
            $this->db->where('pf.'.$filters['is_not_null'].' IS NOT NULL');
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
            return Orm_Pc_Format::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Format::to_object($row);
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
        $this->db->insert(Orm_Pc_Format::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Format::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Format::get_table_name(), array('id' => $id));
    }
    
}

