<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Pm_Project_Phase_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Pm_Project_Phase_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Pm_Project_Phase | Orm_Pm_Project_Phase[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('ppp.*');
        $this->db->distinct();
        $this->db->from(Orm_Pm_Project_Phase::get_table_name() . ' AS ppp');
        
        if (isset($filters['id'])) {
            $this->db->where('ppp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ppp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ppp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ppp.id', $filters['not_in_id']);
        }
        if (isset($filters['project_id'])) {
            $this->db->where('ppp.project_id', $filters['project_id']);
        }
        if (isset($filters['phase_id'])) {
            $this->db->where('ppp.phase_id', $filters['phase_id']);
        }
        if (isset($filters['project_type'])) {
            $this->db->where('ppp.project_type', $filters['project_type']);
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
            return Orm_Pm_Project_Phase::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pm_Project_Phase::to_object($row);
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
        $this->db->insert(Orm_Pm_Project_Phase::get_table_name(), $params);
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
        return $this->db->update(Orm_Pm_Project_Phase::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pm_Project_Phase::get_table_name(), array('id' => $id));
    }
    
}

