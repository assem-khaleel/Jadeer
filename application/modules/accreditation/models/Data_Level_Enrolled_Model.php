<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Level_Enrolled_Model
 */
class Data_Level_Enrolled_Model extends CI_Model {
    
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
        
        $this->db->select('dle.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Level_Enrolled::get_table_name().' AS dle');
        
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
            return Orm_Data_Level_Enrolled::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Level_Enrolled::to_object($row);
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

        License::valid_programs('dle.program_id');

        if (isset($filters['id'])) {
            $this->db->where('dle.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dle.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dle.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dle.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dle.program_id', $filters['program_id']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->join(Orm_Program::get_table_name(). ' AS p', 'p.id = dle.program_id','inner');
            $this->db->join(Orm_Department::get_table_name(). ' AS d', 'd.id = p.department_id','inner');
            $this->db->where('d.college_id', $filters['college_id']);

            License::valid_colleges('d.college_id');
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('dle.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['level'])) {
            $this->db->where('dle.level', $filters['level']);
        }
        if (isset($filters['gender'])) {
            $this->db->where('dle.gender', $filters['gender']);
        }
        if (isset($filters['nationality'])) {
            $this->db->where('dle.nationality', $filters['nationality']);
        }
        if (!empty($filters['enrolled_count'])) {
            $this->db->where('dle.enrolled_count', $filters['enrolled_count']);
        }
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Level_Enrolled::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Level_Enrolled::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return int
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Level_Enrolled::get_table_name(), array('id' => (int) $id));
    }

    public function get_sum($filters = array()) {
        $this->db->select_sum('dle.enrolled_count', 'enrolled');
        $this->db->from(Orm_Data_Level_Enrolled::get_table_name().' AS dle');

        $this->get_filters($filters);

        $result = $this->db->get()->row_array();

        if(isset($result['enrolled'])) {
            $result = $result['enrolled'];
        } else {
            $result = 0;
        }

        return $result;
    }
}

