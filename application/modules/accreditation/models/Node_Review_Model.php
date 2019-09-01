<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node_Review_Model extends CI_Model {
    
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
        
        $this->db->select('nr.*');
        $this->db->distinct();
        $this->db->from(Orm_Node_Review::get_table_name() . ' AS nr');
        
        if (isset($filters['id'])) {
            $this->db->where('nr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('nr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('nr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('nr.id', $filters['not_in_id']);
        }
        if (isset($filters['node_id'])) {
            $this->db->where('nr.node_id', $filters['node_id']);
        }
        if (isset($filters['reviewer_id'])) {
            $this->db->where('nr.reviewer_id', $filters['reviewer_id']);
        }
        if (!empty($filters['not_reviewer_id'])) {
            $this->db->where_not_in('nr.reviewer_id', $filters['not_reviewer_id']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('nr.date_added', $filters['date_added']);
        }
        if (!empty($filters['greater_date_added'])) {
            $this->db->where('nr.date_added >=', $filters['greater_date_added']);
        }
        if (!empty($filters['less_date_added'])) {
            $this->db->where('nr.date_added <=', $filters['less_date_added']);
        }
        if (!empty($filters['from_date_added']) && !empty($filters['to_date_added'])) {
            $this->db->group_start();
            $this->db->where('nr.date_added >=', $filters['from_date_added']);
            $this->db->where('nr.date_added <=', $filters['to_date_added']);
            $this->db->group_end();
        }
        if (!empty($filters['status'])) {
            $this->db->where('nr.status', $filters['status']);
        }
        if (!empty($filters['comment'])) {
            $this->db->where('nr.comment', $filters['comment']);
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
            return Orm_Node_Review::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Node_Review::to_object($row);
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
        $this->db->insert(Orm_Node_Review::get_table_name(), $params);
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
        return $this->db->update(Orm_Node_Review::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Node_Review::get_table_name(), array('id' => $id));
    }
    
}

