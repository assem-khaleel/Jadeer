<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_Model extends CI_Model {
    
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
        
        $this->db->select('t.*');
        $this->db->distinct();
        $this->db->from(Orm_Tasks::get_table_name() . ' AS t');
        
        if (isset($filters['id'])) {
            $this->db->where('t.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('t.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('t.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('t.id', $filters['not_in_id']);
        }
        if (isset($filters['from'])) {
            $this->db->where('t.from', $filters['from']);
        }
        if (isset($filters['not_from'])) {
            $this->db->where('t.from', $filters['not_from']);
        }
        if (isset($filters['to'])) {
            $this->db->where('t.to', $filters['to']);
        }
        if (isset($filters['not_to'])) {
            $this->db->where('t.to !=', $filters['not_to']);
        }
        if (isset($filters['text'])) {
            $this->db->where('t.text', $filters['text']);
        }
        if (!empty($filters['time'])) {
            $this->db->where('t.time', $filters['time']);
        }
        if (!empty($filters['greater_time'])) {
            $this->db->where('t.time >=', $filters['greater_time']);
        }
        if (!empty($filters['less_time'])) {
            $this->db->where('t.time <=', $filters['less_time']);
        }
        if (!empty($filters['from_time']) && !empty($filters['to_time'])) {
            $this->db->group_start();
            $this->db->where('t.time >=', $filters['from_time']);
            $this->db->where('t.time <=', $filters['to_time']);
            $this->db->group_end();
        }
        if (isset($filters['done'])) {
            $this->db->where('t.done', $filters['done']);
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
            return Orm_Tasks::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Tasks::to_object($row);
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
        $this->db->insert(Orm_Tasks::get_table_name(), $params);
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
        return $this->db->update(Orm_Tasks::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Tasks::get_table_name(), array('id' => $id));
    }
    
}

