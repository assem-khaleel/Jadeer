<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rb_Rubrics_Model extends CI_Model {
    
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
        
        $this->db->select('rr.*');
        $this->db->distinct();
        $this->db->from(Orm_Rb_Rubrics::get_table_name() . ' AS rr');
        $this->db->where('rr.is_deleted', 0);
        
        if (isset($filters['id'])) {
            $this->db->where('rr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('rr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('rr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('rr.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('rr.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('rr.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['desc_en'])) {
            $this->db->where('rr.desc_en', $filters['desc_en']);
        }
        if (!empty($filters['desc_ar'])) {
            $this->db->where('rr.desc_ar', $filters['desc_ar']);
        }
        if (!empty($filters['rubric_class'])) {
            $this->db->where('rr.rubric_class', $filters['rubric_class']);
        }
        if (isset($filters['weight_type'])) {
            $this->db->where('rr.weight_type', $filters['weight_type']);
        }
        if (!empty($filters['extra_data'])) {
            $this->db->where('rr.extra_data', $filters['extra_data']);
        }
        if (isset($filters['rubric_type'])) {
            $this->db->where('rr.rubric_type', $filters['rubric_type']);
        }
        if (isset($filters['creator'])) {
            $this->db->where('rr.creator', $filters['creator']);
        }
        if (isset($filters['publisher'])) {
            $this->db->where('rr.publisher', $filters['publisher']);
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('rr.start_date', $filters['start_date']);
        }
        if (!empty($filters['greater_start_date'])) {
            $this->db->where('rr.start_date >=', $filters['greater_start_date']);
        }
        if (!empty($filters['less_start_date'])) {
            $this->db->where('rr.start_date <=', $filters['less_start_date']);
        }
        if (!empty($filters['from_start_date']) && !empty($filters['to_start_date'])) {
            $this->db->group_start();
            $this->db->where('rr.start_date >=', $filters['from_start_date']);
            $this->db->where('rr.start_date <=', $filters['to_start_date']);
            $this->db->group_end();
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('rr.end_date', $filters['end_date']);
        }
        if (!empty($filters['greater_end_date'])) {
            $this->db->where('rr.end_date >=', $filters['greater_end_date']);
        }
        if (!empty($filters['less_end_date'])) {
            $this->db->where('rr.end_date <=', $filters['less_end_date']);
        }
        if (!empty($filters['from_end_date']) && !empty($filters['to_end_date'])) {
            $this->db->group_start();
            $this->db->where('rr.end_date >=', $filters['from_end_date']);
            $this->db->where('rr.end_date <=', $filters['to_end_date']);
            $this->db->group_end();
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('rr.date_added', $filters['date_added']);
        }
        if (!empty($filters['greater_date_added'])) {
            $this->db->where('rr.date_added >=', $filters['greater_date_added']);
        }
        if (!empty($filters['less_date_added'])) {
            $this->db->where('rr.date_added <=', $filters['less_date_added']);
        }
        if (!empty($filters['from_date_added']) && !empty($filters['to_date_added'])) {
            $this->db->group_start();
            $this->db->where('rr.date_added >=', $filters['from_date_added']);
            $this->db->where('rr.date_added <=', $filters['to_date_added']);
            $this->db->group_end();
        }
        if (!empty($filters['date_modified'])) {
            $this->db->where('rr.date_modified', $filters['date_modified']);
        }
        if (!empty($filters['greater_date_modified'])) {
            $this->db->where('rr.date_modified >=', $filters['greater_date_modified']);
        }
        if (!empty($filters['less_date_modified'])) {
            $this->db->where('rr.date_modified <=', $filters['less_date_modified']);
        }
        if (!empty($filters['from_date_modified']) && !empty($filters['to_date_modified'])) {
            $this->db->group_start();
            $this->db->where('rr.date_modified >=', $filters['from_date_modified']);
            $this->db->where('rr.date_modified <=', $filters['to_date_modified']);
            $this->db->group_end();
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('rr.name_en', $filters['keyword']);
            $this->db->or_like('rr.name_ar', $filters['keyword']);
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
                return Orm_Rb_Rubrics::to_object($row, $row['rubric_class']);
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rb_Rubrics::to_object($row, $row['rubric_class']);
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
        $this->db->insert(Orm_Rb_Rubrics::get_table_name(), $params);
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
        return $this->db->update(Orm_Rb_Rubrics::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Rb_Rubrics::get_table_name(), array('is_deleted' => 1), array('id' => $id));
    }
    
}

