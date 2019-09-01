<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_Pre_Visit_Reviewer_Recommendation_Model extends CI_Model {
    
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
        
        $this->db->select('apvrr.*');
        $this->db->distinct();
        $this->db->from(Orm_Acc_Pre_Visit_Reviewer_Recommendation::get_table_name() . ' AS apvrr');
        
        if (isset($filters['id'])) {
            $this->db->where('apvrr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('apvrr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('apvrr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('apvrr.id', $filters['not_in_id']);
        }
        if (isset($filters['visit_reviewer_id'])) {
            $this->db->where('apvrr.visit_reviewer_id', $filters['visit_reviewer_id']);
        }
        if (!empty($filters['recommendation'])) {
            $this->db->where('apvrr.recommendation', $filters['recommendation']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('apvrr.type', $filters['type']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('apvrr.type_id', $filters['type_id']);
        }
        if (isset($filters['reviewer_id'])) {
            $this->db->where('apvrr.reviewer_id', $filters['reviewer_id']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('apvrr.date_added', $filters['date_added']);
        }
        if (!empty($filters['greater_date_added'])) {
            $this->db->where('apvrr.date_added >=', $filters['greater_date_added']);
        }
        if (!empty($filters['less_date_added'])) {
            $this->db->where('apvrr.date_added <=', $filters['less_date_added']);
        }
        if (!empty($filters['from_date_added']) && !empty($filters['to_date_added'])) {
            $this->db->group_start();
            $this->db->where('apvrr.date_added >=', $filters['from_date_added']);
            $this->db->where('apvrr.date_added <=', $filters['to_date_added']);
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
            return Orm_Acc_Pre_Visit_Reviewer_Recommendation::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Acc_Pre_Visit_Reviewer_Recommendation::to_object($row);
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
        $this->db->insert(Orm_Acc_Pre_Visit_Reviewer_Recommendation::get_table_name(), $params);
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
        return $this->db->update(Orm_Acc_Pre_Visit_Reviewer_Recommendation::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Acc_Pre_Visit_Reviewer_Recommendation::get_table_name(), array('id' => $id));
    }
    
}

