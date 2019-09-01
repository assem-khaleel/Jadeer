<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Student_Work_Model extends CI_Model {
    
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
        
        $this->db->select('psw.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Student_Work::get_table_name() . ' AS psw');
        
        if (isset($filters['id'])) {
            $this->db->where('psw.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('psw.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('psw.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('psw.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('psw.course_id', $filters['course_id']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('psw.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('psw.title_en', $filters['title_en']);
        }
        if (!empty($filters['student_project_file'])) {
            $this->db->where('psw.student_project_file', $filters['student_project_file']);
        }
        if (!empty($filters['grading_guideline_ar'])) {
            $this->db->where('psw.grading_guideline_ar', $filters['grading_guideline_ar']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('psw.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['grading_guideline_en'])) {
            $this->db->where('psw.grading_guideline_en', $filters['grading_guideline_en']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('psw.type', $filters['type']);
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
            return Orm_Pc_Student_Work::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Student_Work::to_object($row);
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
        $this->db->insert(Orm_Pc_Student_Work::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Student_Work::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Student_Work::get_table_name(), array('id' => $id));
    }
    
}

