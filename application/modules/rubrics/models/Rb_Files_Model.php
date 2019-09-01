<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rb_Files_Model extends CI_Model {
    
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
        
        $this->db->select('rf.*');
        $this->db->distinct();
        $this->db->from(Orm_Rb_Files::get_table_name() . ' AS rf');
        
        if (isset($filters['id'])) {
            $this->db->where('rf.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('rf.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('rf.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('rf.id', $filters['not_in_id']);
        }
        if (isset($filters['rubrics_id'])) {
            $this->db->where('rf.rubrics_id', $filters['rubrics_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('rf.user_id', $filters['user_id']);
        }
        if (!empty($filters['file_name'])) {
            $this->db->where('rf.file_name', $filters['file_name']);
        }
        if (!empty($filters['file_path'])) {
            $this->db->where('rf.file_path', $filters['file_path']);
        }
        if (!empty($filters['file_header'])) {
            $this->db->where('rf.file_header', $filters['file_header']);
        }
        if (isset($filters['date_added'])) {
            $this->db->where('rf.date_added', $filters['date_added']);
        }
        if (isset($filters['date_modified'])) {
            $this->db->where('rf.date_modified', $filters['date_modified']);
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
            return Orm_Rb_Files::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rb_Files::to_object($row);
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
        $this->db->insert(Orm_Rb_Files::get_table_name(), $params);
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
        return $this->db->update(Orm_Rb_Files::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Rb_Files::get_table_name(), array('id' => $id));
    }
    
}
