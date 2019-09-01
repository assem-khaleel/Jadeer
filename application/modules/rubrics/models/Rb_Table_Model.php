<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rb_Table_Model extends CI_Model {
    
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
        
        $this->db->select('rt.*');
        $this->db->distinct();
        $this->db->from(Orm_Rb_Table::get_table_name() . ' AS rt');
        
        if (isset($filters['id'])) {
            $this->db->where('rt.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('rt.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('rt.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('rt.id', $filters['not_in_id']);
        }
        if (isset($filters['rubric_id'])) {
            $this->db->where('rt.rubric_id', $filters['rubric_id']);
        }
        if (isset($filters['skill_id'])) {
            $this->db->where('rt.skill_id', $filters['skill_id']);
        }
        if (isset($filters['not_in_skill_id'])) {
            $this->db->where_not_in('rt.skill_id', $filters['not_in_skill_id']);
        }
        if (isset($filters['in_skill_id'])) {
            $this->db->where_in('rt.skill_id', $filters['in_skill_id']);
        }
        if (isset($filters['scale_id'])) {
            $this->db->where('rt.scale_id', $filters['scale_id']);
        }
        if (isset($filters['value'])) {
            $this->db->where('rt.value', $filters['value']);
        }
        if (isset($filters['target'])) {
            $this->db->where('rt.target', $filters['target']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('rt.description_en', $filters['description_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('rt.description_ar', $filters['description_ar']);
        }
        if (isset($filters['date_added'])) {
            $this->db->where('rt.date_added', $filters['date_added']);
        }
        if (isset($filters['date_modified'])) {
            $this->db->where('rt.date_modified', $filters['date_modified']);
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
            return Orm_Rb_Table::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rb_Table::to_object($row);
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
        return $this->db->insert(Orm_Rb_Table::get_table_name(), $params);
    }
    
    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Rb_Table::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Rb_Table::get_table_name(), array('id' => $id));
    }
    
}

