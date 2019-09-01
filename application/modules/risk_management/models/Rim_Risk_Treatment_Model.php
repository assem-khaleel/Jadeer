<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Rim_Risk_Treatment_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Rim_Risk_Treatment_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Rim_Risk_Treatment | Orm_Rim_Risk_Treatment[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('rrt.*');
        $this->db->distinct();
        $this->db->from(Orm_Rim_Risk_Treatment::get_table_name() . ' AS rrt');
        
        if (isset($filters['id'])) {
            $this->db->where('rrt.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('rrt.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('rrt.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('rrt.id', $filters['not_in_id']);
        }
        if (isset($filters['responsible_id'])) {
            $this->db->where('rrt.responsible_id', $filters['responsible_id']);
        }
        if (isset($filters['risk_id'])) {
            $this->db->where('rrt.risk_id', $filters['risk_id']);
        }
        if (!empty($filters['desc_ar'])) {
            $this->db->where('rrt.desc_ar', $filters['desc_ar']);
        }
        if (!empty($filters['desc_en'])) {
            $this->db->where('rrt.desc_en', $filters['desc_en']);
        }
        if (!empty($filters['risk_desc_ar'])) {
            $this->db->where('rrt.risk_desc_ar', $filters['risk_desc_ar']);
        }
        if (!empty($filters['risk_desc_en'])) {
            $this->db->where('rrt.risk_desc_en', $filters['risk_desc_en']);
        }
         if (!empty($filters['impact_ar'])) {
            $this->db->where('rrt.impact_ar', $filters['impact_ar']);
        }
        if (!empty($filters['impact_en'])) {
            $this->db->where('rrt.impact_en', $filters['impact_en']);
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
            return Orm_Rim_Risk_Treatment::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rim_Risk_Treatment::to_object($row);
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
        $this->db->insert(Orm_Rim_Risk_Treatment::get_table_name(), $params);
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
        return $this->db->update(Orm_Rim_Risk_Treatment::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Rim_Risk_Treatment::get_table_name(), array('id' => $id));
    }
    
}

