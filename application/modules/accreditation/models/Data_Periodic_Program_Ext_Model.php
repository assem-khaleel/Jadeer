<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Periodic_Program_Ext_Model
 */
class Data_Periodic_Program_Ext_Model extends CI_Model {
    
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
        
        $this->db->select('dpp.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Periodic_Program_Ext::get_table_name().' AS dpp');
        
        $this->get_filters($filters);
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Data_Periodic_Program::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Periodic_Program::to_object($row);
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

    public function get_filters($filters) {
        if (isset($filters['id'])) {
            $this->db->where('dpp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dpp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dpp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dpp.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dpp.program_id', $filters['program_id']);
        }
        if (isset($filters['academic_year'])) {
            $this->db->where('dpp.academic_year', $filters['academic_year']);
        }
        if (isset($filters['gender'])) {
            $this->db->where('dpp.gender', $filters['gender']);
        }
        if (!empty($filters['work_load'])) {
            $this->db->where('dpp.work_load', $filters['work_load']);
        }
        if (!empty($filters['class_size'])) {
            $this->db->where('dpp.class_size', $filters['class_size']);
        }
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Periodic_Program_Ext::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Periodic_Program_Ext::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Periodic_Program_Ext::get_table_name(), array('id' => (int) $id));
    }

    /**
     * @param $filters
     * @param $type
     * @return mixed
     */
    public function get_sum($filters, $type) {

        $this->db->select_avg('dpp.work_load', 'work_load');
        $this->db->select_avg('dpp.class_size', 'class_size');
        $this->db->from(Orm_Data_Periodic_Program_Ext::get_table_name().' AS dpp');

        $this->get_filters($filters);

        $result = $this->db->get()->row_array();

        if(!is_null($type) && isset($result[$type])) {
            $result = $result[$type];
        }elseif (!is_null($type)) {
            $result = 0;
        }

        return round($result,0);
    }
}

