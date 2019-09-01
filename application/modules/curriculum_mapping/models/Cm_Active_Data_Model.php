<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cm_Active_Data_Model extends CI_Model {
    
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
        
        $this->db->select('cad.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Active_Data::get_table_name() . ' AS cad');
        
        if (isset($filters['id'])) {
            $this->db->where('cad.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cad.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cad.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cad.id', $filters['not_in_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('cad.semester_id', $filters['semester_id']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('cad.type_id', $filters['type_id']);
        }
        if (isset($filters['type'])) {
            $this->db->where('cad.type', $filters['type']);
        }
        if (isset($filters['is_archived'])) {
            $this->db->where('cad.is_archived', $filters['is_archived']);
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
            return Orm_Cm_Active_Data::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Active_Data::to_object($row);
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
        $this->db->insert(Orm_Cm_Active_Data::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Active_Data::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Active_Data::get_table_name(), array('id' => $id));
    }
    
}

