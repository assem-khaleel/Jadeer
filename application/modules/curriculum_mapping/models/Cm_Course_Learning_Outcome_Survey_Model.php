<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cm_Course_Learning_Outcome_Survey_Model extends CI_Model {
    
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
        
        $this->db->select('cclos.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Course_Learning_Outcome_Survey::get_table_name() . ' AS cclos');
        $this->db->join(Orm_Survey::get_table_name() . ' AS s', 's.id = cclos.survey_id');
        $this->db->where('s.is_deleted', '0');
        
        if (isset($filters['id'])) {
            $this->db->where('cclos.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cclos.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cclos.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cclos.id', $filters['not_in_id']);
        }
        if (isset($filters['course_learning_outcome_id'])) {
            $this->db->where('cclos.course_learning_outcome_id', $filters['course_learning_outcome_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', 'cclo.id = cclos.course_learning_outcome_id');
            $this->db->where('cclo.course_id', $filters['course_id']);
        }
        if (isset($filters['survey_id'])) {
            $this->db->where('cclos.survey_id', $filters['survey_id']);
        }
        if (isset($filters['factor_id'])) {
            $this->db->where('cclos.factor_id', $filters['factor_id']);
        }
        if (isset($filters['statement_id'])) {
            $this->db->where('cclos.statement_id', $filters['statement_id']);
        }
        if (isset($filters['statement_not_ids'])) {
            $this->db->where_not_in('cclos.statement_id', $filters['statement_not_ids']);
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
            return Orm_Cm_Course_Learning_Outcome_Survey::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Course_Learning_Outcome_Survey::to_object($row);
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
        $this->db->insert(Orm_Cm_Course_Learning_Outcome_Survey::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Course_Learning_Outcome_Survey::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Course_Learning_Outcome_Survey::get_table_name(), array('id' => $id));
    }
    
}

