<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Cm_Program_X_Matrix_Method_Log_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Cm_Program_X_Matrix_Method_Log_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Cm_Program_X_Matrix_Method_Log | Orm_Cm_Program_X_Matrix_Method_Log[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('cpxmml.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Program_X_Matrix_Method_Log::get_table_name() . ' AS cpxmml');
        
        if (isset($filters['id'])) {
            $this->db->where('cpxmml.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cpxmml.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cpxmml.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cpxmml.id', $filters['not_in_id']);
        }
        if (isset($filters['log_program_id'])) {
            $this->db->where('cpxmml.log_program_id', $filters['log_program_id']);
        }
        if (isset($filters['log_course_id'])) {
            $this->db->where('cpxmml.log_course_id', $filters['log_course_id']);
        }
        if (isset($filters['log_assessment_method_id'])) {
            $this->db->where('cpxmml.log_assessment_method_id', $filters['log_assessment_method_id']);
        }
        if (isset($filters['log_program_learning_outcome_id'])) {
            $this->db->where('cpxmml.log_program_learning_outcome_id', $filters['log_program_learning_outcome_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('cpxmml.semester_id', $filters['semester_id']);
        }
        if (isset($filters['log_id'])) {
            $this->db->where('cpxmml.log_id', $filters['log_id']);
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
            return Orm_Cm_Program_X_Matrix_Method_Log::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Program_X_Matrix_Method_Log::to_object($row);
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
        $this->db->insert(Orm_Cm_Program_X_Matrix_Method_Log::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Program_X_Matrix_Method_Log::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Program_X_Matrix_Method_Log::get_table_name(), array('id' => $id));
    }
    
}

