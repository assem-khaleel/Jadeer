<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Forms_Recommendation_Model extends CI_Model {
    
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
        
        $this->db->select('ffr.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Forms_Recommendation::get_table_name() . ' AS ffr');
        
        if (!empty($filters['recommendation_ar'])) {
            $this->db->where('ffr.recommendation_ar', $filters['recommendation_ar']);
        }
        if (!empty($filters['recommendation_en'])) {
            $this->db->where('ffr.recommendation_en', $filters['recommendation_en']);
        }
        if (!empty($filters['category_id'])) {
            $this->db->where('ffr.category_id', $filters['category_id']);
        }
        if (!empty($filters['type_id'])) {
            $this->db->where('ffr.type_id', $filters['type_id']);
        }
        if (!empty($filters['action_ar'])) {
            $this->db->where('ffr.action_ar', $filters['action_ar']);
        }
        if (!empty($filters['action_en'])) {
            $this->db->where('ffr.action_en', $filters['action_en']);
        }
        if (isset($filters['deadline_id'])) {
            $this->db->where('ffr.deadline_id', $filters['deadline_id']);
        }
        if (isset($filters['faculty_id'])) {
            $this->db->where('ffr.faculty_id', $filters['faculty_id']);
        }
        if (isset($filters['id'])) {
            $this->db->where('ffr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ffr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ffr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ffr.id', $filters['not_in_id']);
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
            return Orm_Fp_Forms_Recommendation::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Forms_Recommendation::to_object($row);
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
    * @return boolean
    */
    public function insert($params = array()) {
        return $this->db->insert(Orm_Fp_Forms_Recommendation::get_table_name(), $params);
    }
    
    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Fp_Forms_Recommendation::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Forms_Recommendation::get_table_name(), array('id' => $id));
    }
    
}

