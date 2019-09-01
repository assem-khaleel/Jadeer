<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Acc_Visit_Reviewer_Action_Plan_Model
 */
class Acc_Visit_Reviewer_Action_Plan_Model extends CI_Model {
    
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
        
        $this->db->select('avrap.*');
        $this->db->distinct();
        $this->db->from(Orm_Acc_Visit_Reviewer_Action_Plan::get_table_name() . ' AS avrap');
        
        if (isset($filters['id'])) {
            $this->db->where('avrap.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('avrap.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('avrap.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('avrap.id', $filters['not_in_id']);
        }
        if (!empty($filters['description'])) {
            $this->db->where('avrap.description', $filters['description']);
        }
        if (!empty($filters['due_date'])) {
            $this->db->where('avrap.due_date', $filters['due_date']);
        }
        if (!empty($filters['greater_due_date'])) {
            $this->db->where('avrap.due_date >=', $filters['greater_due_date']);
        }
        if (!empty($filters['less_due_date'])) {
            $this->db->where('avrap.due_date <=', $filters['less_due_date']);
        }
        if (!empty($filters['from_due_date']) && !empty($filters['to_due_date'])) {
            $this->db->group_start();
            $this->db->where('avrap.due_date >=', $filters['from_due_date']);
            $this->db->where('avrap.due_date <=', $filters['to_due_date']);
            $this->db->group_end();
        }
        if (isset($filters['responsible'])) {
            $this->db->where('avrap.responsible', $filters['responsible']);
        }
        if (isset($filters['progress'])) {
            $this->db->where('avrap.progress', $filters['progress']);
        }
        if (isset($filters['recommendation_id'])) {
            $this->db->where('avrap.recommendation_id', $filters['recommendation_id']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('avrap.date_added', $filters['date_added']);
        }
        if (!empty($filters['greater_date_added'])) {
            $this->db->where('avrap.date_added >=', $filters['greater_date_added']);
        }
        if (!empty($filters['less_date_added'])) {
            $this->db->where('avrap.date_added <=', $filters['less_date_added']);
        }
        if (!empty($filters['from_date_added']) && !empty($filters['to_date_added'])) {
            $this->db->group_start();
            $this->db->where('avrap.date_added >=', $filters['from_date_added']);
            $this->db->where('avrap.date_added <=', $filters['to_date_added']);
            $this->db->group_end();
        }
        if (isset($filters['user_id'])) {
            $this->db->where('avrap.user_id', $filters['user_id']);
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
            return Orm_Acc_Visit_Reviewer_Action_Plan::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Acc_Visit_Reviewer_Action_Plan::to_object($row);
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
        $this->db->insert(Orm_Acc_Visit_Reviewer_Action_Plan::get_table_name(), $params);
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
        return $this->db->update(Orm_Acc_Visit_Reviewer_Action_Plan::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Acc_Visit_Reviewer_Action_Plan::get_table_name(), array('id' => $id));
    }
    
}

