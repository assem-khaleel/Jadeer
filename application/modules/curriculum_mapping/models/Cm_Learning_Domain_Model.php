<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cm_Learning_Domain_Model extends CI_Model {
    
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
        
        $this->db->select('cld.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Learning_Domain::get_table_name() . ' AS cld');
        $this->db->where('cld.is_deleted', 0);

        if (isset($filters['id'])) {
            $this->db->where('cld.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cld.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cld.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cld.id', $filters['not_in_id']);
        }
        if (isset($filters['ncaaa_code'])) {
            $this->db->where('cld.ncaaa_code', $filters['ncaaa_code']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('cld.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('cld.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('cld.type', $filters['type']);
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
            return Orm_Cm_Learning_Domain::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Learning_Domain::to_object($row);
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
        $this->db->insert(Orm_Cm_Learning_Domain::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Learning_Domain::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        Orm_Cm_Learning_Outcome::get_model()->delete_by_learning_domain_id($id);
        return $this->db->update(Orm_Cm_Learning_Domain::get_table_name(), array('is_deleted' => 1), array('id' => $id));
    }
    
}

