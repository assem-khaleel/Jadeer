<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Competion_Rate_Model
 */
class Data_Competion_Rate_Model extends CI_Model {
    
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
        
        $this->db->select('dcr.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Competion_Rate::get_table_name().' AS dcr');

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
            return Orm_Data_Competion_Rate::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Competion_Rate::to_object($row);
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

        License::valid_programs('dcr.program_id');

        if (isset($filters['id'])) {
            $this->db->where('dcr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dcr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dcr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dcr.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dcr.program_id', $filters['program_id']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->join(Orm_Program::get_table_name().' AS p', 'p.id = dcr.program_id','inner');
            $this->db->join(Orm_Department::get_table_name().' AS d', 'd.id = p.department_id','inner');
            $this->db->where('d.college_id', $filters['college_id']);

            License::valid_colleges('d.college_id');
        }
        if (isset($filters['program_in'])) {
            $this->db->where_in('dcr.program_id', $filters['program_in']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('dcr.academic_year', $filters['academic_year']);
        }
        if (isset($filters['gender'])) {
            $this->db->where('dcr.gender', $filters['gender']);
        }
        if (!empty($filters['number_of_years'])) {
            $this->db->where('dcr.number_of_years', $filters['number_of_years']);
        }
        if (!empty($filters['number_of_years_more'])) {
            $this->db->where('dcr.number_of_years >= ', $filters['number_of_years_more']);
        }
        if (!empty($filters['number_of_years_less'])) {
            $this->db->where('dcr.number_of_years <= ', $filters['number_of_years_less']);
        }
        if (!empty($filters['graduate_count'])) {
            $this->db->where('dcr.graduate_count', $filters['graduate_count']);
        }
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Competion_Rate::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Competion_Rate::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Competion_Rate::get_table_name(), array('id' => (int) $id));
    }

    public function get_sum($filters = array()) {

        $this->db->select_sum('dcr.graduate_count', 'graduate');
        $this->db->from(Orm_Data_Competion_Rate::get_table_name().' AS dcr');

        $this->get_filters($filters);

        $result = $this->db->get()->row_array();

        return isset($result['graduate']) ? (int)$result['graduate'] : 0;
    }
}

