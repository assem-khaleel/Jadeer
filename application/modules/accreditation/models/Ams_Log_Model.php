<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ams_Log_Model extends CI_Model {
    
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
        
        $this->db->select('al.*');
        $this->db->distinct();
        $this->db->from(Orm_Ams_Log::get_table_name().' AS al');
        
        if (isset($filters['id'])) {
            $this->db->where('al.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('al.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('al.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('al.id', $filters['not_in_id']);
        }
        if (!empty($filters['user_added'])) {
            $this->db->where('al.user_added', $filters['user_added']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('al.date_added', $filters['date_added']);
        }
        if (!empty($filters['is_released'])) {
            $this->db->where('al.is_released', $filters['is_released']);
        }
        if (!empty($filters['date_released'])) {
            $this->db->where('al.date_released', $filters['date_released']);
        }
        if (!empty($filters['comment'])) {
            $this->db->where('al.comment', $filters['comment']);
        }
        if (!empty($filters['forms'])) {
            $this->db->where('al.forms', $filters['forms']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('al.type', $filters['type']);
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
            return Orm_Ams_Log::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Ams_Log::to_object($row);
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
        $this->db->insert(Orm_Ams_Log::get_table_name(), $params);
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
        return $this->db->update(Orm_Ams_Log::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Ams_Log::get_table_name(), array('id' => (int) $id));
    }
    
}

