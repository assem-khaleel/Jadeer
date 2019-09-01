<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Instructor_Information_Model extends CI_Model {
    
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
        
        $this->db->select('pii.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Instructor_Information::get_table_name() . ' AS pii');
        
        if (isset($filters['id'])) {
            $this->db->where('pii.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pii.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pii.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pii.id', $filters['not_in_id']);
        }
        if (isset($filters['faculty_id'])) {
            $this->db->where('pii.faculty_id', $filters['faculty_id']);
        }
        if (isset($filters['section_id'])) {
            $this->db->where('pii.section_id', $filters['section_id']);
        }
        if (!empty($filters['office_location'])) {
            $this->db->where('pii.office_location', $filters['office_location']);
        }
        if (!empty($filters['office_hours'])) {
            $this->db->where('pii.office_hours', $filters['office_hours']);
        }
        if (isset($filters['course_id'])) {
            $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = pii.section_id');
            $this->db->where('cs.course_id', $filters['course_id']);
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
            return Orm_Pc_Instructor_Information::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Instructor_Information::to_object($row);
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
        $this->db->insert(Orm_Pc_Instructor_Information::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Instructor_Information::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Instructor_Information::get_table_name(), array('id' => $id));
    }
    
}

