<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pt_Goal_Program_Model extends CI_Model {
    
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
        
        $this->db->select('pgp.*');
        $this->db->distinct();
        $this->db->from(Orm_Pt_Goal_Program::get_table_name() . ' AS pgp');
        
        if (isset($filters['id'])) {
            $this->db->where('pgp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pgp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pgp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pgp.id', $filters['not_in_id']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('pgp.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('pgp.title_en', $filters['title_en']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('pgp.program_id', $filters['program_id']);
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
            return Orm_Pt_Goal_Program::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pt_Goal_Program::to_object($row);
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
        $this->db->insert(Orm_Pt_Goal_Program::get_table_name(), $params);
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
        return $this->db->update(Orm_Pt_Goal_Program::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pt_Goal_Program::get_table_name(), array('id' => $id));
    }
    
}

