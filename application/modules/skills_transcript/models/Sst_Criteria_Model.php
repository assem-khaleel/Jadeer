<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Sst_Criteria_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Sst_Criteria_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Sst_Criteria | Orm_Sst_Criteria[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('sc.*');
        $this->db->distinct();
        $this->db->from(Orm_Sst_Criteria::get_table_name() . ' AS sc');
        
        if (isset($filters['id'])) {
            $this->db->where('sc.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sc.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sc.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sc.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('sc.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('sc.name_ar', $filters['name_ar']);
        }
        if (isset($filters['group_id'])) {
            $this->db->where('sc.group_id', $filters['group_id']);
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
            return Orm_Sst_Criteria::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Sst_Criteria::to_object($row);
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
        $this->db->insert(Orm_Sst_Criteria::get_table_name(), $params);
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
        return $this->db->update(Orm_Sst_Criteria::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Sst_Criteria::get_table_name(), array('id' => $id));
    }
    
}

