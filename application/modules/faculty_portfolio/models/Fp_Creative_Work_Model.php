<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Creative_Work_Model extends CI_Model {
    
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
        
        $this->db->select('fcw.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Creative_Work::get_table_name().' AS fcw');
        
        if (isset($filters['id'])) {
            $this->db->where('fcw.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fcw.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fcw.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fcw.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fcw.user_id', $filters['user_id']);
        }
        if (!empty($filters['name'])) {
            $this->db->where('fcw.name', $filters['name']);
        }
        if (!empty($filters['owner_name'])) {
            $this->db->where('fcw.owner_name', $filters['owner_name']);
        }
        if (!empty($filters['dissemination_type'])) {
            $this->db->where('fcw.dissemination_type', $filters['dissemination_type']);
        }
        if (!empty($filters['funds_type'])) {
            $this->db->where('fcw.funds_type', $filters['funds_type']);
        }
        if (!empty($filters['funds'])) {
            $this->db->where('fcw.funds', $filters['funds']);
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
            return Orm_Fp_Creative_Work::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Creative_Work::to_object($row);
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
        $this->db->insert(Orm_Fp_Creative_Work::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Creative_Work::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Creative_Work::get_table_name(), array('id' => (int) $id));
    }
    
}

