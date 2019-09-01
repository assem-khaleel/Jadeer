<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus_Model extends CI_Model {
    
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
        
        $this->db->select('c.*');
        $this->db->distinct();
        $this->db->from(Orm_Campus::get_table_name(). ' AS c');
        $this->db->where('c.is_deleted', 0);

        if (isset($filters['id'])) {
            $this->db->where('c.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('c.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('c.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('c.id', $filters['not_in_id']);
        }
        if (isset($filters['integration_id'])) {
            $this->db->where('c.integration_id', $filters['integration_id']);
        }
        if (!empty($filters['is_deleted'])) {
            $this->db->where('c.is_deleted', $filters['is_deleted']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('c.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('c.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('c.name_en', $filters['keyword']);
            $this->db->or_like('c.name_ar', $filters['keyword']);
            $this->db->group_end();
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
            return Orm_Campus::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Campus::to_object($row);
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
        $this->db->insert(Orm_Campus::get_table_name(), $params);
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
        return $this->db->update(Orm_Campus::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Campus::get_table_name(), array('is_deleted'=>1), array('id' => (int) $id));
    }
    
}

