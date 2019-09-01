<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Project_Model extends CI_Model {
    
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
        
        $this->db->select('fp.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Project::get_table_name().' AS fp');
        
        if (isset($filters['id'])) {
            $this->db->where('fp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fp.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fp.user_id', $filters['user_id']);
        }
        if (!empty($filters['name'])) {
            $this->db->where('fp.name', $filters['name']);
        }
        if (!empty($filters['date_from'])) {
            $this->db->where('fp.date_from', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('fp.date_to', $filters['date_to']);
        }
        if (!empty($filters['location'])) {
            $this->db->where('fp.location', $filters['location']);
        }
        if (!empty($filters['membership'])) {
            $this->db->where('fp.membership', $filters['membership']);
        }
        if (!empty($filters['description'])) {
            $this->db->where('fp.description', $filters['description']);
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
            return Orm_Fp_Project::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Project::to_object($row);
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
        $this->db->insert(Orm_Fp_Project::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Project::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Project::get_table_name(), array('id' => (int) $id));
    }
    
}

