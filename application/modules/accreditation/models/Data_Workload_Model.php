<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Workload_Model
 */
class Data_Workload_Model extends CI_Model {
    
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
        
        $this->db->select('dw.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Workload::get_table_name().' AS dw');
        
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
            return Orm_Data_Workload::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Workload::to_object($row);
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

    public function get_filters($filters) {

        License::valid_programs('dw.program_id');

        if (isset($filters['id'])) {
            $this->db->where('dw.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dw.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dw.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dw.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dw.program_id', $filters['program_id']);
        }
        if (isset($filters['gender'])) {
            $this->db->where('dw.gender', $filters['gender']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('dw.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['semester'])) {
            $this->db->where('dw.semester', $filters['semester']);
        }
        if (!empty($filters['work_load'])) {
            $this->db->where('dw.work_load', $filters['work_load']);
        }
        if (!empty($filters['class_size'])) {
            $this->db->where('dw.class_size', $filters['class_size']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->join(Orm_Program::get_table_name(). ' AS p', 'p.id = dw.program_id','inner');
            $this->db->join(Orm_Department::get_table_name(). ' AS d', 'd.id = p.department_id','inner');
            $this->db->where('d.college_id', $filters['college_id']);

            License::valid_colleges('d.college_id');
        }
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Workload::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Workload::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Workload::get_table_name(), array('id' => (int) $id));
    }

    public function get_average($filters = array()) {
        $this->db->select_avg('dw.work_load', 'work_load');
        $this->db->select_avg('dw.class_size', 'class_size');
        $this->db->from(Orm_Data_Workload::get_table_name().' AS dw');

        $this->get_filters($filters);

        $result = $this->db->get()->row_array();

        return $result;
    }
    
}

