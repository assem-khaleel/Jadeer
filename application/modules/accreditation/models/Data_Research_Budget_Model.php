<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Research_Budget_Model
 */
class Data_Research_Budget_Model extends CI_Model {
    
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
        
        $this->db->select('drb.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Research_Budget::get_table_name().' AS drb');

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
            return Orm_Data_Research_Budget::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Research_Budget::to_object($row);
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

    public function get_filters($filters = array()) {

        if (isset($filters['id'])) {
            $this->db->where('drb.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('drb.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('drb.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('drb.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('drb.program_id', $filters['program_id']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('drb.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['research_budget_total_amount'])) {
            $this->db->where('drb.research_budget_total_amount', $filters['research_budget_total_amount']);
        }
        if (!empty($filters['research_budget_actual_expenditure'])) {
            $this->db->where('drb.research_budget_actual_expenditure', $filters['research_budget_actual_expenditure']);
        }
        if (!empty($filters['publications_count'])) {
            $this->db->where('drb.publications_count', $filters['publications_count']);
        }
        if (!empty($filters['conferece_presentation_count'])) {
            $this->db->where('drb.conferece_presentation_count', $filters['conferece_presentation_count']);
        }
        if (!empty($filters['male_faculty_member_count'])) {
            $this->db->where('drb.male_faculty_member_count', $filters['male_faculty_member_count']);
        }
        if (!empty($filters['female_faculty_member_count'])) {
            $this->db->where('drb.female_faculty_member_count', $filters['female_faculty_member_count']);
        }
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Research_Budget::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Research_Budget::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Research_Budget::get_table_name(), array('id' => (int) $id));
    }
}

