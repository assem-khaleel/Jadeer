<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Cm_Program_X_Matrix_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Cm_Program_X_Matrix_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Cm_Program_X_Matrix | Orm_Cm_Program_X_Matrix[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('cpxm.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Program_X_Matrix::get_table_name() . ' AS cpxm');
        
        if (isset($filters['id'])) {
            $this->db->where('cpxm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cpxm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cpxm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cpxm.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('cpxm.program_id', $filters['program_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('cpxm.course_id', $filters['course_id']);
        }
        if (isset($filters['program_learning_outcome_id'])) {
            $this->db->where('cpxm.program_learning_outcome_id', $filters['program_learning_outcome_id']);
        }
        if (isset($filters['xmatrix'])) {
            $this->db->where('cpxm.xmatrix', $filters['xmatrix']);
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
            return Orm_Cm_Program_X_Matrix::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Program_X_Matrix::to_object($row);
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
        $this->db->insert(Orm_Cm_Program_X_Matrix::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Program_X_Matrix::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Program_X_Matrix::get_table_name(), array('id' => $id));
    }

    /**
     * get the data depends on old semester or archive "log" data
     * @param $semester_id
     */
    public function archive($semester_id) {

        $this->db->select('*');
        $this->db->from(Orm_Cm_Program_X_Matrix::get_table_name());
        $current_data = $this->db->get()->result_array();

        foreach ($current_data as $current) {

            $archive = array_combine(
                array_map(function($k){ return 'log_' . $k; }, array_keys($current)),
                $current
            );

            $archive['semester_id'] = $semester_id;

            $this->db->insert(Orm_Cm_Program_X_Matrix_Log::get_table_name(), $archive);
        }
    }
    
}

