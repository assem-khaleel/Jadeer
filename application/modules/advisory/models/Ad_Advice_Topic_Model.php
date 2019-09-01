<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Ad_Advice_Topic_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Ad_Advice_Topic_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Ad_Advice_Topic | Orm_Ad_Advice_Topic[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('aat.*');
        $this->db->distinct();
        $this->db->from(Orm_Ad_Advice_Topic::get_table_name() . ' AS aat');
        $this->db->where('aat.is_deleted', 0);
        if (isset($filters['id'])) {
            $this->db->where('aat.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('aat.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('aat.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('aat.id', $filters['not_in_id']);
        }
        if (!empty($filters['topic_ar'])) {
            $this->db->where('aat.topic_ar', $filters['topic_ar']);
        }
        if (!empty($filters['topic_en'])) {
            $this->db->where('aat.topic_en', $filters['topic_en']);
        }
        if (!empty($filters['user_id'])) {
            $this->db->where('aat.user_id', $filters['user_id']);
        }
        if (!empty($filters['program_id'])) {
            $this->db->where('aat.program_id', $filters['program_id']);
        }
        if (isset($filters['created_at'])) {
            $this->db->where('aat.created_at', $filters['created_at']);
        }
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('topic_en', $filters['keyword']);
            $this->db->or_like('topic_ar', $filters['keyword']);
            $this->db->group_end();
        }
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Ad_Advice_Topic::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Ad_Advice_Topic::to_object($row);
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
        $this->db->insert(Orm_Ad_Advice_Topic::get_table_name(), $params);
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
        return $this->db->update(Orm_Ad_Advice_Topic::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Ad_Advice_Topic::get_table_name(), array('is_deleted' => 1), array('id' => $id));
    }
    
}

