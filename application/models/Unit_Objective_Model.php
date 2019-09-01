<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_Objective_Model extends CI_Model {
    
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
        
        $this->db->select('uo.*');
        $this->db->distinct();
        $this->db->from(Orm_Unit_Objective::get_table_name() . ' AS uo');
        $this->db->where('uo.is_deleted', 0);


        if (isset($filters['id'])) {
            $this->db->where('uo.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('uo.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('uo.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('uo.id', $filters['not_in_id']);
        }
        if (isset($filters['unit_id'])) {
            $this->db->where('uo.unit_id', $filters['unit_id']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('uo.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('uo.title_ar', $filters['title_ar']);
        }
        if (isset($filters['is_deleted'])) {
            $this->db->where('uo.is_deleted', $filters['is_deleted']);
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
            return Orm_Unit_Objective::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Unit_Objective::to_object($row);
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
        $this->db->insert(Orm_Unit_Objective::get_table_name(), $params);
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
        return $this->db->update(Orm_Unit_Objective::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Unit_Objective::get_table_name(), array('is_deleted'=>1), array('id' => $id));
    }
    
}

