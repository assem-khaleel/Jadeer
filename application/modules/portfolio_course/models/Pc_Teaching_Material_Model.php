<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Teaching_Material_Model extends CI_Model {
    
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
        
        $this->db->select('ptm.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Teaching_Material::get_table_name() . ' AS ptm');
        
        if (isset($filters['id'])) {
            $this->db->where('ptm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ptm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ptm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ptm.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('ptm.course_id', $filters['course_id']);
        }
        if (!empty($filters['course_manual_file'])) {
            $this->db->where('ptm.course_manual_file', $filters['course_manual_file']);
        }
        if (!empty($filters['lecture_note_ar'])) {
            $this->db->where('ptm.lecture_note_ar', $filters['lecture_note_ar']);
        }
        if (!empty($filters['lecture_note_en'])) {
            $this->db->where('ptm.lecture_note_en', $filters['lecture_note_en']);
        }
        if (!empty($filters['addition_ar'])) {
            $this->db->where('ptm.addition_ar', $filters['addition_ar']);
        }
        if (!empty($filters['addition_en'])) {
            $this->db->where('ptm.addition_en', $filters['addition_en']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('ptm.semester_id', $filters['semester_id']);
        }
        if (isset($filters['type'])) {
            $this->db->where('ptm.type', $filters['type']);
        }
        if (isset($filters['course_manual_title_en'])) {
            $this->db->where('ptm.course_manual_title_en', $filters['course_manual_title_en']);
        }
        if (isset($filters['course_manual_title_ar'])) {
            $this->db->where('ptm.course_manual_title_ar', $filters['course_manual_title_ar']);
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
            return Orm_Pc_Teaching_Material::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Teaching_Material::to_object($row);
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
        $this->db->insert(Orm_Pc_Teaching_Material::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Teaching_Material::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Teaching_Material::get_table_name(), array('id' => $id));
    }
    
}

