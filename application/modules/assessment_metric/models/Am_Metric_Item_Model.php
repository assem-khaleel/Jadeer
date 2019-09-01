<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Am_Metric_Item_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Am_Metric_Item_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Am_Metric_Item | Orm_Am_Metric_Item[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('ami.*');
        $this->db->distinct();
        $this->db->from(Orm_Am_Metric_Item::get_table_name() . ' AS ami');
        
        if (isset($filters['id'])) {
            $this->db->where('ami.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ami.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ami.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ami.id', $filters['not_in_id']);
        }
        if (!empty($filters['component_ar'])) {
            $this->db->where('ami.component_ar', $filters['component_ar']);
        }
        if (!empty($filters['component_en'])) {
            $this->db->where('ami.component_en', $filters['component_en']);
        }
        if (isset($filters['wieght'])) {
            $this->db->where('ami.wieght', $filters['wieght']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('ami.course_id', $filters['course_id']);
        }
        if (isset($filters['high_score'])) {
            $this->db->where('ami.high_score', $filters['high_score']);
        }
        if (isset($filters['average'])) {
            $this->db->where('ami.average', $filters['average']);
        }
        if (isset($filters['result'])) {
            $this->db->where('ami.result', $filters['result']);
        }
        if (isset($filters['assessment_metric_id'])) {
            $this->db->where('ami.assessment_metric_id', $filters['assessment_metric_id']);
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
            return Orm_Am_Metric_Item::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Am_Metric_Item::to_object($row);
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
        $this->db->insert(Orm_Am_Metric_Item::get_table_name(), $params);
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
        return $this->db->update(Orm_Am_Metric_Item::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Am_Metric_Item::get_table_name(), array('id' => $id));
    }
    
}

