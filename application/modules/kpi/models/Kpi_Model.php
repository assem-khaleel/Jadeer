<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Kpi_Model
 */
class Kpi_Model extends CI_Model {
    
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
        
        $this->db->select('k.*');
        $this->db->distinct();
        $this->db->from(Orm_Kpi::get_table_name().' AS k');
        $this->db->join(Orm_Criteria::get_table_name().' AS c','c.id = k.criteria_id','left');
        $this->db->join(Orm_Standard::get_table_name().' AS s','s.id = c.standard_id','left');
        
        if (isset($filters['id'])) {
            $this->db->where('k.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('k.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('k.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('k.id', $filters['not_in_id']);
        }
        if (isset($filters['criteria_id'])) {
            $this->db->where('k.criteria_id', $filters['criteria_id']);
        }
        if (!empty($filters['code'])) {
            $this->db->where('k.code', $filters['code']);
        }
        if (!empty($filters['title'])) {
            $this->db->where('k.title', $filters['title']);
        }
        if (!empty($filters['kpi_type'])) {
            $this->db->where('k.kpi_type', $filters['kpi_type']);
        }
        if (!empty($filters['chart_y_title'])) {
            $this->db->where('k.chart_y_title', $filters['chart_y_title']);
        }
        if (isset($filters['college_id'])) {
            $colleges_array = array(0, $filters['college_id']);
            $this->db->where_in('k.college_id', $colleges_array);
        }
        if (isset($filters['only_college_id'])) {
            $this->db->where('k.college_id', $filters['only_college_id']);
        }
        if (!empty($filters['created_by'])) {
            $this->db->where('k.created_by', $filters['created_by']);
        }
        if (isset($filters['category_id'])) {
            $this->db->where('k.category_id', $filters['category_id']);
        }
        if (isset($filters['unit_id'])) {
            $this->db->where('k.unit_id', $filters['unit_id']);
        }
        if (!empty($filters['is_semester'])) {
            $this->db->where('k.is_semester', $filters['is_semester']);
        }
        if (!empty($filters['overall'])) {
            $this->db->where('k.overall', $filters['overall']);
        }
        if (!empty($filters['is_core'])) {
            $this->db->where('k.is_core', $filters['is_core']);
        }
        if (!empty($filters['institution_score'])) {
            $this->db->where('k.institution_score', $filters['institution_score']);
        }
        if (!empty($filters['college_score'])) {
            $this->db->where('k.college_score', $filters['college_score']);
        }
        if (!empty($filters['standard_id'])) {
            $this->db->where('c.standard_id', $filters['standard_id']);
        }
        if (isset($filters['ncaaa'])) {
            $this->db->where('k.ncaaa', $filters['ncaaa']);
        }
        if (!empty($filters['search']))
        {
            $this->db->group_start();
            $this->db->like('k.title',$filters['search']);
            $this->db->or_like('k.code',$filters['search']);
            $this->db->group_end();
        }

        if (empty($orders))
        {
            $orders = array("length(SUBSTRING_INDEX(k.code,'.',1))","SUBSTRING_INDEX(k.code,'.',1)", "length(SUBSTRING_INDEX(k.code,'.',2))", "SUBSTRING_INDEX(k.code,'.',2)");
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
            return Orm_Kpi::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Kpi::to_object($row);
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
        $this->db->insert(Orm_Kpi::get_table_name(), $params);
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
        return $this->db->update(Orm_Kpi::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Kpi::get_table_name(), array('id' => (int) $id));
    }
}

