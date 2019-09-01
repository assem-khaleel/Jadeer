<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Rb_Evaluations_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Rb_Evaluations_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Rb_Evaluations | Orm_Rb_Evaluations[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('re.*');
        $this->db->distinct();
        $this->db->from(Orm_Rb_Evaluations::get_table_name() . ' AS re');
        
        if (isset($filters['id'])) {
            $this->db->where('re.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('re.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('re.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('re.id', $filters['not_in_id']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('re.description_en', $filters['description_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('re.description_ar', $filters['description_ar']);
        }
        if (isset($filters['rubrics_id'])) {
            $this->db->where('re.rubrics_id', $filters['rubrics_id']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('re.date_added', $filters['date_added']);
        }
        if (!empty($filters['greater_date_added'])) {
            $this->db->where('re.date_added >=', $filters['greater_date_added']);
        }
        if (!empty($filters['less_date_added'])) {
            $this->db->where('re.date_added <=', $filters['less_date_added']);
        }
        if (!empty($filters['from_date_added']) && !empty($filters['to_date_added'])) {
            $this->db->group_start();
            $this->db->where('re.date_added >=', $filters['from_date_added']);
            $this->db->where('re.date_added <=', $filters['to_date_added']);
            $this->db->group_end();
        }
        if (!empty($filters['criteria'])) {
            $this->db->where('re.criteria', $filters['criteria']);
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
            return Orm_Rb_Evaluations::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rb_Evaluations::to_object($row);
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
        $this->db->insert(Orm_Rb_Evaluations::get_table_name(), $params);
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
        return $this->db->update(Orm_Rb_Evaluations::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Rb_Evaluations::get_table_name(), array('id' => $id));
    }
    
}

