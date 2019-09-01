<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class As_Agency_Model extends CI_Model {
    
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
        
        $this->db->select('aa.*');
        $this->db->distinct();
        $this->db->from(Orm_As_Agency::get_table_name().' AS aa');
        
        if (isset($filters['id'])) {
            $this->db->where('aa.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('aa.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('aa.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('aa.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('aa.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('aa.name_en', $filters['name_en']);
        }
	    if (!empty($filters['accredited_years'])) {
		    $this->db->where('aa.accredited_years', $filters['accredited_years']);
	    }
	    if (!empty($filters['notify_before'])) {
		    $this->db->where('aa.notify_before', $filters['notify_before']);
	    }
        if (!empty($filters['date_added'])) {
            $this->db->where('aa.date_added', $filters['date_added']);
        }
        if (!empty($filters['date_modified'])) {
            $this->db->where('aa.date_modified', $filters['date_modified']);
        }
	    if (!empty($filters['keyword'])) {
		    $this->db->group_start();
		    $this->db->like('aa.name_en', $filters['keyword']);
		    $this->db->or_like('aa.name_ar', $filters['keyword']);
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
	            return Orm_As_Agency::to_object($this->db->get()->row_array());
	            break;
            case Orm::FETCH_OBJECTS:
	            $objects = array();
	            foreach($this->db->get()->result_array() as $row) {
	                $objects[] = Orm_As_Agency::to_object($row);
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
        $this->db->insert(Orm_As_Agency::get_table_name(), $params);
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
        return $this->db->update(Orm_As_Agency::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_As_Agency::get_table_name(), array('id' => (int) $id));
    }
    
}