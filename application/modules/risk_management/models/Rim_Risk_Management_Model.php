<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Rim_Risk_Management_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Rim_Risk_Management_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Rim_Risk_Management | Orm_Rim_Risk_Management[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('rrm.*');
        $this->db->distinct();
        $this->db->from(Orm_Rim_Risk_Management::get_table_name() . ' AS rrm');
        
        if (isset($filters['id'])) {
            $this->db->where('rrm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('rrm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('rrm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('rrm.id', $filters['not_in_id']);
        }
        if (!empty($filters['level_type'])) {
            $this->db->where('rrm.level_type', $filters['level_type']);
        }
        if (isset($filters['level_id'])) {
            $this->db->where('rrm.level_id', $filters['level_id']);
        }
        if (isset($filters['in_level_id'])) {
            $this->db->or_group_start();
            $this->db->where_in('rrm.level_id',$filters['in_level_id']);
            $this->db->group_end();
        }
        if (!empty($filters['type'])) {
            $this->db->where('rrm.type', $filters['type']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('rrm.type_id', $filters['type_id']);
        }
        if (isset($filters['likely'])) {
            $this->db->where('rrm.likely', $filters['likely']);
        }
        if (isset($filters['severity'])) {
            $this->db->where('rrm.severity', $filters['severity']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('rrm.type', $filters['keyword']);
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
                $row = $this->db->get()->row_array();
            return Orm_Rim_Risk_Management::to_object($row, $row['type']);
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rim_Risk_Management::to_object($row, $row['type']);
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
        $this->db->insert(Orm_Rim_Risk_Management::get_table_name(), $params);
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
        return $this->db->update(Orm_Rim_Risk_Management::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Rim_Risk_Management::get_table_name(), array('id' => $id));
    }
    
}

