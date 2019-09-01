<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Course_Policies_Model extends CI_Model {
    
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
        
        $this->db->select('pcp.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Course_Policies::get_table_name() . ' AS pcp');
        
        if (isset($filters['id'])) {
            $this->db->where('pcp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pcp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pcp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pcp.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('pcp.course_id', $filters['course_id']);
        }
        if (!empty($filters['grading_ar'])) {
            $this->db->where('pcp.grading_ar', $filters['grading_ar']);
        }
        if (!empty($filters['grading_en'])) {
            $this->db->where('pcp.grading_en', $filters['grading_en']);
        }
        if (!empty($filters['attendance_ar'])) {
            $this->db->where('pcp.attendance_ar', $filters['attendance_ar']);
        }
        if (!empty($filters['attendance_en'])) {
            $this->db->where('pcp.attendance_en', $filters['attendance_en']);
        }
        if (!empty($filters['lateness_ar'])) {
            $this->db->where('pcp.lateness_ar', $filters['lateness_ar']);
        }
        if (!empty($filters['lateness_en'])) {
            $this->db->where('pcp.lateness_en', $filters['lateness_en']);
        }
        if (!empty($filters['class_participation_en'])) {
            $this->db->where('pcp.class_participation_en', $filters['class_participation_en']);
        }
        if (!empty($filters['class_participation_ar'])) {
            $this->db->where('pcp.class_participation_ar', $filters['class_participation_ar']);
        }
        if (!empty($filters['missed_exam_ar'])) {
            $this->db->where('pcp.missed_exam_ar', $filters['missed_exam_ar']);
        }
        if (!empty($filters['missed_exam_en'])) {
            $this->db->where('pcp.missed_exam_en', $filters['missed_exam_en']);
        }
        if (!empty($filters['missed_assignment_ar'])) {
            $this->db->where('pcp.missed_assignment_ar', $filters['missed_assignment_ar']);
        }
        if (!empty($filters['missed_assignment_en'])) {
            $this->db->where('pcp.missed_assignment_en', $filters['missed_assignment_en']);
        }
        if (!empty($filters['academic_dishonesty_ar'])) {
            $this->db->where('pcp.academic_dishonesty_ar', $filters['academic_dishonesty_ar']);
        }
        if (!empty($filters['academic_dishonesty_en'])) {
            $this->db->where('pcp.academic_dishonesty_en', $filters['academic_dishonesty_en']);
        }
        if (!empty($filters['academic_plagiarism_ar'])) {
            $this->db->where('pcp.academic_plagiarism_ar', $filters['academic_plagiarism_ar']);
        }
        if (!empty($filters['academic_plagiarism_en'])) {
            $this->db->where('pcp.academic_plagiarism_en', $filters['academic_plagiarism_en']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('pcp.semester_id', $filters['semester_id']);
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
            return Orm_Pc_Course_Policies::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Course_Policies::to_object($row);
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
        $this->db->insert(Orm_Pc_Course_Policies::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Course_Policies::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Course_Policies::get_table_name(), array('id' => $id));
    }
    
}

