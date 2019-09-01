<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Node_Review_Comments_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Node_Review_Comments_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Node_Review_Comments | Orm_Node_Review_Comments[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('nrc.*');
        $this->db->distinct();
        $this->db->from(Orm_Node_Review_Comments::get_table_name() . ' AS nrc');
        
        if (isset($filters['id'])) {
            $this->db->where('nrc.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('nrc.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('nrc.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('nrc.id', $filters['not_in_id']);
        }
        if (isset($filters['review_id'])) {
            $this->db->where('nrc.review_id', $filters['review_id']);
        }
        if (!empty($filters['comment'])) {
            $this->db->where('nrc.comment', $filters['comment']);
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
            return Orm_Node_Review_Comments::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Node_Review_Comments::to_object($row);
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
        $this->db->insert(Orm_Node_Review_Comments::get_table_name(), $params);
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
        return $this->db->update(Orm_Node_Review_Comments::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Node_Review_Comments::get_table_name(), array('id' => $id));
    }
    
}

